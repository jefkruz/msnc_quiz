@extends('layouts.admin')



@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Rank</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ranks.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $rank->name }}
                        </div>
                        <div class="form-group">
                            <strong>Display Name:</strong>
                            {{ $rank->display_name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
