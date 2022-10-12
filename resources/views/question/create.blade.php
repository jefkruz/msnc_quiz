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

        function displayAnswers(){
            const one = opt1.val().trim();
            const two = opt2.val().trim();
            const three = opt3.val().trim();
            const four = opt4.val().trim();

            let answers = [];
            if(one.length){
                answers.push(one);
            }
            if(two.length){
                answers.push(two);
            }
            if(three.length){
                answers.push(three);
            }
            if(four.length){
                answers.push(four);
            }

            let html = '';
            for(let i = 0; i < answers.length; i++){
                html += '<option value="' + i + '">' + answers[i] + '</option>';
            }

            answerSelect.html(html);
        }
    </script>
    @endsection
