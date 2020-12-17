@extends('layouts.admin_app')

@section('content')
    <div class="content">

        @include('admin.partials.page_title')
        @include('admin.partials.validation_errors')

        <div class="flex mb-1">
            <div class="col-3">
                <div class="card">
                    <div class="card-body profile-card p-0">
                        <div class="profile-pic flex-center flex-column py-2">
                            @if(!empty($user->profile_pic))
                                <img src="{{ Storage::url($user->profile_pic) }}" alt="{{ $user->name }}">
                            @else
                                <img src="{{ asset('assets/images/male_demo_profile.jpg') }}" alt="{{ $user->name }}">
                            @endif                            
                            <input type="file" name="profile_pic" class="upload_profile" id="upload_profile">
                            <h3>{{ $user->name }}</h3>
                        </div>
                        <div class="profile-info p-2">
                            <table class="kr-table">
                                <tbody>
                                    <tr>
                                        <td>Email</td>
                                        <td> {{ $user->email }} </td>
                                    </tr>
                                    <tr>
                                        <td>User Name</td>
                                        <td> {{ $user->user_name }} </td>
                                    </tr>
                                    @if (!empty($user->mobile))
                                        <tr>
                                            <td>Mobile</td>
                                            <td> {{ $user->mobile }} </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="card">
                    <div class="card-header">{{ $user->name . '\'s Account' }}</div>
                    <div class="card-body py-2">

                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="tab-container px-3 pb-1">
                                <ul class="tab-filter mb-2">
                                    <li class="col-3 text-center"><a class="active pb-1" href="javascript:void"
                                            data-target="general">General Information</a></li>
                                    <li class="col-3 text-center"><a class="pb-1" href="javascript:void"
                                            data-target="address">Address Information</a></li>
                                    <li class="col-3 text-center"><a class="pb-1" href="javascript:void"
                                            data-target="profile_pic">Profile Picture</a></li>
                                    {{-- <li class="col-3 text-center"><a class="pb-1"
                                            href="javascript:void" data-target="social">Social Information</a></li>
                                    --}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-section" id="general">

                                        <div class="flex my-2">
                                            <label for="first_name" class="col-3 label">First Name</label>
                                            <input type="text" name="first_name" class="input-control col-8" id="first_name"
                                                value="{{ old('first_name', $user->first_name ?? '') }}" required>
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="last_name" class="col-3">Last Name</label>
                                            <input type="text" name="last_name" class="input-control col-8" id="last_name"
                                                value="{{ old('last_name', $user->last_name ?? '') }}" required>
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="email" class="col-3 label">Email Address</label>
                                            <input type="text" name="email" class="input-control col-8" id="email"
                                                value="{{ old('email', $user->email ?? '') }}" required>
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="mobile" class="col-3 label">Mobile</label>
                                            <input type="text" name="mobile" class="input-control col-8 @error('mobile') invalid @enderror" id="mobile" value="{{ old('mobile', $user->mobile ?? '') }}" required>
                                            @error('mobile')
                                                <span class="invalid-feedback offset-3 col-9" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="user_name" class="col-3 label">Username</label>
                                            <input type="text" name="user_name" class="input-control col-8" id="user_name"
                                                value="{{ old('user_name', $user->user_name ?? '') }}" required>
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="birth_date" class="col-3 label">Birthdate</label>
                                            <input type="text" name="birth_date" class="input-control col-8 datepicker"
                                                id="birth_date" value="{{ old('birth_date', $user->birth_date ?? '') }}" placeholder="YYYY-MM-DD"
                                                required>
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="role" class="col-3 label">Assign Role</label>
                                            <?php
                                            $roles = \DB::table('roles')->get();
                                            $role_id = $user->roles[0]->id;
                                            ?>
                                            <select name="role" id="role" class="select-control col-8">
                                                <option value="">Please Assign Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id ?? '' }}"
                                                        {{ $role->id === $role_id ? 'selected' : '' }}>{{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex mb-2">
                                            <?php $genders = [1 => 'Male', 2 => 'Female', 3 => 'Other']; ?>
                                            <label for="gender" class="col-3 label">Gender</label>
                                            <select name="gender" id="gender" class="select-control col-8">
                                                <option value="">Please Select</option>
                                                @foreach ($genders as $key => $gender)
                                                    <option value="{{ $key }}"
                                                        {{ $key == $user->gender ? 'selected' : '' }}>{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                    <div class="tab-section" id="address">
                                        <div class="flex my-2">
                                            <label for="country_id" class="col-3 label">Country</label>
                                            <?php $countries = \DB::table('countries')
                                            ->select('*')
                                            ->get(); ?>
                                            <div class="col-8 px-0">
                                                <select name="country_id" id="country_id" class="select-control country_id"
                                                    style="width:100%;">
                                                    <option value="">Please Select</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ $country->id === $user->country_id ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="city_id" class="col-3 label">City</label>
                                            <div class="col-8 px-0">
                                                <select name="city_id" id="city_id" class="select-control city_id"
                                                    style="width:100%;">
                                                    <option value="">Please select a city</option>

                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $city->id === $user->city_id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex mb-2">
                                            <label for="address" class="col-3 label">Address</label>
                                            <textarea name="address" id="address"
                                                class="text-control col-8">{{ old('address', $user->address ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-section" id="social"></div>
                                </div>
                            </div>

                            <div class="flex px-3">
                                <div class="col-3"></div>
                                <div class="col-8 text-right">
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
    @include('scripts.user_script')
@endpush