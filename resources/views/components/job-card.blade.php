@props(['job'])

<article class="job-card d-flex flex-column">
    <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
        <span class="badge badge-soft">{{ $job->department->name }}</span>
        @if ($job->is_featured)
            <span class="text-warning" title="Vị trí nổi bật" data-bs-toggle="tooltip">
                <i data-lucide="star" class="icon-sm"></i>
            </span>
        @endif
    </div>
    <h3 class="mb-3">
        <a class="stretched-link text-reset" href="{{ route('careers.show', $job) }}">{{ $job->title }}</a>
    </h3>
    <div class="job-meta mb-4">
        <span><i data-lucide="map-pin" class="icon-sm"></i>{{ $job->location }}</span>
        <span><i data-lucide="briefcase-business" class="icon-sm"></i>{{ $job->employmentTypeLabel() }}</span>
        <span><i data-lucide="wallet-cards" class="icon-sm"></i>{{ $job->salary ?: 'Thỏa thuận' }}</span>
    </div>
    <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between gap-2">
        <small class="text-muted-valora">
            Hạn: {{ $job->deadline?->format('d/m/Y') ?: 'Không giới hạn' }}
        </small>
        <i data-lucide="arrow-up-right" class="icon-sm text-primary"></i>
    </div>
</article>
