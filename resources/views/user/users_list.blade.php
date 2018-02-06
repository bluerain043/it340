@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript;">User</a>
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
                                    <tr>
                                        <td>{{ucwords($user->name)}}</td>
                                        <td> {{$user->email}} </td>
                                        <td> {{($user->is_admin == 1 ? 'Yes' : 'No')}} </td>
                                        <td> <span class="label label-sm {{($user->status == 1) ? 'label-info' : 'label-warning'}}"> {{($user->status == 1) ? 'Active' : 'Inactive'}} </span> </td>
                                        <td> {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y i') }} </td>
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


                                    <div class="form-group form-md-checkboxes">
                                        <label class="col-md-3 control-label" for="form_control_1">Status
                                            <span class="required" aria-required="true">*</span>
                                        </label>
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

@section('page_script')
    <script type="application/x-javascript">
        setTimeout(function(){
            $('.alert-danger').addClass('hide');
            $('.alert-success').addClass('hide');
            }, 2000);

    </script>
@endsection