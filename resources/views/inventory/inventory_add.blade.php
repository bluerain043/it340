@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="/">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Inventory</span>
        </li>
    </ul>
@endsection
@section('content')
    <h1 class="page-title"> Add Instock Inventory </h1>
    <div class="row">
        {{--<div class="col-md-6 offset-md-3">--}}
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Add Inventory Details</span>
                    </div>

                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{action('RoomController@post_add_room')}}" class="form-horizontal"  enctype="multipart/form-data" id="form_sample_1" novalidate="novalidate" method="POST">
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
                                <label class="col-md-2 control-label" for="form_control_1">Name
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="" name="room_name">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter room name</span>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Room Number
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Enter digits" name="room_number">
                                        <div class="form-control-focus"> </div>
                                        <i class="fa fa-bell-o"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Facilitor
                                    <span class="required" aria-required="true">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="" name="facilitator">
                                    <div class="form-control-focus"> </div>
                                    <span class="help-block">enter name of room facilitor</span>
                                </div>
                            </div>

                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">Seatplan image</label>
                                <div class="col-md-8">
                                    <div class="col-md-8">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                            <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="seatplan_image"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-success">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                    </div>
                                    <div class="form-control-focus"> </div>
                                </div>
                            </div>
                            <div class="form-group form-md-checkboxes">
                                {{--<label class="col-md-2 control-label" for="form_control_1">Status</label>
                                 <div class="col-md-8">
                                     <div class="md-checkbox-inline">
                                         <div class="md-checkbox">
                                             <input type="checkbox" id="checkbox1_3" name="status" value="1" class="md-check">
                                             <label for="checkbox1_3">
                                                 <span></span>
                                                 <span class="check"></span>
                                                 <span class="box"></span> Active</label>
                                         </div>
                                         <div class="md-checkbox">
                                             <input type="checkbox" id="checkbox1_4" name="status" value="0" class="md-check">
                                             <label for="checkbox1_4">
                                                 <span></span>
                                                 <span class="check"></span>
                                                 <span class="box"></span> Inactive </label>
                                         </div>
                                     </div>
                                 </div>--}}



                                <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-8">
                                        <div class="mt-radio-inline">
                                            <label class="mt-radio">
                                                <input type="radio" id="optionsRadios25" value="1" name="status" checked=""> Active
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" id="optionsRadios26" value="0" name="status" checked=""> Inactive
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="reset" class="btn default">Reset</button>
                                    <button type="submit" class="btn green">Add</button>
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