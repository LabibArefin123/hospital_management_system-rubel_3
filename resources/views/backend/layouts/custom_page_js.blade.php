  {{-- jQuery --}}
  <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>

  {{-- Select2 --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  {{-- DataTables 3 --}}
  <script src="https://cdn.datatables.net/3.0.3/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/3.0.3/js/dataTables.bootstrap5.min.js"></script>

  {{-- DataTables Responsive --}}
  <script src="https://cdn.datatables.net/responsive/4.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/4.0.2/js/responsive.bootstrap5.min.js"></script>

  {{-- Bootstrap 5 --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  {{-- CUSTOM JS --}}
  <script src="{{ asset('js/custom_backend/logout.js') }}"></script>
  <script src="{{ asset('js/custom_backend/data-table-loader.js') }}"></script>
  <script src="{{ asset('js/custom_backend/alerts.js') }}"></script>
  <script src="{{ asset('js/custom_backend/back-confirm.js') }}"></script>
  {{-- SESSION ALERTS --}}
  @if (session('success'))
      <script>
          showSuccess(@json(session('success')));
      </script>
  @endif

  @if (session('login_success'))
      <script>
          showSuccess(@json(session('login_success')));
      </script>
  @endif

  @if (session('error'))
      <script>
          showError(@json(session('error')));
      </script>
  @endif

  @if (session('warning'))
      <script>
          showWarning(@json(session('warning')));
      </script>
  @endif

  @if (session('info'))
      <script>
          showInfo(@json(session('info')));
      </script>
  @endif

  <script src="{{ asset('js/custom_backend/doctor_management/doctor_image_info.js') }}"></script>
