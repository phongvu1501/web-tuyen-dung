<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ContactMessage;
use App\Models\Department;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::updateOrCreate(['email' => 'admin@valora.demo'], [
            'name' => 'Valora HR Admin',
            'password' => Hash::make('Valora@123'),
            'is_admin' => true,
        ]);

        $departmentData = [
            ['name' => 'Sales', 'description' => 'Phát triển khách hàng và doanh thu.'],
            ['name' => 'Marketing', 'description' => 'Xây dựng thương hiệu và hoạt động tiếp thị.'],
            ['name' => 'Human Resources', 'description' => 'Phát triển con người và tổ chức.'],
            ['name' => 'Operations', 'description' => 'Vận hành và tối ưu quy trình.'],
            ['name' => 'Customer Service', 'description' => 'Đồng hành và hỗ trợ khách hàng.'],
        ];

        $departments = collect($departmentData)->mapWithKeys(function (array $data) {
            $slug = Str::slug($data['name']);
            $department = Department::updateOrCreate(['slug' => $slug], [
                ...$data,
                'is_active' => true,
            ]);

            return [$data['name'] => $department];
        });

        $jobs = [
            ['Sales', 'Sales Executive', 'Hồ Chí Minh', 'full_time', '12 - 18 triệu', '1 năm', true, 'published', 35],
            ['Sales', 'Senior Sales Executive', 'Hà Nội', 'full_time', '18 - 25 triệu', '3 năm', true, 'published', 30],
            ['Sales', 'Key Account Executive', 'Hồ Chí Minh', 'full_time', '15 - 22 triệu', '2 năm', false, 'published', 42],
            ['Marketing', 'Marketing Executive', 'Hồ Chí Minh', 'full_time', '12 - 17 triệu', '1 - 2 năm', true, 'published', 32],
            ['Marketing', 'Digital Marketing Specialist', 'Hà Nội', 'full_time', '15 - 22 triệu', '2 năm', false, 'published', 38],
            ['Marketing', 'Content Marketing Intern', 'Hồ Chí Minh', 'internship', 'Hỗ trợ thực tập', 'Không yêu cầu', false, 'published', 28],
            ['Human Resources', 'HR Executive', 'Hồ Chí Minh', 'full_time', '13 - 18 triệu', '2 năm', true, 'published', 45],
            ['Human Resources', 'Talent Acquisition Specialist', 'Hà Nội', 'full_time', '15 - 20 triệu', '2 năm', false, 'published', 36],
            ['Operations', 'Operations Executive', 'Hồ Chí Minh', 'full_time', '12 - 18 triệu', '1 năm', false, 'published', 40],
            ['Operations', 'Supply Chain Coordinator', 'Bình Dương', 'full_time', '14 - 20 triệu', '2 năm', false, 'published', 34],
            ['Customer Service', 'Customer Service Executive', 'Hồ Chí Minh', 'full_time', '10 - 15 triệu', 'Không yêu cầu', true, 'published', 31],
            ['Customer Service', 'Customer Success Specialist', 'Làm việc từ xa', 'remote', '14 - 19 triệu', '1 - 2 năm', false, 'published', 39],
            ['Operations', 'Finance Operations Analyst', 'Hồ Chí Minh', 'full_time', '15 - 21 triệu', '2 năm', false, 'published', -5],
            ['Operations', 'Office Administrator', 'Hà Nội', 'full_time', '11 - 15 triệu', '1 năm', false, 'closed', 20],
            ['Human Resources', 'Internal Communications Executive', 'Hồ Chí Minh', 'full_time', 'Thỏa thuận', '1 năm', false, 'draft', 50],
        ];

        $createdJobs = collect($jobs)->map(function (array $data) use ($admin, $departments) {
            [$department, $title, $location, $type, $salary, $experience, $featured, $status, $deadlineDays] = $data;
            $slug = Str::slug($title);

            return Job::updateOrCreate(['slug' => $slug], [
                'department_id' => $departments[$department]->id,
                'title' => $title,
                'location' => $location,
                'employment_type' => $type,
                'salary' => $salary,
                'experience' => $experience,
                'description' => "- Thực hiện các nhiệm vụ chuyên môn của vị trí {$title}.\n- Phối hợp với các phòng ban để đảm bảo tiến độ và chất lượng công việc.\n- Theo dõi kết quả, chủ động đề xuất phương án cải tiến.\n- Báo cáo định kỳ theo mục tiêu của bộ phận.",
                'requirements' => "- Có tinh thần trách nhiệm và khả năng phối hợp tốt.\n- Giao tiếp rõ ràng, chủ động trong công việc.\n- Sử dụng tốt các công cụ văn phòng liên quan.\n- Kinh nghiệm: {$experience}.",
                'benefits' => "- Thu nhập cạnh tranh theo năng lực.\n- Môi trường làm việc chuyên nghiệp và hỗ trợ.\n- Cơ hội học hỏi, phát triển chuyên môn.\n- Các chế độ theo chính sách công ty và quy định pháp luật.",
                'deadline' => today()->addDays($deadlineDays),
                'status' => $status,
                'is_featured' => $featured,
                'created_by' => $admin->id,
            ]);
        });

        $demoApplications = [
            ['Sales Executive', 'Nguyễn Minh Anh', 'minhanh.candidate@example.com', '0912345678', 'new'],
            ['Marketing Executive', 'Trần Gia Huy', 'giahuy.candidate@example.com', '0987654321', 'reviewing'],
            ['HR Executive', 'Lê Thu Trang', 'thutrang.candidate@example.com', '0905123456', 'interview'],
        ];

        $blankPdf = base64_decode('JVBERi0xLjQKMSAwIG9iago8PCAvVHlwZSAvQ2F0YWxvZyAvUGFnZXMgMiAwIFIgPj4KZW5kb2JqCjIgMCBvYmoKPDwgL1R5cGUgL1BhZ2VzIC9LaWRzIFszIDAgUl0gL0NvdW50IDEgPj4KZW5kb2JqCjMgMCBvYmoKPDwgL1R5cGUgL1BhZ2UgL1BhcmVudCAyIDAgUiAvTWVkaWFCb3ggWzAgMCA2MTIgNzkyXSA+PgplbmRvYmoKeHJlZgowIDQKMDAwMDAwMDAwMCA2NTUzNSBmIAowMDAwMDAwMDA5IDAwMDAwIG4gCjAwMDAwMDAwNTggMDAwMDAgbiAKMDAwMDAwMDExNSAwMDAwMCBuIAp0cmFpbGVyCjw8IC9TaXplIDQgL1Jvb3QgMSAwIFIgPj4Kc3RhcnR4cmVmCjIwNQolJUVPRgo=');

        foreach ($demoApplications as [$jobTitle, $name, $email, $phone, $status]) {
            $job = $createdJobs->firstWhere('title', $jobTitle);
            $path = 'applications/cvs/demo-'.Str::slug($name).'.pdf';
            Storage::disk('local')->put($path, $blankPdf);

            Application::updateOrCreate(['job_id' => $job->id, 'email' => $email], [
                'full_name' => $name,
                'phone' => $phone,
                'address' => 'Thông tin địa chỉ demo',
                'cv_path' => $path,
                'cv_original_name' => 'CV-'.$name.'.pdf',
                'cv_mime_type' => 'application/pdf',
                'cover_letter' => 'Đây là hồ sơ demo được tạo bởi seeder để kiểm tra quy trình quản lý ứng viên.',
                'status' => $status,
            ]);
        }

        ContactMessage::updateOrCreate(['email' => 'candidate.question@example.com'], [
            'full_name' => 'Phạm Hoàng Nam',
            'phone' => '0909000111',
            'message' => 'Tôi muốn hỏi thêm về thời gian phản hồi sau khi gửi hồ sơ. Đây là dữ liệu liên hệ demo.',
            'read_at' => null,
        ]);
    }
}
