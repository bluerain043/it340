<div class="modal-dialog modal-full">
    <div class="modal-content">
        <div class="modal-body">

            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-globe font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Edit {{$tab}} Details </span>
                    </div>
                    <ul class="nav nav-tabs">
                        @if($tab == 'student')
                            <li class="active">
                                <a href="#student-tab" data-toggle="tab" aria-expanded="true"> Student </a>
                            </li>
                        @elseif($tab == 'specification')
                            <li class="active">
                                <a href="#specification" data-toggle="tab" aria-expanded="false"> Specification </a>
                            </li>
                        @elseif($tab == 'software')
                            <li class="active">
                                <a href="#software" data-toggle="tab" aria-expanded="false"> Software </a>
                            </li>
                        @elseif($tab == 'hardware')
                            <li class="active">
                                <a href="#hardware" data-toggle="tab" aria-expanded="false"> Hardware </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="portlet-body form">
                    <div class="tab-content">
                        @if($tab == 'student')
                            <div class="tab-pane active" id="student-tab">
                                <div class="skin skin-minimal">
                                    <form action="{{action('RoomController@ajax_save_new_student')}}" class="form-horizontal" id="addStudentForm" novalidate="novalidate" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="student-error alert alert-danger hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                                <ul class="slist">

                                                </ul>
                                            </div>
                                            <div class="student-success alert alert-success hide">
                                                <button class="close" data-close="alert"></button> <p class="msg"></p>
                                            </div>
                                            <input type="hidden" name="students" value="{{$student->students}}">
                                            <input type="hidden" name="seat" value="{{$current_seat}}">
                                            <input type="hidden" name="room" value="{{$room}}">
                                            <input type="hidden" name="status" value="1">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Student Name
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="student_name" value="{{$student->student_name}}">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">enter student name</span>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Department
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="department" value="{{$student->department}}">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">enter department</span>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Course
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="course" value="{{$student->course}}">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">enter course</span>
                                                </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Year
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="year" value="{{$student->year}}">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">enter year</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Status</label>
                                                <div class="col-md-5">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" id="optionsRadios25" value="1" name="status" {{$student->status == 1 ? 'checked' : ''}}> Active
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" id="optionsRadios26" value="0" name="status"  {{$student->status != 1 ? 'checked' : ''}}> Inactive
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn green addStudent-btn" data-student="{{$student->students}}">Update</button>
                                            <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif($tab == 'specification')
                            <div class="tab-pane active" id="specification">
                                <div class="skin skin-square">
                                    <form action="{{action('RoomController@ajax_save_specification')}}" class="form-horizontal"  id="addSpecs" novalidate="novalidate" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="specs-error alert alert-danger hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                                <ul class="slist">

                                                </ul>
                                            </div>
                                            <div class="specs-success alert alert-success hide">
                                                <button class="close" data-close="alert"></button> <p class="msg"></p>
                                            </div>

                                            <input type="hidden" name="in_used" value="yes">
                                            <input type="hidden" name="specifications" value="{{$specs->specifications}}">
                                            @if(count($specs) > 0)
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Unit Type
                                                        <span class="required" aria-required="true">*</span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <select class="form-control" id="form_control_1" name="unit_type">
                                                            <option value=""></option>
                                                            @foreach(\App\Specifications::$unitType as $key=>$val)
                                                                <option value="{{$key}}" {{$specs->unit_type == $val ? 'Selected' : ''}}>{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">select unit type</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Processor
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="processor" value="{{$specs->processor}}">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter processor</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Board
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="board" value="{{$specs->board}}">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter board</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">HDD
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="hdd" value="{{$specs->hdd}}">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter hdd</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Memory
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="memory" value="{{$specs->memory}}">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter memory</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Graphics Card
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="graphics_card" value="{{$specs->graphics_card}}">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter graphics card</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">End of Life
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input class="form-control form-control-inline input-medium date-picker" name="end_of_life" type="text"
                                                               value="{{ Carbon\Carbon::parse($specs->end_of_life)->format('d-m-Y')}}" >
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter end of life</span>
                                                    </div>
                                                </div>
                                             @endif
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn green addSpecification-btn">Submit</button>
                                            <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        @elseif($tab=="software")
                            <div class="tab-pane active" id="software">
                                <div class="skin skin-flat">
                                    <form action="{{action('RoomController@ajax_save_software')}}" class="form-horizontal mt-repeater form-horizontal" id="addSoftware" novalidate="novalidate" method="POST">
                                        {{ csrf_field() }}

                                        <div class="software-error alert alert-danger hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                            <ul class="slist">

                                            </ul>
                                        </div>
                                        <div class="software-success alert alert-success hide">
                                            <button class="close" data-close="alert"></button> <p class="msg"></p>
                                        </div>
                                        <input type="hidden" name="individual" value="yes"/>
                                        <input type="hidden" name="software" value="{{$software->software}}"/>
                                        <div data-repeater-list="software">
                                            @if(count($software) > 0)
                                                <div class="mt-repeater-item">
                                                    <div class="mt-repeater-input">
                                                        <label class="control-label">Softwareiii</label>
                                                        <br>
                                                        <input type="text" name="name" class="form-control" value="{{$software->name}}">
                                                    </div>

                                                    <div class="mt-repeater-input">
                                                        <label class="control-label">Purchase Date</label>
                                                        <br>
                                                        <input class="input-group form-control form-control-inline date date-picker" name="purchase_date" type="text"
                                                               value="{{ Carbon\Carbon::parse($software->purchase_date)->format('d-m-Y')}}" >
                                                    </div>

                                                    <div class="mt-repeater-input">
                                                        <label class="control-label">End of Life</label>
                                                        <br>
                                                        <input class="input-group form-control form-control-inline date date-picker" name="end_of_life" type="text"
                                                               value="{{ Carbon\Carbon::parse($software->end_of_life)->format('d-m-Y')}}" >
                                                    </div>
                                                </div>
                                            @endif
                                        </div><!-- jQuery Repeater Container -->
                                        <div class="form-actions">
                                            <button type="button" class="btn green addSoftware-btn">Submit</button>
                                            <button type="button" class="btn default btn-cancel" data-dismiss="modal" data-form="addSoftware">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif($tab=='hardware')
                            <div class="tab-pane active" id="hardware">
                                <div class="skin skin-flat">
                                    <form action="{{action('RoomController@ajax_save_device')}}" class="form-horizontal mt-repeater form-horizontal" id="addHardware" novalidate="novalidate" method="POST">
                                        {{ csrf_field() }}
                                        <div class="device-error alert alert-danger hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                            <ul class="slist">

                                            </ul>
                                        </div>
                                        <div class="device-success alert alert-success hide">
                                            <button class="close" data-close="alert"></button> <p class="msg"></p>
                                        </div>
                                        <input type="hidden" name="devices" value="{{$device->devices}}">
                                        <input type="hidden" name="individual" value="yes">
                                        <div data-repeater-list="device">
                                            @if(count($device->devices) > 0)
                                                <!-- display software list if present -->
                                                    <div class="mt-repeater-item">
                                                        <div class="mt-repeater-input">
                                                            <label class="control-label">Device</label>
                                                            <br>
                                                            <input type="text" name="name" class="form-control" name="name" value="{{$device->name}}">
                                                        </div>

                                                        <div class="mt-repeater-input">
                                                            <label class="control-label">Brand</label>
                                                            <br>
                                                            <input type="text" name="brand" class="form-control" name="brand" value="{{$device->brand}}">
                                                        </div>

                                                        <div class="mt-repeater-input">
                                                            <label class="control-label">Sticker</label>
                                                            <br>
                                                            <input type="text" name="sticker" class="form-control" value="{{$device->sticker}}">
                                                        </div>
                                                        <div class="mt-repeater-input">
                                                            <label class="control-label">Serial</label>
                                                            <br>
                                                            <input type="text" name="serial" class="form-control"name="serial" value="{{$device->serial}}">
                                                        </div>
                                                        <div class="mt-repeater-input">
                                                            <label class="control-label">End of Life</label>
                                                            <br>
                                                            <input class="input-group form-control form-control-inline date date-picker" name="device[0][end_of_life]" type="text" value="{{$device->end_of_life}}">
                                                        </div>

                                                    </div>
                                             @endif
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn green addDevice">Submit</button>
                                            <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
