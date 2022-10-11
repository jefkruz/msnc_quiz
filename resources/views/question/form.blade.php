<div class="">
    <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Category</label>
                    <select class="form-control select2" style="width: 100%;" name="category_id">
                        <option value="">{{$question->cats->name?? '--Select Category--'}}</option>
                        @foreach($categories as $category)

                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Select Rank</label>
                    <select class="form-control select2" style="width: 100%;" name="rank_id">
                        <option value="">{{$question->levels->display_name?? '--Select Rank--'}}</option>
                        @foreach($ranks as $rank)

                            <option value="{{$rank->id}}">{{$rank->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('question') }}
                    <textarea class="form-control" rows="3" name="question" placeholder="Enter ...">{{$question->question}}</textarea>

                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('option a') }}
                    {{ Form::text('optiona', $question->optiona, ['class' => 'form-control' . ($errors->has('optiona') ? ' is-invalid' : ''), 'placeholder' => 'Optiona']) }}
                    {!! $errors->first('optiona', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('option b') }}
                    {{ Form::text('optionb', $question->optionb, ['class' => 'form-control' . ($errors->has('optionb') ? ' is-invalid' : ''), 'placeholder' => 'Optionb']) }}
                    {!! $errors->first('optionb', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('option c') }}
                    {{ Form::text('optionc', $question->optionc, ['class' => 'form-control' . ($errors->has('optionc') ? ' is-invalid' : ''), 'placeholder' => 'Optionc']) }}
                    {!! $errors->first('optionc', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('option d') }}
                    {{ Form::text('optiond', $question->optiond, ['class' => 'form-control' . ($errors->has('optiond') ? ' is-invalid' : ''), 'placeholder' => 'Optiond']) }}
                    {!! $errors->first('optiond', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>


        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('answer') }}
                {{ Form::text('answer', $question->answer, ['class' => 'form-control' . ($errors->has('answer') ? ' is-invalid' : ''), 'placeholder' => 'Answer']) }}
                {!! $errors->first('answer', '<div class="invalid-feedback">:message</div>') !!}
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
