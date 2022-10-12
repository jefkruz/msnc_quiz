@extends('layouts.app')

@section('template_title')
    {{ $essay->name ?? 'Show Essay' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Essay</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('essays.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Essay:</strong>
                            {{ $essay->essay }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
