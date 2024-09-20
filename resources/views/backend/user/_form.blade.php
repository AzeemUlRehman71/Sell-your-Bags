<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
            <input type="text" id="name" class="form-control @error('name') is-invalid state-invalid @enderror" value="{{ isset($user->name) ? $user->name : old('name') }}" name="name" required placeholder="Enter Name...">

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            <label for="email" class="form-label">Email <b class="text-danger">*</b></label>
            <input type="email" id="email" class="form-control @error('email') is-invalid state-invalid @enderror" {{-- value="@isset($user->email) {{ $user->email }} @endisset{{ old('email') }}" --}} value="{{ isset($user->email) ? $user->email : old('email') }}" name="email" required placeholder="Enter Email...">

            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="col-md-4">
            <label for="utype" class="form-label">User Type <b class="text-danger">*</b></label>
            <select id="utype" class="form-control @error('utype') is-invalid state-invalid @enderror select" name="utype"
                required value="{{ old('utype') }}">
        <option value="" selected disabled>Select Option</option>

        <option value="USR" selected>Normal User</option>

        <option value="ADM">
            Admin</option>
        </select>

        @error('utype')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div> --}}
    <div class="col-md-3">
        <label for="password" class="form-label">Password <b class="text-danger">*</b></label>
        <input type="password" id="password" class="form-control @error('password') is-invalid state-invalid @enderror" name="password" placeholder="Password">

        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="password_confirmation" class="form-label">Confirm Password <b class="text-danger">*</b></label>
        <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid state-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">

        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="user_role" class="form-label">User Role<b class="text-danger">*</b></label>
        <select class="form-control" name="user_role" required id="user_role">
            <option value="option_select">Select User Role</option>
            @foreach($user_role as $role)
            <option value="{{ $role->user_role }}" {{ $user->user_role == $role->user_role ? 'selected' : ''}}>
                {{ $role->user_role}}
            </option>
            @endforeach
        </select>
        @error('user_role')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
</div>

<div class="clearfix" style="margin-top: 20px;"></div>