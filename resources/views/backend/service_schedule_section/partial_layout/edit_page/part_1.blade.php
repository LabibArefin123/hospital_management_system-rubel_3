<div class="card service-preview-card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="service-preview-image-wrapper">
                    <img id="servicePreviewImage"
                        src="{{ asset($schedule->service->image ? $schedule->service->image : 'uploads/images/default.jpg') }}"
                        class="service-preview-image" alt="{{ $schedule->service->title ?? 'Service Preview' }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-preview-info">
                    <h4 id="servicePreviewTitle" class="service-preview-title">
                        {{ $schedule->service->title ?? 'Service Title' }}</h4>
                    <span id="servicePreviewPrice" class="service-preview-price badge badge-success">৳
                        {{ $schedule->service->price ?? '0' }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-preview-info">
                    <div class="service-preview-detail">
                        <span class="service-preview-label">Service Description</span>
                        <strong id="servicePreviewDescription"
                            class="service-preview-value">{{ $schedule->service->description ?? 'No description available.' }}</strong>
                    </div>
                    <div class="service-preview-detail">
                        <span class="service-preview-label">Service ID</span>
                        <strong id="servicePreviewId"
                            class="service-preview-value service-preview-id">{{ $schedule->service_id }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
