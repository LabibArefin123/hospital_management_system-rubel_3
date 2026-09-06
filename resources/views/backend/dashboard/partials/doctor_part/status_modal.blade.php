{{-- START STATUS CHANGE MODAL --}}
<div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog" aria-labelledby="statusChangeLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content status-modal-content">

            {{-- HEADER --}}
            <div class="status-modal-header">
                <div class="status-modal-header-content">
                    <div class="status-modal-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>

                    <div>
                        <h5 id="statusChangeLabel">
                            Confirm Status Change
                        </h5>

                        <p>
                            Review the appointment information before updating.
                        </p>
                    </div>
                </div>

                <button type="button" class="status-modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- BODY --}}
            <div class="status-modal-body">

                {{-- PATIENT INFORMATION --}}
                <div class="status-patient-card">

                    <div class="status-patient-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="status-patient-info">
                        <span class="status-patient-label">
                            Patient
                        </span>

                        <strong id="statusPatientName">
                            —
                        </strong>

                        <div class="status-patient-meta">
                            <span>
                                <i class="fas fa-birthday-cake"></i>
                                <span id="statusPatientAge">—</span> Years
                            </span>

                            <span>
                                <i class="fas fa-venus-mars"></i>
                                <span id="statusPatientGender">—</span>
                            </span>
                        </div>
                    </div>

                </div>

                {{-- STATUS CHANGE --}}
                <div class="status-change-card">

                    <div class="status-change-item">
                        <span class="status-change-label">
                            Current Status
                        </span>

                        <span class="status-badge status-current-badge" id="currentStatusBadge">
                            Pending
                        </span>
                    </div>

                    <div class="status-change-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>

                    <div class="status-change-item">
                        <span class="status-change-label">
                            New Status
                        </span>

                        <span class="status-badge status-new-badge" id="newStatusBadge">
                            Confirmed
                        </span>
                    </div>

                </div>

                {{-- CONFIRMATION MESSAGE --}}
                <div class="status-confirmation-message">
                    <i class="fas fa-info-circle"></i>

                    <p id="statusChangeText">
                        Do you want to set the status for this patient?
                    </p>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="status-modal-footer">

                <button type="button" class="status-cancel-btn" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    <span>No, Keep It</span>
                </button>

                <form id="statusChangeForm" method="POST">
                    @csrf

                    <input type="hidden" name="status" id="selectedStatus">

                    <button type="submit" class="status-confirm-btn">
                        <i class="fas fa-check"></i>
                        <span>Yes, Update</span>
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>
{{-- END STATUS CHANGE MODAL --}}
