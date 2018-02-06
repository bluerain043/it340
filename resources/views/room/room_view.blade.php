@extends('layouts.header')
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> {{$room->room_name}}</h1>
        <div class="btn-group dp-schedule">
            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                @if(isset($schedule) && count($schedule) > 0)
                    @foreach(\App\Schedule::$time as $key=>$val)
                        @if($key == $schedule->time)
                            {{$schedule->day .' - '. $val}}
                        @endif
                    @endforeach
                @else
                    Select Schedule
                @endif
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                @if(count($schedules_list) > 0)
                    @foreach($schedules_list as $schedule)
                        @foreach(\App\Schedule::$time as $key=>$val)
                            @if($key == $schedule->time)
                                <li><a href="{{action('RoomController@room_view_edit_schedule', compact('room', 'schedule'))}}"> {{$schedule->day .' - '. $val}} </a></li>
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </ul>

        </div>
        @endsection

@section('page_script')


@endsection