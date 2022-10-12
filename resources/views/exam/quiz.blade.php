@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-7"></div>
        <div class="col-5">
            <div class="card" style="position: fixed; top: 100px; right:40px; z-index:100; color:white; background-color: rgba(163, 10, 43,0.7)">
                <div class="card-body text-center">
                    <small>Time Remaining:</small>
                    <h3><i class="fa fa-clock"></i> <span id="hour">-</span>:<span id="minute">--</span>:<span id="seconds">--</span></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-10 offset-1">
            @foreach($categories as $category)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-bold"><small>Category:</small> {{$category}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @for($i = 1; $i <= 10; $i++)
                        <div class="col-12">
                            <span>{{'Q' . $i}}.</span>
                            <h5 class="text-bold">How many ladies are tripping for Joseph Ugbeva?</h5>
                            <div class="form-group">
                                @for($j = 1; $j <= 4; $j++)
                                <div class="form-check">
                                    <input class="form-check-input" id="{{$category}}-{{$i}}-{{$j}}" type="radio" name="{{$category}}-{{$i}}">
                                    <label for="{{$category}}-{{$i}}-{{$j}}" class="form-check-label">Option {{$j}}</label>
                                </div>
                                @endfor
                            </div>

                            <hr>
                        </div>
                            @endfor
                        @if($category == 'English')
                            <div class="col-12">
                                <strong>Read the essay below and answer the following questions:</strong>
                                <p class="m-3">{{$essay}}</p>
                            </div>
                                @for($i = 11; $i <= 20; $i++)
                                    <div class="col-12">
                                        <span>{{'Q' . $i}}.</span>
                                        <h5 class="text-bold">How many ladies are tripping for Joseph Ugbeva?</h5>
                                        <div class="form-group">
                                            @for($j = 1; $j <= 4; $j++)
                                                <div class="form-check">
                                                    <input class="form-check-input" id="{{$category}}-{{$i}}-{{$j}}" type="radio" name="{{$category}}-{{$i}}">
                                                    <label for="{{$category}}-{{$i}}-{{$j}}" class="form-check-label">Option {{$j}}</label>
                                                </div>
                                            @endfor
                                        </div>

                                        <hr>
                                    </div>
                                @endfor
                            @endif
                    </div>
                </div>
            </div>
                @endforeach
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-12 text-center">
            <button class="btn btn-primary">Submit Exam</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const timer = $('#timer');
        const hourSpan = $('#hour');
        const minuteSpan = $('#minute');
        const secondSpan = $('#seconds');

        // Get integer value of what PHP returns as duration
        let duration = Number('{{$duration}}');

        let x = setInterval(function(){
            duration -= 1;
            if(duration <= 0){
                clearInterval(x);
                submitExam();
            } else{
                const hour = Math.floor(duration / (60*60));
                const m = Math.floor(duration / 60) % 60;
                const s = Math.floor(duration) % 60;

                const minute = (m < 10) ? '0' + m : m;
                const seconds = (s < 10) ? '0' + s : s;

                hourSpan.html(hour);
                minuteSpan.html(minute);
                secondSpan.html(seconds);
            }

        }, 1000);


        function submitExam(){
            // $.ajax({});
        }

    </script>
@endsection
