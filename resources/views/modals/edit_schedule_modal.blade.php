    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">

                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">Edit Schedule Details</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{action('ScheduleController@post_update', compact('schedule'))}}" class="form-horizontal" id="update-schedule-form" novalidate="novalidate" method="POST">
                            {{ csrf_field() }}
                            <div class="form-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger danger-edit-error">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success success-edit-msg">
                                        <button class="close" data-close="alert"></button> {{ $message }}
                                    </div>
                                @endif
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-2 control-label" for="form_control_1">Subject
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="" name="subject" value="{{$schedule->subject}}">
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
                                                <option value="{{$room->room}}" {{($schedule->room == $room->room) ? 'selected' : ''}}>{{$room->room_name}}</option>
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
                                                <option value="{{$key}}" {{($schedule->day == $key) ? 'selected' : ''}}>{{$val}}</option>
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
                                                <option value="{{$key}}" {{($schedule->time == $key) ? 'selected' : ''}}>{{$val}}</option>
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
                                        <input type="text" class="form-control" placeholder="" name="teacher" value="{{$schedule->teacher}}">
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
                                                <input type="checkbox" id="checkbox1_3" name="status" value="1" class="md-check" {{($schedule->status == 1) ? 'checked' : '' }}>
                                                <label for="checkbox1_3">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Active</label>
                                            </div>
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="checkbox1_4" name="checkboxes2[]" value="2" class="md-check" {{($schedule->status == 2) ? 'checked' : '' }}>
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
                                        <button type="button" class="btn green update-schedule">Update</button>
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
