@extends('layouts.app')

@section('content')
<div class="container">
        @if($doctors)
        <form method="GET" action="/doctor-appointments-list">
            <div class="col-md-4">
                <select id='doctors' name='doctor_id' class="form-control form-control-sm test">
                    <option selected>Select doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor->doctor_id}}">{{$doctor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select id="dates"  name='date' class="form-control form-control-sm">
                    <option value="{{$doctor->doctor_id}}">Select Date</option>
                </select>
            </div>
            <div class="col-md-6 mt-1">
                <button type="submit" name="submit" class="btn btn-block btn-outline-primary">Check appointments</button>
            </div>
        </form>
    @else
</div>

@endif
@endsection
<script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>

<script>
    $( document ).ready(function() {
        let datesData = <?php echo json_encode($dates); ?>

        $("#doctors").on('change',function(e){
            id = $("#doctors option:selected").val()
            let dates = datesData[id];
            $.each(dates, function (i, date) {
                $('#dates').append($('<option>', {
                    value: date,
                    text : date
                }));
            });
        });
    });


</script>



