@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Applicant</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('applicants.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $applicant->title }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $applicant->name }}
                        </div>
                        <div class="form-group">
                            <strong>Rank:</strong>
                            {{ $applicant->ranks->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $applicant->email }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $applicant->phone }}
                        </div>
                        <div class="form-group">
                            <strong>KingsChat Username:</strong>
                            {{ $applicant->kc_username }}
                        </div>
                        <div class="form-group">
                            <strong>Church:</strong>
                            {{ $applicant->church }}
                        </div>
                        <div class="form-group">
                            <strong>Zone:</strong>
                            {{ $applicant->zones->name }}
                        </div>
                        <div class="form-group">
                            <strong>Region:</strong>
                            {{ $applicant->regions->name }}
                        </div>
                        <div class="form-group">
                            <strong>Department:</strong>
                            {{ $applicant->departments->name }}
                        </div>
                        <div class="form-group">
                            <strong>Job:</strong>
                            {{ $applicant->jobs->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
