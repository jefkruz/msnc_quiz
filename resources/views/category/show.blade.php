@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Category</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $category->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
