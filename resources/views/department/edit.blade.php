@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-lg-5">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Department</span>
                    </div>
                    <div class="card-body">
                        @include('includes.alerts')
                        <form method="POST" action="{{ route('departments.update', $department->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('department.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
