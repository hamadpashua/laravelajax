<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top:45px">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Countries</div>
                    <div class="card-body">
                        ......
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-header">Add Country</div>
                <div class="card-body">
                    <form action="{{ route('add.countries') }}" id="add-countries-form" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="Country Name">Country Name</label>
                            <input type="text" name="country_name" id="" class="form-control" placeholder="Enter Country Name">
                            <span class="text-danger error-text country_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="Capital City">Capital City</label>
                            <input type="text" name="capital_city" id="" class="form-control" placeholder="Enter Capital City">
                            <span class="text-danger error-text capital_city_error"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-success" type="submit">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"> </script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>

    <script>
        toastr.options.preventDuplicate = true;
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('#add-countries-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data: new FormData(form),
                    processData:false,
                    dataType: 'json',
                    contentType:false,
                    beforeSend:function() {
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0])
                            });
                        } else {
                            $(form)[0].reset();
                            // alert(data.msg);
                            toastr.success(data.msg);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
