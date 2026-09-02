<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'full_name',
        'email',
        'phone',
        'address',
        'cv_path',
        'cv_original_name',
        'cv_mime_type',
        'cover_letter',
        'status',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public static function statusOptions(): array
    {
        return [
            'new' => 'Mới',
            'reviewing' => 'Đang xem xét',
            'interview' => 'Phỏng vấn',
            'accepted' => 'Đã nhận',
            'rejected' => 'Từ chối',
        ];
    }

    public function statusLabel(): string
    {
        return self::statusOptions()[$this->status] ?? $this->status;
    }
}
