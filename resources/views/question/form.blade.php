<div class="">
    <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Category</label>
                    <select class="form-control select2" name="category_id" required>
                        <option value="">--Select category--</option>
                        @foreach($categories as $category)
                            <option {{($category->id == $question->category_id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Select Rank</label>
                    <select class="form-control select2" name="rank_id">
                        <option value="">--Select Rank--</option>
                        @foreach($ranks as $rank)

                            <option value="{{$rank->id}}">{{$rank->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('question') }}
                    <textarea class="form-control" rows="3" name="question" placeholder="Enter ..." required>{{$question->question}}</textarea>

                </div>
            </div>

        @foreach($labels as $i => $label)
            <div class="col-md-3">
                <div class="form-group">
                    <label>
                        Option {{$label}}
                        @if($i > 1)
                        <small class="text-danger">Optional</small>
                            @endif

                        @if(isset($options))
                            @php

                                $value = (array_key_exists($i, $options)) ? $options[$i] : '';
                            @endphp
                        @endif


                    </label>
                    <input type="text" class="form-control" name="options[]" value="{{$value ?? ''}}" id="option-{{$i}}" placeholder="Option {{$label}}">
                </div>
            </div>
        @endforeach


        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('answer') }}
                <input type="hidden" id="selectedAnswer" value="{{$question->answer}}">
                <select name="answer" id="answer" class="form-control" required></select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('note') }}
                {{ Form::text('note', $question->note, ['class' => 'form-control' . ($errors->has('note') ? ' is-invalid' : ''), 'placeholder' => 'Note']) }}
                {!! $errors->first('note', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>




    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>


@section('scripts')
    <script>
        const selectedAnswer = $('#selectedAnswer');
        const answerSelect = $('#answer');
        const opt1 = $('#option-0');
        const opt2 = $('#option-1');
        const opt3 = $('#option-2');
        const opt4 = $('#option-3');

        displayAnswers();

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
                const sel = (Number(selectedAnswer.val()) === i) ? 'selected' : '';

                html += '<option ' + sel + ' value="' + i + '">' + answers[i] + '</option>';
            }

            answerSelect.html(html);
        }
    </script>
@endsection
