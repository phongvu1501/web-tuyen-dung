<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\ContactMessage;
use App\Models\Department;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class RecruitmentFlowTest extends TestCase
{
    use DatabaseTransactions;

    public function test_public_pages_are_available(): void
    {
        $this->get('/')->assertOk()->assertSee('Cơ hội nghề nghiệp tại Valora');
        $this->get('/about')->assertOk()->assertSee('dữ liệu demo');
        $this->get('/careers')->assertOk();
        $this->get('/contact')->assertOk();
    }

    public function test_only_active_published_jobs_appear_in_public_listing(): void
    {
        $published = $this->createJob(['title' => 'Public Sales Role', 'slug' => 'public-sales-role']);
        $draft = $this->createJob(['title' => 'Hidden Draft Role', 'slug' => 'hidden-draft-role', 'status' => 'draft']);
        $closed = $this->createJob(['title' => 'Closed Role', 'slug' => 'closed-role', 'status' => 'closed']);
        $expired = $this->createJob(['title' => 'Expired Role', 'slug' => 'expired-role', 'deadline' => today()->subDay()]);

        $this->get('/careers')
            ->assertOk()
            ->assertSee($published->title)
            ->assertDontSee($draft->title)
            ->assertDontSee($closed->title)
            ->assertDontSee($expired->title);

        $this->get(route('careers.show', $draft))->assertNotFound();
        $this->get(route('careers.show', $closed))->assertOk()->assertSee('đã kết thúc tuyển dụng');
    }

    public function test_career_search_and_filters_work(): void
    {
        $sales = $this->createDepartment('Sales Filter');
        $marketing = $this->createDepartment('Marketing Filter');
        $matching = $this->createJob([
            'department_id' => $sales->id,
            'title' => 'Enterprise Sales Consultant',
            'slug' => 'enterprise-sales-consultant',
            'location' => 'Hà Nội',
        ]);
        $other = $this->createJob([
            'department_id' => $marketing->id,
            'title' => 'Brand Specialist',
            'slug' => 'brand-specialist',
            'location' => 'Hồ Chí Minh',
        ]);

        $this->get(route('careers.index', [
            'keyword' => 'Enterprise',
            'department' => $sales->slug,
            'location' => 'Hà Nội',
            'employment_type' => 'full_time',
        ]))->assertOk()->assertSee($matching->title)->assertDontSee($other->title);
    }

    public function test_candidate_can_apply_with_a_private_pdf_cv(): void
    {
        Storage::fake('local');
        $job = $this->createJob();
        $cv = UploadedFile::fake()->createWithContent('my-cv.pdf', "%PDF-1.4\n1 0 obj\n<<>>\nendobj\n%%EOF");

        $response = $this->post(route('careers.apply.store', $job), [
            'full_name' => 'Nguyễn Văn Test',
            'email' => 'candidate'.Str::random(8).'@example.com',
            'phone' => '0912345678',
            'address' => 'Hồ Chí Minh',
            'cv' => $cv,
            'cover_letter' => 'Tôi mong muốn ứng tuyển vị trí này.',
        ]);

        $response->assertRedirect(route('applications.success'));
        $application = Application::latest('id')->firstOrFail();
        $this->assertSame('new', $application->status);
        $this->assertSame('my-cv.pdf', $application->cv_original_name);
        $this->assertStringStartsWith('applications/cvs/', $application->cv_path);
        $this->assertNotSame('applications/cvs/my-cv.pdf', $application->cv_path);
        Storage::disk('local')->assertExists($application->cv_path);
    }

    public function test_invalid_cv_is_rejected(): void
    {
        Storage::fake('local');
        $job = $this->createJob();

        $this->from(route('careers.apply', $job))->post(route('careers.apply.store', $job), [
            'full_name' => 'Ứng viên Test',
            'email' => 'invalid-file@example.com',
            'phone' => '0912345678',
            'cv' => UploadedFile::fake()->createWithContent('malware.exe', 'MZ executable'),
        ])->assertRedirect(route('careers.apply', $job))->assertSessionHasErrors('cv');

        $this->assertDatabaseMissing('applications', ['email' => 'invalid-file@example.com']);
    }

    public function test_closed_and_expired_jobs_cannot_receive_applications(): void
    {
        $closed = $this->createJob(['slug' => 'cannot-apply-closed', 'status' => 'closed']);
        $expired = $this->createJob(['slug' => 'cannot-apply-expired', 'deadline' => today()->subDay()]);

        foreach ([$closed, $expired] as $job) {
            $this->get(route('careers.apply', $job))->assertRedirect(route('careers.show', $job));
            $this->post(route('careers.apply.store', $job), [])->assertRedirect(route('careers.show', $job));
        }

        $this->assertSame(0, Application::whereIn('job_id', [$closed->id, $expired->id])->count());
    }

    public function test_contact_form_validates_and_stores_message(): void
    {
        $this->post(route('contact.store'), [
            'full_name' => 'Người Liên Hệ',
            'email' => 'contact'.Str::random(8).'@example.com',
            'phone' => '0909123456',
            'message' => 'Tôi cần thêm thông tin về vị trí tuyển dụng.',
        ])->assertRedirect(route('contact.create'))->assertSessionHas('success');

        $this->assertSame(1, ContactMessage::where('full_name', 'Người Liên Hệ')->count());
    }

    public function test_admin_routes_require_authentication_and_admin_role(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));

        $regularUser = User::factory()->create(['is_admin' => false]);
        $this->actingAs($regularUser)->get(route('admin.dashboard'))->assertForbidden();

        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
    }

    public function test_admin_can_login_create_publish_and_close_a_job(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin-'.Str::random(8).'@example.com',
            'password' => Hash::make('secret-password'),
            'is_admin' => true,
        ]);
        $department = $this->createDepartment('Admin Department');

        $this->post(route('login.store'), [
            'email' => $admin->email,
            'password' => 'secret-password',
        ])->assertRedirect(route('admin.dashboard'));

        $response = $this->post(route('admin.jobs.store'), [
            'department_id' => $department->id,
            'title' => 'Admin Created Position',
            'slug' => '',
            'location' => 'Đà Nẵng',
            'employment_type' => 'full_time',
            'salary' => '15 - 20 triệu',
            'experience' => '2 năm',
            'description' => 'Mô tả công việc đầy đủ.',
            'requirements' => 'Yêu cầu công việc đầy đủ.',
            'benefits' => 'Quyền lợi công việc đầy đủ.',
            'deadline' => today()->addMonth()->format('Y-m-d'),
            'status' => 'draft',
            'is_featured' => '1',
        ]);

        $job = Job::where('slug', 'admin-created-position')->firstOrFail();
        $response->assertRedirect(route('admin.jobs.show', $job));
        $this->patch(route('admin.jobs.publish', $job))->assertRedirect();
        $this->assertSame('published', $job->refresh()->status);
        $this->patch(route('admin.jobs.close', $job))->assertRedirect();
        $this->assertSame('closed', $job->refresh()->status);
    }

    public function test_malformed_password_hash_does_not_expose_runtime_error(): void
    {
        $email = 'plain-password-'.Str::random(8).'@example.com';
        DB::table('users')->insert([
            'name' => 'Malformed Admin',
            'email' => $email,
            'password' => 'plain-text-password',
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->from(route('login'))->post(route('login.store'), [
            'email' => $email,
            'password' => 'plain-text-password',
        ])->assertRedirect(route('login'))->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_only_admin_can_view_cv_and_update_application_status(): void
    {
        Storage::fake('local');
        $job = $this->createJob();
        Storage::disk('local')->put('applications/cvs/private.pdf', '%PDF-1.4 demo');
        $application = Application::create([
            'job_id' => $job->id,
            'full_name' => 'Private Candidate',
            'email' => 'private'.Str::random(8).'@example.com',
            'phone' => '0912345678',
            'cv_path' => 'applications/cvs/private.pdf',
            'cv_original_name' => 'private-cv.pdf',
            'cv_mime_type' => 'application/pdf',
            'status' => 'new',
        ]);

        $this->get(route('admin.applications.cv.view', $application))->assertRedirect(route('login'));

        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin)->get(route('admin.applications.cv.view', $application))->assertOk();
        $this->patch(route('admin.applications.status', $application), ['status' => 'interview'])->assertRedirect();
        $this->assertSame('interview', $application->refresh()->status);
    }

    private function createDepartment(string $name = 'Test Department'): Department
    {
        return Department::create([
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(6)),
            'is_active' => true,
        ]);
    }

    private function createJob(array $attributes = []): Job
    {
        $department = isset($attributes['department_id']) ? null : $this->createDepartment('Job Department');

        return Job::create(array_merge([
            'department_id' => $department?->id,
            'title' => 'Test Recruitment Position',
            'slug' => 'test-position-'.Str::lower(Str::random(8)),
            'location' => 'Hồ Chí Minh',
            'employment_type' => 'full_time',
            'salary' => 'Thỏa thuận',
            'experience' => '1 năm',
            'description' => 'Mô tả công việc.',
            'requirements' => 'Yêu cầu công việc.',
            'benefits' => 'Quyền lợi công việc.',
            'deadline' => today()->addMonth(),
            'status' => 'published',
            'is_featured' => false,
        ], $attributes));
    }
}
