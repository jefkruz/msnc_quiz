@extends('layouts.admin')

@section('scripts')
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script
@endsection


@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-lg-6">



                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Zone</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('zones.update', $zone->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('zone.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
