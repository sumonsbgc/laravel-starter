<script>
    (function($){

        function showMessage(status, message){
            switch (status) {
                case 'success': {
                    toastr.success(message)
                    break;
                }
                case 'error': {
                    toastr.error(message)
                    break;
                }
            }

            setTimeout(() => {
                window.location.reload();                            
            }, 2000);
        }
        
        // Show Attribute Card Form
        $('#show_attr_card_btn').on('click', function(e){
            e.preventDefault();
            $('#add_attribute').fadeIn('slow');
            $('#edit_attribute').fadeOut('slow').addClass('mt-1');
        });
        
        // Show Edit Attribute Card
        $('.edit-attr').on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id');

            var url  = "{{ route('admin.attribute.edit', 'id') }}";
                url  = url.replace('id', id);

            axios.get(url)
                .then(res => {
                    var status = res.data.status;
                    var attribute = res.data.attribute;

                    if (status === 'success') {

                        $('#add_attribute').fadeOut('slow');
                        $('#edit_attribute').fadeIn('slow').removeClass('mt-1');

                        var option = $('#edit_attr_form select').find('option');

                        $('#edit_attr_form').find('input#name').val(attribute.name);
                        $('#edit_attr_form').find('input#attribute_id').val(attribute.id);

                        attribute.is_filterable === 1 ? $('#edit_attr_form').find('input#is_filterable').prop('checked', true) : $('#edit_attr_form').find('input#is_filterable').prop('checked', false);
                        option.filter( (i, el) => {
                            return $(el).val() === attribute.frontend_type ? $(el).prop('selected', true) : $(el).prop('selected', false);
                        });

                        var url = "{{ route('admin.attribute.update', 'id') }}"
                            url = url.replace('id', attribute.id);
                        $('#edit_attr_form').attr('action', url);
                    }
                })
                .catch( error => {
                    console.log(error.response);
                });
        });

        // Update Attribute Using Axios
        $('#update').on('click', function (e) {
            e.preventDefault();

            const id = $('#attribute_id').val();
            var url  = "{{ route('admin.attribute.update', 'id') }}";
                url  = url.replace('id', id);

            var myForm = document.getElementById('edit_attr_form');
            var data   = new FormData(myForm);

            axios.post(url, data)
                .then(res => {
                    if(res.data.status){
                        var status = res.data.status;
                        var message = res.data.message;

                        showMessage(status, message);

                        $('#add_attribute').removeClass('d-none').addClass('d-block');
                        $('#edit_attribute').removeClass('d-block').addClass('d-none');
                    }
                })
                .catch(error => console.log(error.response));
        });

        // Delete Attribute Using Axios
        $('.delete-attr').on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            var url = "{{ route('admin.attribute.delete', 'id') }}";
                url = url.replace('id', id);

            var data = new FormData();
                data.append('_token', "{{ csrf_token() }}");
                data.append('_method', "DELETE");

            axios.post(url, data)
                .then(res => {
                    if(res.data.status === 'success'){
                        status = res.data.status;
                        message = res.data.message;
                        showMessage(status, message);
                    }
                })
                .catch(error => console.log(error.response));

        });

        // Show Attribute Value Card
        $('.add_attr_value').on('click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#add_attr_value_card').fadeIn('slow');
            $('#edit_attr_value_card').fadeOut('slow');
            
            $('#add_attr_val_form').find('input#attribute_id').val(id);
        });

        // Add Attribute Value Using Axios
        $('#add_attr_val_form').on('submit', function(e){
            e.preventDefault();
            var myForm = document.getElementById('add_attr_val_form');
            var id = $('#add_attr_val_form').find('input#attribute_id').val();
            var url = "{{ route('admin.value.store') }}";

            var data = new FormData(myForm);
                data.append('attribute_id', id);

            axios.post(url, data)
                .then(res => {
                    if(res.data.status){
                        var status = res.data.status;
                        var message = res.data.message;
                        showMessage(status, message)
                    }
                })
                .catch(error => {
                    console.log(error.response);
                });
        });

        // Show Attribute Value Card
        $('.edit-attr-value').on('click', function(e){
            e.preventDefault();

            var id = $(this).data('id');
            $('#edit_attr_value_card').fadeIn('slow');
            $('#add_attr_value_card').fadeOut('fast');
            $('#edit_attr_val_form').find('input#value_id').val(id);

            var url  = "{{ route('admin.value.edit', 'id') }}";
                url  = url.replace('id', id);

            axios.get(url)
                .then( res => {
                    if ( res.status === 200 ) {
                        var value = res.data.data.value;
                        $('#edit_attr_val_form').find('input#value').val(value);
                    }
                })
                .catch( err => {
                    console.log(err.response);
                });

        });
        
        // Add Attribute Value Using Axios
        $('#edit_attr_val_form').on('submit', function(e){
            e.preventDefault();

            var myForm = document.getElementById('edit_attr_val_form');
            var id = $('#edit_attr_val_form').find('input#value_id').val();

            var url = "{{ route('admin.value.update', 'id') }}";            
                url = url.replace('id', id);

            var data = new FormData(myForm);

            axios.post(url, data)
                .then(res => {
                    if(res.data.status){

                        var status = res.data.status;
                        var message = res.data.message;
                        showMessage(status, message)

                    }
                })
                .catch(error => {
                    console.log(error.response);
                });
        });

    }(jQuery));
</script>