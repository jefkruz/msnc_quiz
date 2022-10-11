<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Portal  | Registration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition container" >
<div class="mt-5 ml-3 mr-3">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h1">
                <img src="{{asset('amdl.png')}}" height="60" alt="AMDL" />

            </a>
        </div>
        <div class="card-body">
            @include('includes.alerts')
            <p class="login-box-msg">Register to take Quiz </p>

            <form action="" method="post">
                @csrf
                <input type="hidden" name="rank_id" value="{{$rankname}}" required>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label>Select Title</label>
                            <select class="form-control select2" style="width: 100%;" name="title">

                                <option value="Brother" @if (old('title') == 'Brother') selected="selected" @endif>Brother</option>
                                <option value="Sister" @if (old('title') ==  'Sister') selected="selected" @endif>Sister</option>
                                <option value="Pastor" @if (old('title') == 'Pastor') selected="selected" @endif>Pastor</option>
                                <option value="Deacon" @if (old('title') == 'Deacon') selected="selected" @endif>Deacon</option>
                                <option value="Deaconess" @if (old('title') == 'Deaconess') selected="selected" @endif>Deaconess</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Full Name</label>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control" name="name" value="{{old('name')}}" >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Email Address</label>
                        <div class="input-group mb-3">

                            <input type="email" class="form-control"  value="{{old('email')}}" name="email" >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Phone Number</label>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control"  inputmode="tel" value="{{old('phone')}}" name="phone" >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>KingsChat Username</label>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control"   value="{{old('kc_username')}}" name="kc_username" >

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Current Church</label>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control"   value="{{old('church')}}" name="church">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Select Department</label>
                        <div class="input-group mb-3">

                            <select class="form-control select2" style="width: 100%;" name="department">
                                @foreach($departments as  $department)
                                    <option value="{{$department->id}}" @if (old('department') == $department->id) selected="selected" @endif>{{$department->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label>Select Job Family</label>
                            <select class="form-control select2" style="width: 100%;" name="job">


                                @foreach($jobs as  $job)
                                    <option value="{{$job->id}}" @if (old('job') == $job->id) selected="selected" @endif>{{$job->name}}</option>
                                    {{--                            <option value="{{$job->id}}">{{$job->name}}</option>--}}
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Select Region</label>
                        <div class="input-group mb-3">

                            <select   id="region" class="form-control select2"  style="width: 100%;" name="region">
                                @foreach($regions as  $data)
                                    <option value="{{$data->id}}" @if (old('region') == $data->id) selected="selected" @endif>{{$data->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Select Zone</label>
                        <div class="input-group mb-3">

                            <select  id="zone" class="form-control select2"   style="width: 100%;" name="zone">
                                @foreach($zones as  $data)
                                    <option value="{{$data->id}}" @if (old('region') == $data->id) selected="selected" @endif>{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>




                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">

                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $('#region').on('change', function () {
            var Region = this.value;
            $("#zone").html('');
            $.ajax({
                url: "{{url('quiz/zones')}}",
                method: "post",
                data: {
                    region: Region,
                    _token: '{{csrf_token()}}'
                },

                success: function (result) {
                    $('#zone').html('<option value="">Select Zone </option>');
                    $.each(result.zones, function (key, value) {
                        $("#zone").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });

                }
            });
        });

    });
</script>
</body>
</html>
