@extends('layouts.main')

@section('content')


    @if($quiz_taken)
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>You have completed your exam</h3>
                        </div>
                        <div class="col-md-4">
                            <i class="fa-pull-right fa fa-trophy fa-3x"></i>
                            <br>
                            <h1 class="fa-pull-right"><small class="text-warning">Your score:</small> 70%</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <ul class="list-group text-center">
                <li class="list-group-item bg-dark"><i class="fa fa-exclamation-triangle"></i> IMPORTANT INFO</li>
                <li class="list-group-item">Examination is for {{$display}}</li>
                <li class="list-group-item">Make sure you have steady internet connection</li>
                <li class="list-group-item text-danger">
                    We implemented a security feature to detect browser change. <br>
                    Please do not open a new tab while exam is going on. <br>
                    Do not minimise your browser for any reason.
                </li>
                <li class="list-group-item">Failure to comply would result in exam disqualification.</li>
                <li class="list-group-item">Click on <strong class="text-danger"><i class="fa fa-scroll"></i> START EXAM</strong> once you're ready</li>
                <li class="list-group-item">All the Best!!!</li>
            </ul>
        </div>
        <div class="col-md-12 mt-5 text-center">
            <a href="{{route('quiz.start')}}" class="btn btn-danger"><i class="fa fa-scroll"></i> START EXAM</a>
        </div>
    </div>
    @endif

    @endsection
