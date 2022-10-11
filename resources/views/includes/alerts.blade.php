@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
        <span class="alert-inner--text"><strong>Oops!</strong>  {{session('error')}}</span>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>


@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
        <span class="alert-inner--text"><strong>Success!</strong> {{session('success')}}</span>
        <button type="button" class="close" data-bs-dismiss="alert" >
            <span aria-hidden="true">×</span>
        </button>
    </div>

@endif
@if($errors->any())

    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">

        <span class="alert-inner--text">
            @foreach($errors->all()  as $error)
                <li>{{$error}}</li>
            @endforeach</span>

    </div>

@endif
