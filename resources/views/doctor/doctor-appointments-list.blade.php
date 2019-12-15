@extends('layouts.app')

@section('content')
    @if($data)
        <div class="container">
            @if($data['doctor_data'])
                <h6 class="text-muted"><strong>DR </strong>:</h6>
                <ul class="list-inline">
                    <li class="list-inline-item"><h3>{{$data['doctor_data']->name}} </h3> </li>
                </ul>
                <hr>
            @endif
            <h4 class="text-muted">Doctor specialities:</h4>
            <ul class="list-inline">
                @if($data['speciality'])
                    @foreach($data['speciality'] as $specialities)
                        <li class="list-inline-item"><h5>{{$specialities->name}} </h5> </li>
                    @endforeach
                @endif
            </ul>
            <hr>
        </div>
        <div class="container mt-5">
            <div class="card">
                <div class="list-group">
                    @foreach($data['data'] as $appointment)
                        <div class="card">
                            <h5 class="card-header bg-light">Patient name: {{$appointment->patient_name}}</h5>
                            <div class="card-body">
                                <h5 class="card-title">{{$appointment->start_time}}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection