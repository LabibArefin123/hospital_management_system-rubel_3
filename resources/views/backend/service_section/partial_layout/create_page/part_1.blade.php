 <div class="row">

     <div class="form-group col-md-6">

         <label>Title</label>

         <input type="text" name="title" value="{{ old('title') }}"
             class="form-control @error('title') is-invalid @enderror">

         @error('title')
             <span class="text-danger">
                 {{ $message }}
             </span>
         @enderror

     </div>

     {{-- PRICE --}}
     <div class="form-group col-md-6">

         <label>Price</label>

         <input type="number" step="0.01" name="price" value="{{ old('price') }}"
             class="form-control @error('price') is-invalid @enderror">

         @error('price')
             <span class="text-danger">
                 {{ $message }}
             </span>
         @enderror

     </div>
 </div>
 {{-- TITLE --}}
 {{-- DESCRIPTION --}}
 <div class="form-group">

     <label>Description</label>

     <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>

     @error('description')
         <span class="text-danger">
             {{ $message }}
         </span>
     @enderror

 </div>
