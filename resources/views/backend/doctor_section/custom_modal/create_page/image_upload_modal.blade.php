<div class="modal fade" id="imageUploadModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Upload Doctor Image
                </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    {{-- LEFT: Preview --}}
                    <div class="col-md-6 text-center">

                        <div class="border rounded p-2 bg-light">

                            <img id="imagePreview" src="" class="img-fluid rounded"
                                style="max-height:300px; object-fit:contain;">

                        </div>

                    </div>

                    {{-- RIGHT: Info --}}
                    <div class="col-md-6">

                        <ul class="list-group">

                            <li class="list-group-item">
                                <strong>Size:</strong>
                                <span id="imageSize">-</span>
                            </li>

                            <li class="list-group-item">
                                <strong>Type:</strong>
                                <span id="imageType">-</span>
                            </li>

                            <li class="list-group-item">
                                <strong>Dimensions:</strong>
                                <span id="imageDimension">-</span>
                            </li>

                            <li class="list-group-item">
                                <strong>Shape:</strong>
                                <span id="imageShape">-</span>
                            </li>

                        </ul>

                        <hr>

                        <input type="file" id="doctorImageInput" class="form-control">

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-success" id="saveImageBtn">
                    Save Image
                </button>

                <button class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>

                <button class="btn btn-danger" id="cancelImageBtn">
                    Cancel
                </button>

            </div>

        </div>

    </div>

</div>
