@extends('layouts.admin_app')

@section('content')
    <div class="content">
        @include('admin.partials.page_title')
        @include('admin.partials.validation_errors')
        <div class="flex mb-1">
            <div class="col-4">
                <div class="card" id="add_attribute">
                    <div class="card-header">
                        Add New Attribute
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.attribute.store') }}" method="POST">
                            @csrf
                            <div class="my-1">
                                <label for="name" class="label">Attribute Name<span class="text-red">*</span></label>
                                <input type="text" id="name" name="name" class="input-control @error('name') invalid @enderror" value="{{ old('name') }}" placeholder="eg. Color" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <?php $types = ['select' => 'Select Box', 'checkbox' => 'Checkbox', 'text' => 'Text Field'] ?>
                                <label for="frontend_type" class="label">Frontend Type</label>
                                <select name="frontend_type" id="frontend_type" class="select-control @error('frontend_type') invalid @enderror">
                                    <option value="">Select Frontend Type</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('frontend_type')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <label for="is_filterable" class="checkbox-label flex">
                                    <input type="checkbox" name="is_filterable" id="is_filterable" class="checkbox-control @error('is_filterable') invalid @enderror"> Filterable
                                </label>
                                @error('is_filterable')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Save Attribute">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-1 d-none" id="edit_attribute">
                    <div class="card-header">
                        Edit Attribute
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="edit_attr_form" class="">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="attribute_id" id="attribute_id" value="">
                            <div class="my-1">
                                <label for="name" class="label">Attribute Name<span class="text-red">*</span></label>
                                <input type="text" id="name" name="name" class="input-control @error('name') invalid @enderror" value="{{ old('name') }}" placeholder="eg. Color" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <?php $types = ['select' => 'Select Box', 'checkbox' => 'Checkbox', 'text' => 'Text Field']; ?>
                                <label for="frontend_type" class="label">Frontend Type</label>
                                <select name="frontend_type" id="frontend_type" class="select-control @error('frontend_type') invalid @enderror">
                                    <option value="">Select Frontend Type</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('frontend_type')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-1">
                                <label for="is_filterable" class="checkbox-label flex">
                                    <input type="checkbox" name="is_filterable" id="is_filterable" class="checkbox-control @error('is_filterable') invalid @enderror"> Filterable
                                </label>
                                @error('is_filterable')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" name="update" id="update" class="submit-control" value="Update Attribute">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header flex justify-between">
                        <span>List Attribute</span>
                        <button class="btn save-btn" id="show_attr_card_btn"><i class="fas fa-plus"></i> Add Attribute</button>
                    </div>
                    <div class="card-body">
                        <table class="kr-table bordered my-1">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Attribute Name</th>
                                    <th>Attribute Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attributes ?? [] as $attribute)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $attribute->name }}</td>
                                        <td>{{ $attribute->slug }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ $attribute->id }}" class="btn shadow bg-green add_attr_value" title="Add Attribute Value"><i class="fas fa-plus"></i> Add Value</a>
                                            <a href="javascript:void(0)" data-id="{{ $attribute->id }}" class="btn shadow bg-warning edit-attr" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" data-id="{{ $attribute->id }}" class="btn shadow bg-red delete-attr" title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $attributes->links('common.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex mb-1">
            <div class="col-4">
                <div class="card d-none" id="add_attr_value_card">
                    <div class="card-header">
                        Add Attribute Value
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="add_attr_val_form" class="add_attr_val_form">
                            @csrf
                            <input type="hidden" name="attribute_id" id="attribute_id" value="">
                            <div class="my-1">
                                <label for="value" class="label">Attribute Value Name <span class="text-red">*</span></label>
                                <input type="text" id="value" name="value" class="input-control @error('value') invalid @enderror" value="{{ old('value') }}" required>
                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Save Value">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card d-none" id="edit_attr_value_card">
                    <div class="card-header">
                        Edit Attribute Value
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="edit_attr_val_form" class="add_attr_val_form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="value_id" id="value_id" value="">
                            <div class="my-1">
                                <label for="value" class="label">Attribute Value Name<span class="text-red">*</span></label>
                                <input type="text" id="value" name="value" class="input-control @error('value') invalid @enderror" value="{{ old('value') }}" required>
                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <storng>{{ $message }}</storng>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-1 text-right">
                                <input type="submit" class="submit-control" value="Save Value">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        List Attribute Values
                    </div>
                    <div class="card-body">
                        <table class="kr-table bordered my-1">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Attribute Values</th>
                                    <th>Attribute Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($values ?? [] as $value)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $value->value }}</td>
                                        <td>{{ $value->attribute->name }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ $value->id }}" class="btn shadow bg-warning edit-attr-value" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" data-id="{{ $value->id }}" class="btn shadow bg-red delete-attr-value" title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $values->links('common.pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @include('scripts.attribute_script')
@endpush