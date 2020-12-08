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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        All Users
                    </div>
                    <div class="card-body">
                        <table class="kr-table bordered my-1">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.edit', Auth::user()->id ) }}" class="btn shadow bg-warning mr-1" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.user.delete', Auth::user()->id ) }}" class="btn shadow bg-red" title="Delete"><i class="fas fa-trash"></i></a>
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