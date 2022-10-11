@extends('layouts.admin')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Job</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('jobs.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $job->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
