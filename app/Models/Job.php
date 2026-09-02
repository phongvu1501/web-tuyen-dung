<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'department_id',
        'title',
        'slug',
        'location',
        'employment_type',
        'salary',
        'experience',
        'description',
        'requirements',
        'benefits',
        'deadline',
        'status',
        'is_featured',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeAcceptingApplications(Builder $query): Builder
    {
        return $query->published()
            ->where(function (Builder $query) {
                $query->whereNull('deadline')->orWhereDate('deadline', '>=', today());
            });
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['keyword'] ?? null, function (Builder $query, string $keyword) {
                $query->where(function (Builder $query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('location', 'like', "%{$keyword}%")
                        ->orWhereHas('department', fn (Builder $query) => $query->where('name', 'like', "%{$keyword}%"));
                });
            })
            ->when($filters['department'] ?? null, fn (Builder $query, string $department) => $query->whereHas(
                'department',
                fn (Builder $query) => $query->where('slug', $department)
            ))
            ->when($filters['location'] ?? null, fn (Builder $query, string $location) => $query->where('location', $location))
            ->when($filters['employment_type'] ?? null, fn (Builder $query, string $type) => $query->where('employment_type', $type));
    }

    public function isAcceptingApplications(): bool
    {
        return $this->status === self::STATUS_PUBLISHED
            && ($this->deadline === null || $this->deadline->gte(today()));
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_DRAFT => 'Bản nháp',
            self::STATUS_PUBLISHED => 'Đang tuyển',
            self::STATUS_CLOSED => 'Đã đóng',
        ];
    }

    public static function employmentTypeOptions(): array
    {
        return [
            'full_time' => 'Toàn thời gian',
            'part_time' => 'Bán thời gian',
            'contract' => 'Hợp đồng',
            'internship' => 'Thực tập',
            'remote' => 'Làm việc từ xa',
        ];
    }

    public function statusLabel(): string
    {
        return self::statusOptions()[$this->status] ?? $this->status;
    }

    public function employmentTypeLabel(): string
    {
        return self::employmentTypeOptions()[$this->employment_type] ?? $this->employment_type;
    }
}
