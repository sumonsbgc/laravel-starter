@extends('layouts.admin_app')

@section('content')
    <div class="content">
        <div class="flex mb-1">
            <div class="col-6">
                <h3 class="page-title">{{ $title ?? '' }}</h3>
            </div>
            <div class="col-6">
                <ul class="kr_breadcumb justify-end">
                    <li><a href="#">Home <i class="fas fa-angle-double-right"></i></a> </li>
                    <li><a href="{{ route("admin.user") }}" class="active">{{ $title ?? '' }}</a></li>
                </ul>
            </div>
        </div>

        @if(!empty(session()->has('status')))
            <div class="flex mb-1">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{ session()->get('message') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex mb-1">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Add New Role
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.role.store') }}" method="POST">
                            @csrf
                            <div class="my-1">
                                <label for="role_name" class="label">Role Name<span class="text-red">*</span></label>
                                <input type="text" id="role_name" name="name" class="sm-title @error('name') invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Admin" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Save Role">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        List role
                    </div>
                    <div class="card-body">
                        <table class="kr-table bordered my-1">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Role Name</th>
                                    <th>Nickname</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->nickname }}</td>
                                        <td>
                                            <a href="" class="btn shadow bg-warning mr-1" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="" class="btn shadow bg-red" title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection