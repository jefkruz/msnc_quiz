<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <label>Region</label>
            <select class="form-control select2" style="width: 100%;" name="region_id">
             @foreach($regions as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $zone->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>



    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
