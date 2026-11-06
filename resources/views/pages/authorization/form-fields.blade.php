@isset($firstName)
    <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" value="{{ old('firstName') }}" name="firstName" class="form-control" placeholder="Enter your first name">
    </div>
    @error('firstName')
    <p class="error">{{ $message }}</p>
    @enderror
@endisset

@isset($lastName)
    <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" value="{{ old('lastName') }}" name="lastName" class="form-control" placeholder="Enter your last name">
    </div>
    @error('lastName')
    <p class="error">{{ $message }}</p>
    @enderror
@endisset

<div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Enter email">
</div>
@error('email')
<p class="error">{{ $message }}</p>
@enderror

<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter password">
</div>
@error('password')
<p class="error">{{ $message }}</p>
@enderror

@isset($passwordConfirmation)
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
    </div>
    @error('password_confirmation')
    <p class="error">{{ $message }}</p>
    @enderror
@endisset
