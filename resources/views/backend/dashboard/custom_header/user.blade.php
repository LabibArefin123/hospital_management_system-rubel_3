<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex align-items-center">

        {{-- LEFT CONTENT --}}
        <div class="flex-grow-1">
            <h4 class="mb-1">
                Welcome, {{ $user->name }}
            </h4>

            <small class="text-muted">
                {{ $user->email }}
            </small>
        </div>

        {{-- RIGHT AVATAR --}}
        <div class="ms-auto">
            @if ($user->avatar ?? false)
                <img src="{{ $user->avatar }}" class="rounded-circle border shadow-sm"
                    style="width:60px;height:60px;object-fit:cover;">
            @else
                <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('uploads/images/default.jpg') }}"
                    class="rounded-circle border shadow-sm" style="width:60px;height:60px;object-fit:cover;">
            @endif
        </div>

    </div>
</div>
