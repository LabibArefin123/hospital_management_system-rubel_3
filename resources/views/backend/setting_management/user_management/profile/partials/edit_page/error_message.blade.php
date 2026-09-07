  @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm mb-4">
          <strong>
              <i class="fas fa-exclamation-triangle mr-1"></i>
              Please check the following:
          </strong>

          <ul class="mb-0 mt-2">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
