@extends('layouts.admin_app')

@section('content')
    <div class="content">
        
        @include('admin.partials.page_title')
        @include('admin.partials.validation_errors')

        <div class="flex mb-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-purple">{{ 'Add New Account' }}</div>
                    <div class="card-body py-2">
                        <form action="{{ route('admin.user.store') }}" method="POST">
                            @csrf

                            <div class="flex justify-center mb-2">
                                <div class="col-6">
                                    <label for="first_name" class="label">First Name</label>
                                    <input type="text" name="first_name" class="input-control @error('first_name') invalid @enderror" id="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                    
                                </div>
                                <div class="col-6">
                                    <label for="last_name" class="label">Last Name</label>
                                    <input type="text" name="last_name" class="input-control @error('last_name') invalid @enderror" id="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="col-4">
                                    <label for="email" class="label">Email Address</label>
                                    <input type="text" name="email" class="input-control @error('email') invalid @enderror" id="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="mobile" class="label">Mobile</label>
                                    <input type="text" name="mobile" class="input-control @error('mobile') invalid @enderror" id="mobile" value="{{ old('mobile') }}" required>
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="user_name" class="label">Username</label>
                                    <input type="text" name="user_name" class="input-control @error('user_name') invalid @enderror" id="user_name" value="{{ old('user_name') }}" required>
                                    @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="col-6">
                                    <label for="password" class="label">Password</label>
                                    <input type="password" name="password" class="input-control @error('password') invalid @enderror" id="password" value="" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="password" class="label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="input-control @error('password_confirmation') invalid @enderror" id="password" value="" required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="col-3">
                                    <label for="birth_date" class="label">Birthdate</label>
                                    <input type="text" name="birth_date" class="input-control datepicker @error('birth_date') invalid @enderror" id="birth_date" value="{{ old('birth_date') }}" placeholder="YYYY-MM-DD" required>
                                    @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <?php $genders = [1 => 'Male', 2 => 'Female', 3 => 'Other']; ?>
                                    <label for="gender" class="label">Gender</label>
                                    <select name="gender" id="gender" class="select-control" required>
                                        <option value="">Please Select</option>
                                        @foreach ($genders as $key => $gender)
                                            <option value="{{ $key }}" {{ $key == old('gender') ? 'selected' : '' }}>{{ $gender }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="country_id" class="label">Country</label>
                                    <?php $countries = \DB::table('countries')
                                    ->select('*')
                                    ->get(); ?>
                                    <div class="px-0">
                                        <select name="country_id" id="country_id" class="select-control country_id" style="width:100%;">
                                            <option value="">Please Select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ $country->id === old('country_id') ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="city_id" class="label">City</label>
                                    <div class="px-0">
                                        <select name="city_id" id="city_id" class="select-control city_id" style="width:100%;">
                                            <option value="">Please select a city</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="flex mb-2">
                                <div class="col-4">
                                    <label for="role" class="label">Assign Role</label>
                                    <?php
                                        $roles = \DB::table('roles')->get();
                                        $role_id = old('role');
                                    ?>
                                    <select name="role" id="role" class="select-control col-8" required>
                                        <option value="">Please Assign Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id ?? '' }}" {{ $role->id === $role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-8">
                                    <label for="address" class="label">Address</label>
                                    <textarea name="address" id="address" class="text-control @error('address') invalid @enderror">{{ old('address') }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="flex">
                                <div class="col-3"></div>
                                <div class="col-9 text-right">
                                    <input type="submit" class="submit-control" value="Save">
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>

        $('#country_id').select2({
            width: 'resolve',
            tags: "true",
            placeholder: "Select a country",
            allowClear: true
        });

        $('#city_id').select2({
            width: 'resolve',
            tags: "true",
            placeholder: "Select a city",
            allowClear: true
        });

        $('#country_id').on('change', function(e) {
            var url = "{{ route('city', 'id') }}";
            url = url.replace('id', e.target.value);

            axios.get(url)
                .then(res => {
                    var option = '';
                    res.data.forEach((city) => {
                        option += `<option value="${city.id}">${city.name}</option>`;
                    });
                    $("#city_id").html(option);
                });
        });
    </script>
@endpush