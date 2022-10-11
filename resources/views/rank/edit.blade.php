@extends('layouts.admin')

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-lg-6">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Rank</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ranks.update', $rank->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('rank.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
