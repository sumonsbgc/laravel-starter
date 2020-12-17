<script>

    $('#country_id').select2({
        width: 'resolve',
        tags: "true",
        placeholder: "Select a country",
        allowClear: true
    });

    $('#city_id').select2({
        width: 'resolve',
        tags: "true",
        placeholder: "Select a city",
        allowClear: true
    });

    $('#country_id').on('change', function(e) {
        var url = "{{ route('city', 'id') }}";
        url = url.replace('id', e.target.value);

        axios.get(url)
            .then(res => {
                var option = '';
                res.data.forEach((city) => {
                    option += `<option value="${city.id}">${city.name}</option>`;
                });
                $("#city_id").html(option);
            });
    });

    $("#upload_profile").on("change", function(e) {
        e.preventDefault();

        var url = "{{ route('admin.profile_pic.upload') }}";

        const data = new FormData();
        const file = e.target.files[0];
        const id = "{{ $user->id }}";

        data.append('profile_pic', file);
        data.append('id', id);

        axios.post(
            url, 
            data,
            validateStatus = true
            ).then(res => {
                if (res.data.status) {

                    var status = res.data.status;
                    var message = res.data.message;
                    
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

                    if(res.data.fileName){
                        var fileName = res.data.fileName;
                        $('.profile-pic').children('img').attr('src', fileName);
                    }
                }

            }).catch(error => {                
                if(error.response){
                    var response = error.response;
                    var data = response.data.profile_pic;
                    if (data.length > 0) {
                        $("#validate_error").addClass('flex');

                        var errors = '';
                        data.forEach((item) => {
                            errors += `<span class="flex alert-danger">${item}</span>`
                        });

                        $("#errors").html(errors);
                    }
                }
            })
    });
</script>