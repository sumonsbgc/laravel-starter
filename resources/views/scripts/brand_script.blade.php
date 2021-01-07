<script>
    ;(function($){

        $('.show-brand-edit-card').on('click', function(e){
            e.preventDefault();
            $("#brand-edit-card").fadeIn('slow');

            var id  = $(this).data('id');
            var url = "{{ route('admin.brand.edit', 'id') }}"
                url = url.replace('id', id);

            axios.get(url)
                .then(res => {
                    if(res.status === 200 && res.data.status === 'success'){
                        var brand = res.data.brand;

                        $("#brand-edit-form").find('input#name').val(brand.name);
                        $("#brand-edit-form").find('input#brand_id').val(brand.id);
                        
                        $("#brand-edit-form").find('img').attr('src', '');

                        if(brand.banner !== null && brand.banner !== undefined){
                            var banner_url = "{{ Storage::url('banner') }}";
                                banner_url = banner_url.replace('banner', brand.banner);
                                $("#brand-edit-form").find('#brand-banner').attr('src', banner_url);
                        }
                        
                        if(brand.logo !== null && brand.logo !== undefined){
                            var brand_logo_url = "{{ Storage::url('logo') }}";
                                brand_logo_url = brand_logo_url.replace('logo', brand.logo);
                                $("#brand-edit-form").find('#brand-logo').attr('src', brand_logo_url);
                        }

                        var action = "{{ route('admin.brand.update', 'id') }}";
                            action = action.replace('id', brand.id);
                            $('#brand-edit-form').attr('action', action);
                    }
               })
                .catch(err => {
                    console.log(err.response);
                })
        });

    }(jQuery));
</script>