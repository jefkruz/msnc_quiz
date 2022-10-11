<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $applicant->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $applicant->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $applicant->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('phone') }}
            {{ Form::text('phone', $applicant->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Phone']) }}
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('kc_username') }}
            {{ Form::text('kc_username', $applicant->kc_username, ['class' => 'form-control' . ($errors->has('kc_username') ? ' is-invalid' : ''), 'placeholder' => 'Kc Username']) }}
            {!! $errors->first('kc_username', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('church') }}
            {{ Form::text('church', $applicant->church, ['class' => 'form-control' . ($errors->has('church') ? ' is-invalid' : ''), 'placeholder' => 'Church']) }}
            {!! $errors->first('church', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('zone') }}
            {{ Form::text('zone', $applicant->zone, ['class' => 'form-control' . ($errors->has('zone') ? ' is-invalid' : ''), 'placeholder' => 'Zone']) }}
            {!! $errors->first('zone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('region') }}
            {{ Form::text('region', $applicant->region, ['class' => 'form-control' . ($errors->has('region') ? ' is-invalid' : ''), 'placeholder' => 'Region']) }}
            {!! $errors->first('region', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('department') }}
            {{ Form::text('department', $applicant->department, ['class' => 'form-control' . ($errors->has('department') ? ' is-invalid' : ''), 'placeholder' => 'Department']) }}
            {!! $errors->first('department', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('job') }}
            {{ Form::text('job', $applicant->job, ['class' => 'form-control' . ($errors->has('job') ? ' is-invalid' : ''), 'placeholder' => 'Job']) }}
            {!! $errors->first('job', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>