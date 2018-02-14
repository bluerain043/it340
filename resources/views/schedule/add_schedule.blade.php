@extends('layouts.header')
@section('breadcrumbs')
<ul class="page-breadcrumb">
    <li>
        <a href="/">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Add Schedule</span>
    </li>
</ul>
@endsection
@section('content')
<h1 class="page-title"> Add Schedule </h1>
<div class="row">
    {{--<div class="col-md-6 offset-md-3">--}}
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Add Schedule Details</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{action('RoomController@post_schedule')}}" class="form-horizontal" id="form_sample_1" novalidate="novalidate" method="POST">
                        {{ csrf_field() }}
                        <div class="form-body">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <button class="close" data-close="alert"></button> {{ $message }}
                            </div>
                            @endif
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Subject
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="" name="subject">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter subject name</span>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Room
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-9">
                                    <select class="form-control" id="form_control_1" name="room">
                                        <option value=""></option>
                                        @foreach($allRooms as $room)
                                        <option value="{{$room->room}}">{{$room->room_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Day(s)
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-9">
                                    <select class="form-control" id="form_control_1" name="day">
                                        <option value=""></option>
                                        @foreach(\App\Schedule::$days as $key=>$val)
                                        <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Time
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-9">
                                    <select class="form-control" id="form_control_1" name="time">
                                        <option value=""></option>
                                        @foreach(\App\Schedule::$time as $key=>$val)
                                        <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Teacher
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="" name="teacher">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter name of room facilitor</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-8">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" id="optionsRadios25" value="1" name="status" checked> Active
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" id="optionsRadios26" value="0" name="status"> Inactive
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-8">
                                    <button type="reset" class="btn default">Reset</button>
                                    <button type="submit" class="btn green">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    @endsection