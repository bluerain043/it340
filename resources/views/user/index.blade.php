@extends('layouts.header')
@section('breadcrumbs')
    <ul class="page-breadcrumb">
        <li>
            <a href="/">{{ (Auth::user() != null) && (Auth::user()->is_admin == 1) ? 'Admin ' : '' }} Dashboard</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
@endsection
@section('content')
    <div class="room-title-box">
        <h1 class="page-title"> Register User</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">


                <div class="portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Repeating Forms </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group">
                                <form action="#" class="mt-repeater form-horizontal">
                                    <h3 class="mt-repeater-title">Human Resource Management</h3>
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item="" class="mt-repeater-item">
                                            <!-- jQuery Repeater Container -->
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Name</label>
                                                <br>
                                                <input type="text" name="group-a[0][text-input]" class="form-control" value="John Smith"> </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Joined Date</label>
                                                <br>
                                                <input class="input-group form-control form-control-inline date date-picker" size="16" type="text" value="01/08/2016" name="group-a[0][date-input]" data-date-format="dd/mm/yyyy"> </div>
                                            <div class="mt-repeater-input mt-repeater-textarea">
                                                <label class="control-label">Job Description</label>
                                                <br>
                                                <textarea name="group-a[0][textarea-input]" class="form-control" rows="3">This role is to follow up with all meetings and ensure that each operational process flow moves accordingly in a timely manner.</textarea>
                                            </div>
                                            <div class="mt-repeater-input mt-radio-inline">
                                                <label class="control-label">Tier</label>
                                                <br>
                                                <label class="mt-radio">
                                                    <input type="radio" name="group-a[0][optionsRadios]" id="optionsRadios25" value="junior"> Junior
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="group-a[0][optionsRadios]" id="optionsRadios26" value="senior"> Senior
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="mt-repeater-input mt-checkbox-inline">
                                                <label class="control-label">Language</label>
                                                <br>
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="inlineCheckbox21" value="option1"> English
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="inlineCheckbox22" value="option2"> French
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Department</label>
                                                <br>
                                                <select name="group-a[0][select-input]" class="form-control">
                                                    <option value="A" selected="">Marketing</option>
                                                    <option value="B">Creative</option>
                                                    <option value="C">Development</option>
                                                </select>
                                            </div>
                                            <div class="mt-repeater-input">
                                                <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete">
                                                    <i class="fa fa-close"></i> Delete</a>
                                            </div>
                                        </div>
                                        <div data-repeater-item="" class="mt-repeater-item" style="">
                                            <!-- jQuery Repeater Container -->
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Name</label>
                                                <br>
                                                <input type="text" name="group-a[1][text-input]" class="form-control" value="John Smith"> </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Joined Date</label>
                                                <br>
                                                <input class="input-group form-control form-control-inline date date-picker" size="16" type="text" value="01/08/2016" name="group-a[1][date-input]" data-date-format="dd/mm/yyyy"> </div>
                                            <div class="mt-repeater-input mt-repeater-textarea">
                                                <label class="control-label">Job Description</label>
                                                <br>
                                                <textarea name="group-a[1][textarea-input]" class="form-control" rows="3">This role is to follow up with all meetings and ensure that each operational process flow moves accordingly in a timely manner.</textarea>
                                            </div>
                                            <div class="mt-repeater-input mt-radio-inline">
                                                <label class="control-label">Tier</label>
                                                <br>
                                                <label class="mt-radio">
                                                    <input type="radio" name="group-a[1][optionsRadios]" id="optionsRadios25" value="junior"> Junior
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="group-a[1][optionsRadios]" id="optionsRadios26" value="senior"> Senior
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="mt-repeater-input mt-checkbox-inline">
                                                <label class="control-label">Language</label>
                                                <br>
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="inlineCheckbox21" value="option1"> English
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="inlineCheckbox22" value="option2"> French
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="mt-repeater-input">
                                                <label class="control-label">Department</label>
                                                <br>
                                                <select name="group-a[1][select-input]" class="form-control">
                                                    <option value="A" selected="">Marketing</option>
                                                    <option value="B">Creative</option>
                                                    <option value="C">Development</option>
                                                </select>
                                            </div>
                                            <div class="mt-repeater-input">
                                                <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete">
                                                    <i class="fa fa-close"></i> Delete</a>
                                            </div>
                                        </div></div>
                                    <a href="javascript:;" data-repeater-create="" class="btn btn-success mt-repeater-add">
                                        <i class="fa fa-plus"></i> Add</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
