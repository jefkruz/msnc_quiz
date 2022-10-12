@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card bg-danger">
                <div class="card-body text-center">
                    <small>Time Remaining:</small>
                    <h3><i class="fa fa-clock"></i> <span id="hour">-</span>:<span id="minute">--</span>:<span id="seconds">--</span></h3>
                </div>
            </div>
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
        const duration = Number('{{$duration}}');

        // Milliseconds
        let future = duration;

        let x = setInterval(function(){
            let now = new Date().getTime() / 1000;
            let distance = future - now;
            if(distance <= 0){
                clearInterval(x);
                submitExam();
            } else{
                const hour = Math.floor(distance / (60*60));
                const m = Math.floor(distance / 60) % 60;
                const s = Math.floor(distance) % 60;

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
