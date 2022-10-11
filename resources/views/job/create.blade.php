@extends('layouts.admin')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-6">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Job Family</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('jobs.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('job.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
