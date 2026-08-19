<div class="patient-form">
    <div>
        <label>Full Name *</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div>
        <label>Age *</label>
        <input type="number" name="age" id="age" value="{{ old('age') }}">

        @error('age')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div>
        <label> Mobile Number *</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone') }}">

        @error('phone')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div>
        <label>Gender *</label>
        <select name="gender" id="gender">
            <option value="">Select</option>
            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
        </select>

        @error('gender')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="full-width">
        <label id="emailLabel">
            Email
            <span id="emailRequiredMark">(optional)</span>
        </label>

        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>
</div>
