@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Question</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('questions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Category:</strong>
                            {{ $question->cats->name }}
                        </div>
                        <div class="form-group">
                            <strong>Rank:</strong>
                            {{ $question->levels->display_name }}
                        </div>
                        <div class="form-group">
                            <strong>Question Type:</strong>
                            {{ $question->question_type }}
                        </div>
                        <div class="form-group">
                            <strong>Question:</strong>
                            {{ $question->question }}
                        </div>
                        <div class="form-group">
                            <strong>Option A:</strong>
                            {{ $question->optiona }}
                        </div>
                        <div class="form-group">
                            <strong>Option B:</strong>
                            {{ $question->optionb }}
                        </div>
                        <div class="form-group">
                            <strong>Option C:</strong>
                            {{ $question->optionc }}
                        </div>
                        <div class="form-group">
                            <strong>Option D:</strong>
                            {{ $question->optiond }}
                        </div>
                        <div class="form-group">
                            <strong>Answer:</strong>
                            {{ $question->answer }}
                        </div>
                        <div class="form-group">
                            <strong>Note:</strong>
                            {{ $question->note }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
