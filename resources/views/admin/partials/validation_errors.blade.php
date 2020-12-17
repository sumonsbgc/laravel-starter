<div class="mb-1 d-none" id="validate_error">
    <div class="col-12">
        <div class="card" id="errors">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="flex alert-danger">{{ $error }}</span>
                @endforeach
            @endif
        </div>
    </div>
</div>