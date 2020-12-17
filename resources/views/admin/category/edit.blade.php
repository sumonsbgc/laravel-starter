@extends('layouts.admin_app')

@section('content')
    <div class="content">
        @include('admin.partials.page_title')
        @include('admin.partials.validation_errors')
        <div class="flex mb-1">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Add New Category
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update', $category->id ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="my-1">
                                <label for="name" class="label">Category Name<span class="text-red">*</span></label>
                                <input type="text" id="name" name="name" class="input-control @error('name') invalid @enderror" value="{{ old('name', $category->name ) }}" placeholder="Category" required>
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
                                    @foreach ($cats as $cat)
                                        <option value="{{ $cat->id }}" @if(!empty($category->parent_id)) {{ $category->parent_id === $cat->id ? 'selected' : '' }}  @endif>{{ $cat->name }}</option>
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
                                <textarea name="description" id="description" class="text-control @error('description') invalid @enderror">{{ old('description', $category->description ) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1">
                                <label for="featured" class="checkbox-label flex">
                                    <input type="checkbox" name="featured" id="featured" class="checkbox-control" {{ $category->featured === 1 ? 'checked' : '' }}> Featured
                                </label>
                            </div>
                            <div class="my-1">
                                <label for="menu" class="checkbox-label flex">
                                    <input type="checkbox" name="menu" id="menu" class="checkbox-control @error('menu') invalid @enderror" {{ $category->menu === 1 ? 'checked' : '' }}> Menu
                                </label>
                                @error('menu')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1">
                                <div class="col-9">
                                    <label for="image" class="label">Image</label>
                                    <input type="file" name="image" id="image" class="file-control @error('image') invalid @enderror">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <storng>{{ $message }}</storng>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    @if(!empty($category->image))
                                        <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}">
                                    @endif
                                </div>
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Update Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection