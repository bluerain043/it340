<div class="modal fade" id="full-new" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-globe font-green"></i>
                            <span class="caption-subject font-green bold uppercase">Add Details</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#specification-modal" data-toggle="tab" aria-expanded="false"> Specification </a>
                            </li>
                            <li class="">
                                <a href="#software-modal" data-toggle="tab" aria-expanded="false"> Software </a>
                            </li>
                            <li class="">
                                <a href="#hardware-modal" data-toggle="tab" aria-expanded="false"> Hardware </a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body form">
                        <div class="tab-content">
                            <div class="tab-pane active" id="specification-modal">
                                <div class="skin skin-square">
                                    <form action="{{action('RoomController@save_specification')}}" class="form-horizontal"  id="addSpecs" novalidate="novalidate" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" class="form-control" id="board" name="students" value="0">
                                        <div class="form-body">
                                            <div class="specs-error alert alert-danger hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. <br/>
                                                <ul class="slist">

                                                </ul>
                                            </div>
                                            <div class="specs-success alert alert-success hide">
                                                <button class="close" data-close="alert"></button> <p class="msg"></p>
                                            </div>

                                            <input type="hidden" class="form-control" id="board" name="room" value={{$current_room}}>
                                            <input type="hidden" name="in_used" value="no">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Unit Type
                                                        <span class="required" aria-required="true">*</span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <select class="form-control" id="form_control_1" name="unit_type">
                                                            <option value=""></option>
                                                            @foreach(\App\Specifications::$unitType as $key=>$val)
                                                                <option value="{{$key}}">{{$val}}</option>
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
                                                        <input type="text" class="form-control" placeholder="" name="processor" value="">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter processor</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Board
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="board" value="">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter board</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">HDD
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="hdd" value="">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter hdd</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Memory
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="memory" value="">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter memory</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">Graphics Card
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" placeholder="" name="graphics_card" value="">
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter graphics card</span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label" for="form_control_1">End of Life
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input class="form-control form-control-inline input-medium date-picker" name="end_of_life" type="text"
                                                               value="" >
                                                        <div class="form-control-focus"> </div>
                                                        <span class="help-block">enter end of life</span>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn green addSpecification-btn">Submit</button>
                                            <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane" id="software-modal">
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


                                        {{--<input type="hidden" name="students" value="{{$student->students}}">
                                        <input type="hidden" name="seat" value="{{$student->seat}}">
                                        <input type="hidden" class="form-control" name="room" value={{$current_room}}>--}}

                                        <div data-repeater-list="software">
                                            <div data-repeater-item="" class="mt-repeater-item">
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Software</label>
                                                    <br>
                                                    <input type="text" name="software[0][name]" class="form-control" value="">
                                                </div>

                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Purchase Date</label>
                                                    <br>
                                                    <input class="input-group form-control form-control-inline date date-picker" name="software[0][purchase_date]" type="text"value="" >
                                                </div>

                                                <div class="mt-repeater-input">
                                                    <label class="control-label">End of Life</label>
                                                    <br>
                                                    <input class="input-group form-control form-control-inline date date-picker" name="software[0][end_of_life]" type="text" value="" >
                                                </div>
                                                <div class="mt-repeater-input">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete">
                                                        <i class="fa fa-close"></i> Delete</a>
                                                </div>
                                            </div>

                                        <!-- jQuery Repeater Container -->
                                        </div>
                                        <a href="javascript:;" data-repeater-create="" class="btn btn-success mt-repeater-add">
                                            <i class="fa fa-plus"></i> Add</a>
                                        <div class="form-actions">
                                            <button type="button" class="btn green addSoftware-btn">Submit</button>
                                            <button type="button" class="btn default btn-cancel" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane" id="hardware-modal">
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


                                        {{--<input type="hidden" name="students" value="{{$student->students}}">
                                        <input type="hidden" name="seat_number" value="{{$student->seat_number}}">
                                        <input type="hidden" name="room" value="{{$room}}">--}}

                                        <div data-repeater-list="device">
                                            <!-- display software list if present -->
                                            <div data-repeater-item="" class="mt-repeater-item">
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Device</label>
                                                    <br>
                                                    <input type="text" name="device[0][name]" class="form-control" name="name" value="">
                                                </div>

                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Brand</label>
                                                    <br>
                                                    <input type="text" name="device[0][brand]" class="form-control" name="brand" value="">
                                                </div>

                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Sticker</label>
                                                    <br>
                                                    <input type="text" name="device[0][sticker]" class="form-control" value="">
                                                </div>
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">Serial</label>
                                                    <br>
                                                    <input type="text" name="device[0][serial]" class="form-control"name="serial" value="">
                                                </div>
                                                <div class="mt-repeater-input">
                                                    <label class="control-label">End of Life</label>
                                                    <br>
                                                    <input class="input-group form-control form-control-inline date date-picker" name="device[0][end_of_life]" type="text" value="">
                                                </div>
                                                <div class="mt-repeater-input">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete">
                                                        <i class="fa fa-close"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:;" data-repeater-create="" class="btn btn-success mt-repeater-add">
                                            <i class="fa fa-plus"></i> Add</a>
                                        <div class="form-actions">
                                            <button type="button" class="btn green addDevice">Submit</button>
                                            <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

</div>