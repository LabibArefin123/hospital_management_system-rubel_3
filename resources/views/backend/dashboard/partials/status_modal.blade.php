<div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-primary">

                <h5 class="modal-title">
                    Confirm Status Change
                </h5>

                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <div class="modal-body text-center">

                <h5 id="statusChangeText">
                    Do you want to change status?
                </h5>

            </div>

            <div class="modal-footer justify-content-center">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    No
                </button>

                <form id="statusChangeForm" method="POST">

                    @csrf

                    <input type="hidden" name="status" id="selectedStatus">

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                        Yes
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
