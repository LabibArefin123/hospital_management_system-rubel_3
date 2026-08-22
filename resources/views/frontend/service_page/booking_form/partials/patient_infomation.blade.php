<div class="service-patient-form">

    {{-- NAME --}}
    <div>

        <label for="serviceName">
            Full Name *
        </label>

        <input type="text" name="name" id="serviceName" value="{{ old('name') }}" autocomplete="name">

        @error('name')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>


    {{-- AGE --}}
    <div>

        <label for="serviceAge">
            Age *
        </label>

        <input type="number" name="age" id="serviceAge" value="{{ old('age') }}" min="1" max="120">

        @error('age')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>


    {{-- MOBILE --}}
    <div>

        <label for="servicePhone">
            Mobile Number *
        </label>

        <input type="text" name="phone" id="servicePhone" class="global-mobile-input" value="{{ old('phone') }}"
            autocomplete="tel" inputmode="numeric" maxlength="11">

        @error('phone')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>

    {{-- GENDER --}}
    <div>

        <label for="serviceGender">
            Gender *
        </label>

        <select name="gender" id="serviceGender">
            <option value="">
                Select
            </option>

            <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>
                Male
            </option>

            <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>
                Female
            </option>
        </select>

        @error('gender')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>


    {{-- EMAIL --}}
    <div class="service-form-full-width">

        <label for="serviceEmail">
            Email
            <span id="serviceEmailRequiredMark">
                (optional)
            </span>
        </label>

        <input type="email" name="email" id="serviceEmail" value="{{ old('email') }}" autocomplete="email">

        @error('email')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror

    </div>

</div>
