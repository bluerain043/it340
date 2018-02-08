@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript;">Inventory</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>List of Inventory</span>
        </li>
    </ul>
@endsection
@section('content')
    <div class="room-title-box">
        <h1 class="page-title">Select Room</h1>
        <div class="btn-group dp-schedule">
            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                    Select Room
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                @if(count($rooms) > 0)
                    @foreach($rooms as $room)
                        <li><a href="{{action('InventoryController@view_list', compact('room'))}}"> {{$room->room_name}} </a></li>
                    @endforeach
                @endif
            </ul>

        </div>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default add-student-btn popovers" data-container="body" data-trigger="hover" data-placement="left"
               data-content="Add schedule" data-original-title="Schedule" data-toggle="modal" href="#addSchedule">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light bordered">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">List of Inventory</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#student" data-toggle="tab" aria-expanded="false"> Student </a>
                        </li>
                        <li class="">
                            <a href="#specification" data-toggle="tab" aria-expanded="false"> Specification </a>
                        </li>
                        <li class="">
                            <a href="#software" data-toggle="tab" aria-expanded="true"> Software </a>
                        </li>
                        <li class="">
                            <a href="#hardware" data-toggle="tab" aria-expanded="true"> Harware </a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <!--STUDENT TAB -->
                        <div class="tab-pane active" id="student">
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th> Student Name </th>
                                        <th> Seat Number </th>
                                        <th> Course </th>
                                        <th> Department </th>
                                        <th> Year </th>
                                        <th> Room </th>
                                        <th> Status </th>
                                        <th>  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms) > 0)
                                        @foreach($rooms as $room)
                                            @foreach($room->students as $student)
                                                @if($room->room == $student->room)
                                                    <tr>
                                                        <td>{{ucwords($student->student_name)}}</td>
                                                        <td> {{$student->seat_number}} </td>
                                                        <td> {{$student->course}} </td>
                                                        <td> {{$student->department}} </td>
                                                        <td> {{$student->year}} </td>
                                                        <td>{{ucwords($room->room_name)}} </td>
                                                        <td> {{$student->status == 1 ? 'Active' : 'Inactive'}} </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            <td colspan="7"> No Data to Display</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--SPECIFICATION TAB -->
                        <div class="tab-pane" id="specification">
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th> Room </th>
                                        <th> Item </th>
                                        <th> Processor </th>
                                        <th> Memory </th>
                                        <th> Board </th>
                                        <th> Hdd </th>
                                        <th> Graphics </th>
                                        <th> In Use </th>
                                        <th> End of Life </th>
                                        <th>  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms) > 0)
                                        @foreach($rooms as $room)
                                            @foreach($room->specs as $specs)
                                                @if($room->room == $specs->room)
                                                    <tr>
                                                        <td>{{ucwords($room->room_name)}}</td>
                                                        <td>{{ucwords($specs->unit_type)}}</td>
                                                        <td> {{$specs->process}} </td>
                                                        <td> {{$specs->memory}} </td>
                                                        <td> {{$specs->board}} </td>
                                                        <td> {{$specs->hdd}} </td>
                                                        <td> {{$specs->graphics_card}} </td>
                                                        <td> {{$specs->in_used == 1 ? 'Yes' : 'No'}} </td>
                                                        <td> {{ Carbon\Carbon::parse($specs->created_at)->format('d-m-Y') }}  </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            <td colspan="7"> No Data to Display</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--SOFTWARE TAB -->
                        <div class="tab-pane" id="software">
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th> Software </th>
                                        <th> Room </th>
                                        <th> Purchase Date </th>
                                        <th> End of Life </th>
                                        <th>  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms) > 0)
                                        @foreach($rooms as $room)
                                            @foreach($room->softwares as $software)
                                                @if($room->room == $software->room)
                                                    <tr>
                                                        <td>{{ucwords($software->name)}}</td>
                                                        <td>{{ucwords($room->room_name)}}</td>
                                                        <td> {{ Carbon\Carbon::parse($software->purchase_date)->format('d-m-Y') }}  </td>
                                                        <td> {{ Carbon\Carbon::parse($software->end_of_life)->format('d-m-Y') }}  </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            <td colspan="7"> No Data to Display</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- HARDWARE TAB -->
                        <div class="tab-pane" id="hardware">
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th> Room </th>
                                        <th> Device Name </th>
                                        <th> Sticker </th>
                                        <th> Brand </th>
                                        <th> Serial </th>
                                        <th>  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms) > 0)
                                        @foreach($rooms as $room)
                                            @foreach($room->devices as $device)
                                                @if($room->room == $device->room)
                                                    <tr>
                                                        <td>{{ucwords($room->room_name)}}</td>
                                                        <td>{{ucwords($device->name)}}</td>
                                                        <td> {{$device->sticker}} </td>
                                                        <td> {{$device->brand}} </td>
                                                        <td> {{$device->serial}} </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            <td colspan="7"> No Data to Display</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--<div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">List of Inventory</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="">
                            <a href="#student-tab" data-toggle="tab" aria-expanded="true"> Student </a>
                        </li>
                        <li class="">
                            <a href="#specification" data-toggle="tab" aria-expanded="false"> Specification </a>
                        </li>
                        <li class="">
                            <a href="#software" data-toggle="tab" aria-expanded="false"> Software </a>
                        </li>
                        <li class="">
                            <a href="#hardware" data-toggle="tab" aria-expanded="false"> Hardware </a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body tbl-pad">
                    <div class="tab-content">
                        <div class="tab-pane active" id="student-tab">
                            <div class="skin skin-minimal">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th> Room </th>
                                            <th> Item </th>
                                            <th> Processor </th>
                                            <th> Memory </th>
                                            <th> Board </th>
                                            <th> Hdd </th>
                                            <th> Graphics </th>
                                            <th> In Use </th>
                                            <th> End of Life </th>
                                            <th>  </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($rooms) > 0)
                                            @foreach($rooms as $room)
                                                @foreach($room->specs as $specs)
                                                    @if($room->room == $specs->room)
                                                        <tr>
                                                            <td>{{ucwords($room->room_name)}}</td>
                                                            <td>{{ucwords($specs->unit_type)}}</td>
                                                            <td> {{$specs->process}} </td>
                                                            <td> {{$specs->memory}} </td>
                                                            <td> {{$specs->board}} </td>
                                                            <td> {{$specs->hdd}} </td>
                                                            <td> {{$specs->graphics_card}} </td>
                                                            <td> {{$specs->in_used == 1 ? 'Yes' : 'No'}} </td>
                                                            <td> {{ Carbon\Carbon::parse($specs->created_at)->format('d-m-Y') }}  </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default">Edit</button>
                                                                    <button type="button" class="btn btn-default">Delete</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            <tr style="text-align: center">
                                                <td colspan="7"> No Data to Display</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- SPECIFICATION TABS -->
                        <div class="tab-pane active" id="specification">
                            <div class="skin skin-minimal">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th> Room </th>
                                            <th> Item </th>
                                            <th> Processor </th>
                                            <th> Memory </th>
                                            <th> Board </th>
                                            <th> Hdd </th>
                                            <th> Graphics </th>
                                            <th> In Use </th>
                                            <th> End of Life </th>
                                            <th>  </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($rooms) > 0)
                                            @foreach($rooms as $room)
                                                @foreach($room->specs as $specs)
                                                    @if($room->room == $specs->room)
                                                        <tr>
                                                            <td>{{ucwords($room->room_name)}}</td>
                                                            <td>{{ucwords($specs->unit_type)}}</td>
                                                            <td> {{$specs->process}} </td>
                                                            <td> {{$specs->memory}} </td>
                                                            <td> {{$specs->board}} </td>
                                                            <td> {{$specs->hdd}} </td>
                                                            <td> {{$specs->graphics_card}} </td>
                                                            <td> {{$specs->in_used == 1 ? 'Yes' : 'No'}} </td>
                                                            <td> {{ Carbon\Carbon::parse($specs->created_at)->format('d-m-Y') }}  </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default">Edit</button>
                                                                    <button type="button" class="btn btn-default">Delete</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            <tr style="text-align: center">
                                                <td colspan="7"> No Data to Display</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- SOFTWARE TABS -->
                        <div class="tab-pane active" id="software">
                            <div class="skin skin-minimal">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th> Room </th>
                                            <th> Item </th>
                                            <th> Processor </th>
                                            <th> Memory </th>
                                            <th> Board </th>
                                            <th> Hdd </th>
                                            <th> Graphics </th>
                                            <th> In Use </th>
                                            <th> End of Life </th>
                                            <th>  </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($rooms) > 0)
                                            @foreach($rooms as $room)
                                                @foreach($room->specs as $specs)
                                                    @if($room->room == $specs->room)
                                                        <tr>
                                                            <td>{{ucwords($room->room_name)}}</td>
                                                            <td>{{ucwords($specs->unit_type)}}</td>
                                                            <td> {{$specs->process}} </td>
                                                            <td> {{$specs->memory}} </td>
                                                            <td> {{$specs->board}} </td>
                                                            <td> {{$specs->hdd}} </td>
                                                            <td> {{$specs->graphics_card}} </td>
                                                            <td> {{$specs->in_used == 1 ? 'Yes' : 'No'}} </td>
                                                            <td> {{ Carbon\Carbon::parse($specs->created_at)->format('d-m-Y') }}  </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default">Edit</button>
                                                                    <button type="button" class="btn btn-default">Delete</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            <tr style="text-align: center">
                                                <td colspan="7"> No Data to Display</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- HARDWARE TABS -->
                        <div class="tab-pane active" id="hardware">
                            <div class="skin skin-minimal">
                                <div class="table-scrollable">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th> Room </th>
                                            <th> Item </th>
                                            <th> Processor </th>
                                            <th> Memory </th>
                                            <th> Board </th>
                                            <th> Hdd </th>
                                            <th> Graphics </th>
                                            <th> In Use </th>
                                            <th> End of Life </th>
                                            <th>  </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($rooms) > 0)
                                            @foreach($rooms as $room)
                                                @foreach($room->specs as $specs)
                                                    @if($room->room == $specs->room)
                                                        <tr>
                                                            <td>{{ucwords($room->room_name)}}</td>
                                                            <td>{{ucwords($specs->unit_type)}}</td>
                                                            <td> {{$specs->process}} </td>
                                                            <td> {{$specs->memory}} </td>
                                                            <td> {{$specs->board}} </td>
                                                            <td> {{$specs->hdd}} </td>
                                                            <td> {{$specs->graphics_card}} </td>
                                                            <td> {{$specs->in_used == 1 ? 'Yes' : 'No'}} </td>
                                                            <td> {{ Carbon\Carbon::parse($specs->created_at)->format('d-m-Y') }}  </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default">Edit</button>
                                                                    <button type="button" class="btn btn-default">Delete</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            <tr style="text-align: center">
                                                <td colspan="7"> No Data to Display</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- BEGIN TABLE-->

                    <!-- END TABLE-->
                </div>
            </div>--}}
            <!-- END VALIDATION STATES-->
        </div>
    </div>

@endsection