@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-5">


                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Department</span>
                    </div>
                    <div class="card-body">
                        @include('includes.alerts')
                        <form method="POST" action="{{ route('departments.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('department.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
