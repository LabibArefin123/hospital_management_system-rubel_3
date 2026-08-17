    {{-- JQUERY FIRST --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SWEET ALERT 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- DATATABLE --}}
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

    {{-- CUSTOM JS --}}
    <script src="{{ asset('js/custom_backend/app.js') }}"></script>
    <script src="{{ asset('js/custom_backend/logout.js') }}"></script>
    <script src="{{ asset('js/custom_backend/data-table.js') }}"></script>
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
