{{-- START VALIDATION MODAL --}}
<div class="modal fade" id="backConfirmModal" tabindex="-1" role="dialog" aria-labelledby="backConfirmLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            {{-- MODAL ICON --}}
            <div class="validation-modal-icon">
                <i class="fas fa-exclamation-circle validation-warning-icon" aria-hidden="true"></i>
            </div>
            {{-- MODAL MESSAGE --}}
            <div class="modal-body">
                <h5 class="validation-modal-title">
                    Leave This Page?
                </h5>

                <p class="validation-modal-message">
                    Please fill up the required fields before leaving the page.
                    Do you want to leave?
                </p>
            </div>

            {{-- MODAL ACTIONS --}}
            <div class="modal-footer validation-modal-actions">

                <button type="button" class="btn validation-stay-btn" data-bs-dismiss="modal">
                    <i class="fas fa-arrow-left"></i>
                    <span>Stay</span>
                </button>

                <a href="#" class="btn validation-leave-btn leave-page">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Leave</span>
                </a>

            </div>

        </div>
    </div>
</div>
{{-- END VALIDATION MODAL --}}
