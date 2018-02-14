@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="/">Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>List of Users</span>
        </li>
    </ul>
@endsection
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> Add Users</h1>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default add-student-btn popovers" data-container="body" data-trigger="hover" data-placement="left"
               data-content="Add user" data-original-title="User" data-toggle="modal" href="#addUser">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">List of Users</span>
                    </div>
                </div>
                <div class="portlet-body tbl-pad">
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
                    <!-- BEGIN TABLE-->
                    <div class="table-scrollable">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Is Admin </th>
                                <th> Status </th>
                                <th> Created At </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <tr class="mt-user-{{$user->id}}">
                                        <td>{{ucwords($user->name)}}</td>
                                        <td> {{$user->email}} </td>
                                        <td> {{($user->is_admin == 1 ? 'Yes' : 'No')}} </td>
                                        <td> <span class="label label-sm {{($user->status == 1) ? 'label-info' : 'label-warning'}}"> {{($user->status == 1) ? 'Active' : 'Inactive'}} </span> </td>
                                        <td> {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }} </td>
                                        <td class="actions">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default edit-user" data-userid="{{$user->id}}">Edit</button>
                                                <button type="button" class="btn btn-default delete-user" data-user="{{$user->id}}">Delete</button>
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

    <div class="modal fade bs-modal-lg" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Add User Details</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <form action="{{ route('register_user') }}" class="form-horizontal" id="form_sample_1" novalidate="novalidate" method="POST">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Name
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="" name="name" required autofocus>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter user name</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Email
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="" name="email" required autofocus>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter user email</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Password
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" placeholder="" name="password" required autofocus>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter user name</span>
                                        </div>
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <label class="col-md-3 control-label" for="form_control_1">Confirm Password
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" placeholder="" name="password_confirmation" required autofocus>
                                            <div class="form-control-focus"> </div>
                                            <span class="help-block">enter user name</span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-9">
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

    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-hidden="true">
        {{--@include('modals/edit_user_modal')--}}
    </div>

    <div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p> Would you like to delete this user? </p>
                    {{-- <form id="delete-schedule" action="{{ route('logout') }}" method="POST" style="display: none;">
                         {{ csrf_field() }}
                     </form>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">No</button>
                    <button type="button" data-dismiss="modal" class="btn green confirm-delete" {{--onclick="event.preventDefault(); document.getElementById('delete-schedule').submit();"--}}>Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
<script type="application/x-javascript">
$('document').ready(function(){
    var  user = '';
        setTimeout(function(){
            $('.alert-danger').addClass('hide');
            $('.alert-success').addClass('hide');
            }, 2000);

        $('.actions').on('click', '.edit-user', function () {
            var user = $(this).data('userid');
            $.post("{{ action('UserController@get_user_data') }}", {_token:'{{ csrf_token() }}', user:user}, function(result){
                $('#editUser').modal('show');
                $('#editUser').html(result.html);
            });
        });
        $('#editUser').on('click', '.user-delete', function(){ console.log('sdgsdgs');
            var user = $(this).data('userid');
            $.post("{{ action('UserController@delete_user') }}", {_token:'{{ csrf_token() }}', user:user}, function(result){
                if(result.status == 'ok'){
                    $('.mt-user-'+user).remove();
                    $('#editUser').modal('hide');
                }

            });
        });

        $('#static').on('click', '.confirm-delete' ,function(e) {
            e.preventDefault();
            $.post("{{ action('UserController@delete_user') }}", {_token:'{{ csrf_token() }}', user:user}, function(result){
                if(result.status == 'ok'){
                    $('.mt-user-'+user).remove();
                }
            });
         });

        $('.actions').on('click', '.delete-user', function(e){
            e.preventDefault();
            user = $(this).data('user');
            $('#static').modal('show');
        });

});
    </script>
@endsection