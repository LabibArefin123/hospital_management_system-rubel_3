  <div class="row">
      <div class="col-md-6">
          <div class="form-group">
              <label>
                  Doctor Name <span class="text-danger">**</span>
              </label>

              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                  value="{{ old('name') }}" placeholder="Enter doctor name">

              @error('name')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
      </div>

      <div class="col-md-6">
          <div class="form-group">
              <label>Speciality <span class="text-danger">**</span></label>

              <input type="text" name="speciality" class="form-control @error('speciality') is-invalid @enderror"
                  value="{{ old('speciality') }}" placeholder="Cardiology, Neurology...">

              @error('speciality')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
      </div>
  </div>
