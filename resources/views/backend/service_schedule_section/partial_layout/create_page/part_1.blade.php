<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-4 text-center border-right">
                <img id="servicePreviewImage" src="{{ asset('uploads/images/default.jpg') }}" 
                    style="width:140px;height:140px;object-fit:contain;border:5px solid #f1f5f9;">
            </div>
            <div class="col-md-4">
                <h4 id="servicePreviewTitle" class="font-weight-bold text-primary mb-2">Service Title</h4>
                <span id="servicePreviewPrice" class="badge badge-success px-3 py-2">Price</span>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <small class="text-muted d-block">Service Description</small>
                    <strong id="servicePreviewDescription">Service description</strong>
                </div>
                <div>
                    <small class="text-muted d-block">Service ID</small>
                    <strong id="servicePreviewId">---</strong>
                </div>
            </div>
        </div>
    </div>
</div>
