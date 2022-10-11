@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-8">



                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Applicant</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('applicants.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('applicant.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
