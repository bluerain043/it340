    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">

                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">Add Room Details</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{action('RoomController@post_add_room')}}" class="form-horizontal"  enctype="multipart/form-data" id="form_sample_1" novalidate="novalidate" method="POST" files="true">
                            {{ csrf_field() }}
                            <input type="hidden" name="room" value="{{$room->room}}">
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
                                    <label class="col-md-3 control-label" for="form_control_1">Name
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" placeholder="" name="room_name" value="{{$room->room_name}}">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">enter room name</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Room Number
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <div class="input-icon">
                                            <input type="text" class="form-control" placeholder="Enter digits" name="room_number" value="{{$room->room_number}}">
                                            <div class="form-control-focus"> </div>
                                            <i class="fa fa-bell-o"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Facilitor
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" placeholder="" name="facilitator" value="{{$room->facilitator}}">
                                        <div class="form-control-focus"> </div>
                                        <span class="help-block">enter name of room facilitor</span>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label" for="form_control_1">Seatplan image</label>
                                    <div class="col-md-7">
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                    <img src="{{asset($room->seatplan_image)}}" >
                                                </div>
                                                <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    {{--<input type="file" accept="image/png, image/jpeg, image/gif" name="seatplan_image" value="{{$room->seatplan_image}}">--}}
                                                                     <input type="file" name="seatplan_image" id="seatplan_image" class="form-control" value="{{$room->seatplan_image}}">
                                                                </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-success">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                        </div>
                                        <div class="form-control-focus"> </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-9">
                                        <div class="mt-radio-inline">
                                            <label class="mt-radio">
                                                <input type="radio" id="optionsRadios25" value="1" name="status" {{$room->status == 1 ? 'checked' : ''}}> Active
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" id="optionsRadios26" value="0" name="status" {{$room->status != 1 ? 'checked' : ''}}> Inactive
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button type="submit" class="btn green">Add</button>
                                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
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
