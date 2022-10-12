<div class="">
    <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Category</label>
                    <select class="form-control select2" name="category_id" required>
                        <option value="">{{$question->cats->name ?? '--Select Category--'}}</option>
                        @foreach($categories as $category)

                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Select Rank</label>
                    <select class="form-control select2" name="rank_id">
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
                    </label>
                    {{ Form::text('option[]', "", ['id' => 'option-' . $i, 'class' => 'form-control' . ($errors->has('option[]') ? ' is-invalid' : ''), 'placeholder' => 'Option ' . $label]) }}
                    {!! $errors->first('option[]', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        @endforeach


        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('answer') }}
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
