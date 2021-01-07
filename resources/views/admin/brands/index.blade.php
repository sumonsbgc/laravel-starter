@extends('layouts.admin_app')

@section('content')
    <div class="content">
        @include('admin.partials.page_title')
        @include('admin.partials.validation_errors')
        <div class="flex mb-1">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Add New Brand
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-1">
                                <label for="name" class="label">Brand Name<span class="text-red">*</span></label>
                                <input type="text" id="name" name="name" class="input-control @error('name') invalid @enderror" value="{{ old('name') }}" placeholder="Brand" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1">
                                <label for="logo" class="label">Brand Logo</label>
                                <input type="file" name="logo" id="logo" class="file-control @error('logo') invalid @enderror">
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <label for="banner" class="label">Brand Banner</label>
                                <input type="file" name="banner" id="banner" class="file-control @error('banner') invalid @enderror">
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Save Brand">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        List Brands
                    </div>
                    <div class="card-body">
                        <table class="kr-table bordered my-1">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Brand Name</th>
                                    <th>Slug</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->index + 1 }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td>
                                            @if($brand->logo)
                                            <picture class="thumbnail tiny">
                                                <img src="{{ Storage::url($brand->logo) }}" alt="" class>
                                            </picture>                                        
                                            @else
                                            <small>{{ '-' }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.brand.edit', $brand->id ) }}" data-id="{{ $brand->id }}" class="btn shadow bg-warning show-brand-edit-card" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.brand.delete', $brand->id) }}" class="btn shadow bg-red" title="Delete" onclick="event.preventDefault(); document.getElementById('brand-delete').submit();">
                                                <i class="fas fa-trash"></i>
                                                <form action="{{ route('admin.brand.delete', $brand->id) }}" class="d-none" id="brand-delete" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $brands->links('common.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex mb-1 justify-center" id="brand-edit-card" style="display: none;">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        Edit Brand
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" id="brand-edit-form">
                            @csrf
                            @method('PUT')
                            <div class="my-1">
                                <label for="name" class="label">Brand Name<span class="text-red">*</span></label>
                                <input type="text" id="name" name="name" class="input-control @error('name') invalid @enderror" value="{{ old('name') }}" placeholder="Brand" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1">
                                <label for="logo" class="label">Brand Logo</label>
                                <input type="file" name="logo" id="logo" class="file-control @error('logo') invalid @enderror">
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                                <picture class="thumbnail small mt-1">
                                    <img src="" alt="{{ 'Brand Logo' }}" id="brand-logo">
                                </picture>
                            </div>

                            <div class="my-1">
                                <label for="banner" class="label">Brand Banner</label>
                                <input type="file" name="banner" id="banner" class="file-control @error('banner') invalid @enderror">
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                                <picture class="thumbnail small mt-1">
                                    <img src="" alt="{{ 'Brand Banner' }}" id="brand-banner">
                                </picture>
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Update Brand">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
@include('scripts.brand_script')
@endpush