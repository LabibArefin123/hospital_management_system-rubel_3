@if ($errors->any())

    <div class="alert alert-danger border-0 shadow-sm rounded-4">

        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-exclamation-circle me-2"></i>

            <strong>
                Please fix the following errors:
            </strong>
        </div>

        <ul class="mb-0 ps-3">

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif
