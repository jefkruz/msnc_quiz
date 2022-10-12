<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('essay') }}
            {{ Form::text('essay', $essay->essay, ['class' => 'form-control' . ($errors->has('essay') ? ' is-invalid' : ''), 'placeholder' => 'Essay']) }}
            {!! $errors->first('essay', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>