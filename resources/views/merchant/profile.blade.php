@extends('layouts.merchant_app')

@section('content')
<div class="content">
    <div class="flex mb-1">
        <div class="col-6">
            <h3 class="page-title">Profile</h3>
        </div>
        <div class="col-6">
            <ul class="kr_breadcumb justify-end">
                <li>Home \ </li>
                <li><a href="{{ route("merchant.profile") }}"> Profile</a></li>
            </ul>
        </div>
    </div>

    <div class="flex mb-1">
        <div class="col-3">
            <div class="card">
                <div class="card-header">Header</div>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, cupiditate!
                </div>
                <div class="card-footer">Footer</div>
            </div>
        </div>

        <div class="col-9">
            <div class="card">
                <div class="card-header">Header</div>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, cupiditate!
                </div>
                <div class="card-footer">Footer</div>
            </div>
        </div>

    </div>
</div>    
@endsection