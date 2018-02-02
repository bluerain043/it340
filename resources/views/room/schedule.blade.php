@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript;">Schedule</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>List of Schedule</span>
        </li>
    </ul>
@endsection
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> Add Schedule</h1>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default add-student-btn popovers" data-container="body" data-trigger="hover" data-placement="left"
               data-content="Add schedule" data-original-title="Schedule" data-toggle="modal" href="#addSchedule">
                <i class="fa fa-plus"></i>
            </a>
            {{--<a class="btn btn-circle btn-icon-only btn-default popovers" href="javascript:;" data-container="body" data-trigger="hover" data-placement="left" data-content="Edit Settings" data-original-title="Dashboard">
                <i class="icon-wrench"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default popovers" href="javascript:;" data-container="body" data-trigger="hover" data-placement="left" data-content="Delete this room entry" data-original-title="Dashboard">
                <i class="icon-trash"></i>
            </a>--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">List of Schedule</span>
                    </div>
                </div>
                <div class="portlet-body tbl-pad">
                    <!-- BEGIN TABLE-->
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> Subject </th>
                                <th> Day </th>
                                <th> Time </th>
                                <th> Room </th>
                                <th> Teacher </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($schedules) > 0)
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{ucwords($schedule->subject)}}</td>
                                        <td> {{$schedule->day}} </td>
                                        <td> {{$schedule->time}} </td>
                                        <td> {{$schedule->room}} </td>
                                        <td> {{$schedule->teacher}} </td>
                                        <td>
                                            <span class="label label-sm {{($schedule->status == 1) ? 'label-info' : 'label-warning'}}"> {{($schedule->status == 1) ? 'Active' : 'Inactive'}} </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Edit</button>
                                                <button type="button" class="btn btn-default">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                             @else
                                <tr style="text-align: center">
                                    <td colspan="7"> No Schedule Entry</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- END TABLE-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="addSchedule" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

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

                                    <div class="form-group form-md-checkboxes">
                                        <label class="col-md-2 control-label" for="form_control_1">Status
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="md-checkbox-inline">
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="checkbox1_3" name="status" value="1" class="md-check">
                                                    <label for="checkbox1_3">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Active</label>
                                                </div>
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="checkbox1_4" name="checkboxes2[]" value="2" class="md-check">
                                                    <label for="checkbox1_4">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Inactive </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-4 col-md-8">
                                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn green">Add</button>
                                            <button type="reset" class="btn default">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection