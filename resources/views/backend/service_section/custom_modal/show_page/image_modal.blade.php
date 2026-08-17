  @if ($doctor->image)
      <div class="modal fade" id="doctorImageInfoModal" tabindex="-1" role="dialog" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered" role="document">

              <div class="modal-content border-0 shadow-lg">

                  <div class="modal-header bg-info">

                      <h5 class="modal-title text-white">

                          <i class="fas fa-image mr-2"></i>
                          Doctor Image Information

                      </h5>

                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">

                          <span aria-hidden="true">
                              &times;
                          </span>

                      </button>

                  </div>

                  <div class="modal-body text-center">

                      {{-- LARGE IMAGE --}}
                      <img src="{{ asset($doctor->image) }}" class="img-fluid rounded shadow mb-4"
                          style="
                            max-height: 300px;
                            object-fit: cover;
                         ">

                      {{-- IMAGE INFO --}}
                      <div class="table-responsive">

                          <table class="table table-bordered table-hover">

                              <tbody>

                                  <tr>

                                      <th width="40%">
                                          File Name
                                      </th>

                                      <td id="imageFileName">
                                          Loading...
                                      </td>

                                  </tr>

                                  <tr>

                                      <th>
                                          Dimensions
                                      </th>

                                      <td id="imageDimensions">
                                          Loading...
                                      </td>

                                  </tr>

                                  <tr>

                                      <th>
                                          Format
                                      </th>

                                      <td id="imageFormat">
                                          Loading...
                                      </td>

                                  </tr>

                                  <tr>

                                      <th>
                                          Shape
                                      </th>

                                      <td id="imageShape">
                                          Loading...
                                      </td>

                                  </tr>

                              </tbody>

                          </table>

                      </div>

                  </div>

                  <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">

                          Close

                      </button>

                  </div>

              </div>

          </div>

      </div>
  @endif
