@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="/">Dashboard</a>
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
                @if($current_room != 0)
                    @if(count($allRooms) > 0)
                        @foreach($allRooms as $room)
                            @if($room->room == $current_room)
                                {{$room->room_name}}
                            @endif
                        @endforeach
                    @endif
                @else
                    Select Room
                @endif
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                @if(count($allRooms) > 0)
                    @foreach($allRooms as $room)
                        <li class="{{($room->room == $current_room) ? 'selected' : ''}}"><a href="{{action('InventoryController@view_list', compact('room'))}}"> {{$room->room_name}} </a></li>
                    @endforeach
                @endif
            </ul>

        </div>
        {{--<div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default add-inventory-btn popovers" data-container="body" data-trigger="hover" data-placement="left"
               data-content="Add item to Inventory" data-original-title="Inventory" data-toggle="modal" href="#addSchedule">
                <i class="fa fa-plus"></i>
            </a>
        </div>--}}
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
                            {{--<a href="{{action('InventoryController@get_student', compact('room'))}}" data-toggle="tab" aria-expanded="false"> Student</a>--}}
                            <a href="#student" data-toggle="tab" aria-expanded="false"> Student</a>
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
                            <form action="{{action('InventoryController@search_student', compact('current_room'))}}" class="form-inline" role="form" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[student_name]" placeholder="Student Name"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[department]" placeholder="Department"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[course]" placeholder="Course"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[year]" placeholder="Year"> </div>
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="board" name="room" value={{$current_room}}>
                                <input type="hidden" class="form-control" id="board" name="table" value="Students">
                                <button type="submit" class="btn btn-default">Search</button>
                                <button type="button" class="btn btn-success" id="refresh-btn">Refresh</button>
                            </form>
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th> Student Name</th>
                                        <th> Seat Number </th>
                                        <th> Course </th>
                                        <th> Department </th>
                                        <th> Year </th>
                                        <th> Room </th>
                                        <th> Status </th>
                                        @if(Auth::user()->is_admin == 1)
                                        <th>  </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms->students) > 0)
                                       @foreach($rooms->students as $student)
                                            @if($rooms->room == $student->room)
                                                <tr>
                                                    <td>{{ucwords($student->student_name)}}</td>
                                                    <td> {{$student->seat_number}} </td>
                                                    <td> {{$student->course}} </td>
                                                    <td> {{$student->department}} </td>
                                                    <td> {{$student->year}} </td>
                                                    <td>{{ucwords($room->room_name)}} </td>
                                                    <td> <span class="label label-sm {{($student->status == 1) ? 'label-info' : 'label-warning'}}"> {{($student->status == 1) ? 'Active' : 'Inactive'}} </span> </td>
                                                    @if(Auth::user()->is_admin == 1)
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            @if(Auth::user()->is_admin == 1)
                                            <td colspan="7"> No Data to Display</td>
                                            @else
                                                <td colspan="6"> No Data to Display</td>
                                            @endif
                                        </tr>

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--SPECIFICATION TAB -->
                        <div class="tab-pane" id="specification">

                            <form action="{{action('InventoryController@search_student', compact('current_room'))}}" class="form-inline" role="form" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[processor]" placeholder="Processor"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="memory" name="fields[memory]" placeholder="Memory"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="board" name="fields[board]" placeholder="Board"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="board" name="fields[hdd]" placeholder="HDD"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="board" name="fields[graphics_card]" placeholder="Graphics"> </div>
                                <input type="hidden" class="form-control" id="board" name="room" value={{$current_room}}>
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="board" name="table" value="specification">
                                <button type="submit" class="btn btn-default">Search</button>
                                <button type="button" class="btn btn-success" id="refresh-btn">Refresh</button>
                            </form>

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
                                        <th> In Stock </th>
                                        <th> End of Life </th>
                                        @if(Auth::user()->is_admin == 1)
                                            <th>  </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms->specs) > 0)
                                        @foreach($rooms->specs as $specs)
                                            @if($rooms->room == $specs->room)
                                                <tr>
                                                    <td>{{ucwords($rooms->room_name)}}</td>
                                                    <td>{{ucwords($specs->unit_type)}}</td>
                                                    <td> {{$specs->process}} </td>
                                                    <td> {{$specs->memory}} </td>
                                                    <td> {{$specs->board}} </td>
                                                    <td> {{$specs->hdd}} </td>
                                                    <td> {{$specs->graphics_card}} </td>
                                                    <td> {{$specs->in_used == 'yes' ? 1 : ''}} </td>
                                                    <td> {{$specs->in_used == 'no' ? 1 : ''}} </td>
                                                    <td> {{ Carbon\Carbon::parse($specs->created_at)->format('d-m-Y') }}  </td>
                                                    @if(Auth::user()->is_admin == 1)
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            @if(Auth::user()->is_admin == 1)
                                            <td colspan="9"> No Data to Display</td>
                                             @else
                                                <td colspan="8"> No Data to Display</td>
                                            @endif
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--SOFTWARE TAB -->
                        <div class="tab-pane" id="software">
                            <form action="{{action('InventoryController@search_student', compact('current_room'))}}" class="form-inline" role="form" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[name]" placeholder="Software"> </div>
                                <input type="hidden" class="form-control" id="board" name="room" value={{$current_room}}>
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="board" name="table" value="software">
                                <button type="submit" class="btn btn-default">Search</button>
                                <button type="button" class="btn btn-success" id="refresh-btn">Refresh</button>
                            </form>
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th> Software </th>
                                        <th> Room </th>
                                        <th> Purchase Date </th>
                                        <th> End of Life </th>
                                        @if(Auth::user()->is_admin == 1)
                                        <th>  </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms) > 0)
                                        @foreach($rooms->softwares as $software)
                                            @if($rooms->room == $software->room)
                                                <tr>
                                                    <td>{{ucwords($software->name)}}</td>
                                                    <td>{{ucwords($rooms->room_name)}}</td>
                                                    <td> {{ Carbon\Carbon::parse($software->purchase_date)->format('d-m-Y') }}  </td>
                                                    <td> {{ Carbon\Carbon::parse($software->end_of_life)->format('d-m-Y') }}  </td>
                                                    @if(Auth::user()->is_admin == 1)
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            @if(Auth::user()->is_admin == 1)
                                                <td colspan="4"> No Data to Display</td>
                                            @else
                                                <td colspan="3"> No Data to Display</td>
                                            @endif
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- HARDWARE TAB -->
                        <div class="tab-pane" id="hardware">
                            <form action="{{action('InventoryController@search_student', compact('current_room'))}}" class="form-inline" role="form" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[name]" placeholder="Device Name"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[brand]" placeholder="Brand"> </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="processor" name="fields[sticker]" placeholder="Sticker"> </div>
                                <input type="hidden" class="form-control" id="board" name="room" value={{$current_room}}>
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="board" name="table" value="devices">
                                <button type="submit" class="btn btn-default">Search</button>
                                <button type="button" class="btn btn-success" id="refresh-btn">Refresh</button>
                            </form>
                            <div class="table-scrollable">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th> Room </th>
                                        <th> Device Name </th>
                                        <th> Sticker </th>
                                        <th> Brand </th>
                                        <th> Serial </th>
                                        @if(Auth::user()->is_admin == 1)
                                            <th>  </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rooms) > 0)
                                        @foreach($rooms->devices as $device)
                                            @if($rooms->room == $device->room)
                                                <tr>
                                                    <td>{{ucwords($rooms->room_name)}}</td>
                                                    <td>{{ucwords($device->name)}}</td>
                                                    <td> {{$device->sticker}} </td>
                                                    <td> {{$device->brand}} </td>
                                                    <td> {{$device->serial}} </td>
                                                    @if(Auth::user()->is_admin == 1)
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default">Edit</button>
                                                                <button type="button" class="btn btn-default">Delete</button>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr style="text-align: center">
                                            @if(Auth::user()->is_admin == 1)
                                                <td colspan="5"> No Data to Display</td>
                                            @else
                                                <td colspan="4"> No Data to Display</td>
                                            @endif
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@include('modals/add_inventory_modal')
@endsection
@section('page_script')
    <script>
        $('document').ready(function(){
            $current_room= "{{$current_room}}";

            $('.tab-pane').on('click', '#refresh-btn', function(){
                window.location = "/inventory_list/"+$current_room;
            });

           $('.add-inventory-btn').on('click', function(){
               $('#full-new').modal('show');
           })

            $('#full-new').on('click', '.addSpecification-btn', function(){
                $form = $('#addSpecs');
                url = $form.attr('action');
                data = $form.serialize()  + '&ajaxReturn=TRUE';
                $.post(url, data, function(result){console.log(result);
                    if(result.errors){
                        $('.specs-error').removeClass('hide');
                        html = '';
                        $.each(result.errors, function (index, data) {
                            html += '<li>'+data+'</li>';
                        });
                        $('.specs-error ul').html(html);
                        setTimeout(function(){ $('.specs-error').addClass('hide'); }, 2000);
                    }else if(result.status == 'ok'){
                        $('.specs-success').removeClass('hide');
                        $('.specs-success .msg').html('System Specification is Updated Successfully');
                        setTimeout(function(){ location.reload(); }, 2000);
                    }

                });
            });
        });
    </script>
@endsection