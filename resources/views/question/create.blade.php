@extends('layouts.admin')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Question</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('questions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('question.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const answerSelect = $('#answer');
        const opt1 = $('#option-0');
        const opt2 = $('#option-1');
        const opt3 = $('#option-2');
        const opt4 = $('#option-3');

        opt1.on('keyup', function(){
            displayAnswers();
        });
        opt2.on('keyup', function(){
            displayAnswers();
        });
        opt3.on('keyup', function(){
            displayAnswers();
        });
        opt4.on('keyup', function(){
            displayAnswers();
        });

        function displayAnswers(){}
    </script>
    @endsection
