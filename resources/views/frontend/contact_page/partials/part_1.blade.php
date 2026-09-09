 <div class="contact-form-box">
     <h4>Send Message</h4>

     {{-- SUCCESS MESSAGE --}}
     @if (session('success'))
         <div class="alert alert-success">
             {{ session('success') }}
         </div>
     @endif

     <form action="{{ route('contact.store') }}" method="POST">
         @csrf

         {{-- Row 1 --}}
         <div class="form-row">

             <div class="form-group col-md-12">
                 <label>Full Name</label>
                 <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name') }}">

                 @error('name')
                     <small class="text-danger">{{ $message }}</small>
                 @enderror
             </div>

             <div class="form-group col-md-12">
                 <label>Email</label>
                 <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}">
                 @error('email')
                     <small class="text-danger">{{ $message }}</small>
                 @enderror
             </div>

         </div>

         <div class="form-row">
             <div class="form-group col-md-12">
                 <label>Phone</label>
                 <input type="text" name="phone"
                     class="global-mobile-input form-control @error('phone') is-invalid @enderror"
                     value="{{ old('phone') }}" placeholder="01XXXXXXXXX">
                 @error('phone')
                     <small class="text-danger">{{ $message }}</small>
                 @enderror
             </div>

             <div class="form-group col-md-12">
                 <label for="department">Department</label>

                 <select name="department" id="department"
                     class="form-control @error('department') is-invalid @enderror">

                     <option value="">Select Department</option>

                     @foreach ($doctors as $doctor)
                         <option value="{{ $doctor->speciality }}"
                             {{ old('department') == $doctor->speciality ? 'selected' : '' }}>
                             {{ $doctor->speciality }}
                         </option>
                     @endforeach

                 </select>

                 @error('department')
                     <small class="text-danger">{{ $message }}</small>
                 @enderror
             </div>
         </div>

         {{-- Service --}}
         <div class="form-group">
             <label for="service">Service</label>

             <select name="service" id="service" class="form-control @error('service') is-invalid @enderror">

                 <option value="">Select Service</option>

                 @foreach ($services as $service)
                     <option value="{{ $service->title }}" {{ old('service') == $service->title ? 'selected' : '' }}>
                         {{ $service->title }}
                     </option>
                 @endforeach

             </select>

             @error('service')
                 <small class="text-danger">{{ $message }}</small>
             @enderror
         </div>

         {{-- Message --}}
         <div class="form-group">
             <label>Message</label>

             <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>

             @error('message')
                 <small class="text-danger">{{ $message }}</small>
             @enderror
         </div>

         <button type="submit" class="btn btn-success">
             Send Message
         </button>
     </form>
 </div>
