@extends('layouts.admin_app')

@section('content')
    <div class="content">
        @include('admin.partials.page_title')
        @include('admin.partials.validation_errors')
        <div class="flex mb-1">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Add New Category
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-1">
                                <label for="name" class="label">Category Name<span class="text-red">*</span></label>
                                <input type="text" id="name" name="name" class="input-control @error('name') invalid @enderror" value="{{ old('name') }}" placeholder="Category" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <label for="parent_id" class="label">Parent Category<span class="text-red">*</span></label>
                                <select name="parent_id" id="parent_id" class="select-control select2 @error('parent_id') invalid @enderror" width="100%" required>
                                    <option value="0">Select Parent Category</option>
                                    @foreach ($cats as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <label for="description" class="label">Description</label>
                                <textarea name="description" id="description" class="text-control @error('description') invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1">
                                <label for="featured" class="checkbox-label flex">
                                    <input type="checkbox" name="featured" id="featured" class="checkbox-control"> Featured
                                </label>
                            </div>
                            <div class="my-1">
                                <label for="menu" class="checkbox-label flex">
                                    <input type="checkbox" name="menu" id="menu" class="checkbox-control @error('menu') invalid @enderror"> Menu
                                </label>
                                @error('menu')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1">
                                <label for="image" class="label">Image</label>
                                <input type="file" name="image" id="image" class="file-control @error('image') invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Save Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        List Category
                    </div>
                    <div class="card-body">
                        <table class="kr-table bordered my-1">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parent->name ?? '-'}}</td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $category->id ) }}" class="btn shadow bg-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.category.delete', $category->id) }}" class="btn shadow bg-red" title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $categories->links('common.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection