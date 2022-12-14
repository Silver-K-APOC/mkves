@extends('layouts.master')
@section('page_title', 'Edit User')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit User Details</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-update" action="{{ route('users.update', Qs::hash($user->id)) }}" data-fouc>
                @csrf @method('PUT')
                <h6>Personal Data</h6>
                @if($user->user_type != 'teacher')
                <fieldset>
                    <a href="{{ route('users.admin_list') }}" style="float:right;"><i class="icon-paragraph-justify3"></i></a>
                    <div class="row" style="margin-top:5vh;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="user_type"> Select User: </label>
                                <select disabled="disabled" class="form-control select" id="user_type">
                                    <option value="">{{ strtoupper($user->user_type) }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Full Name: </label>
                                <input value="{{ $user->name }}"  type="text" name="name" placeholder="Full Name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>UserName: </label>
                                <input value="{{ $user->username }}"  type="text" name="username" placeholder="User Name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address: </label>
                                <input value="{{ $user->address }}" class="form-control" placeholder="Address" name="address" type="text" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email address: </label>
                                <input value="{{ $user->email }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone:</label>
                                <input value="{{ $user->phone }}" type="text" name="phone" class="form-control" placeholder="" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telephone:</label>
                                <input value="{{ $user->phone2 }}" type="text" name="phone2" class="form-control" placeholder="" >
                            </div>
                        </div>

                    </div>

                    {{--Passport--}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Upload Photo:</label>
                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                            </div>
                        </div>
                    </div>

                </fieldset>
                @else
                <fieldset>
                    <a href="{{ route('users.teacher_list') }}" style="float:right;"><i class="icon-paragraph-justify3"></i></a>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="user_type"> Select User: </label>
                                <select disabled="disabled" class="form-control select" id="user_type">
                                    <option value="">{{ strtoupper($user->user_type) }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-4">
                            
                            <div class="col-ting">
                                <div class="control-group file-upload" id="file-upload1">
                                    <div class="image-box text-center">
                                        <p>Upload Photo</p>
                                        <img src="" alt="">
                                    </div>
                                    <div class="controls" style="display: none;">
                                        <input type="file" name="photo"/>
                                    </div>
                                </div>
                            </div>
                            
                        </div>                       

                        <div class="col-md-8 teacher" style="margin-top:5vh;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Serial No: </label>
                                        <input value="{{ $details->serial_no }}"  type="text" name="serial_no" placeholder="Serial no" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>File No: </label>
                                        <input value="{{ $details->file_no }}"  type="text" name="file_no" placeholder="File no" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Known Name: </label>
                                        <input value="{{ $details->known_name }}"  type="text" name="known_name" placeholder="Known name" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name as per Passport: </label>
                                        <input value="{{ $details->name_as_per_passport }}" class="form-control" placeholder="Name as per passport" name="name_as_per_passport" type="text" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row teacher">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position in School: </label>
                                <input value="{{ $details->position_in_school }}" class="form-control" placeholder="Position in school"  type="text" name="position_in_school" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Profession in Visa: </label>
                                <input value="{{ $details->profession_in_visa }}" class="form-control" placeholder="Profession in visa" name="profession_in_visa" type="text" >
                            </div>
                        </div>
                    </div>

                    <div class="row teacher">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Joining: </label>
                                <input autocomplete="off" name="date_of_joining" value="{{ $details->date_of_joining }}" type="text" class="form-control date-pick" placeholder="Date of joining">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contract">Type of Contract: </label>
                                <select class="select form-control" id="contract" name="type_of_contract"  data-fouc data-placeholder="Choose..">
                                    <option value=""></option>
                                    <option {{ ($details->type_of_contract == 'Overseas contracts') ? 'selected' : '' }} value="Overseas contracts">Overseas contracts</option>
                                    <option {{ ($details->type_of_contract == 'Local plus contracts') ? 'selected' : '' }} value="Local plus contracts">Local plus contracts</option>
                                    <option {{ ($details->type_of_contract == 'Local contracts') ? 'selected' : '' }} value="Local contracts">Local contracts</option>
                                    <option {{ ($details->type_of_contract == 'UAE national contracts') ? 'selected' : '' }} value="UAE national contracts">UAE national contracts</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="marital">Marital Status: </label>
                                <select class="select form-control" id="marital" name="marital_status"  data-fouc data-placeholder="Choose..">
                                    <option value=""></option>
                                    <option {{ ($details->marital_status == 'Single') ? 'selected' : '' }} value="Single">Single</option>
                                    <option {{ ($details->marital_status == 'Married') ? 'selected' : '' }} value="Married">Married</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Religion: </label>
                                <input value="{{ $details->religion }}" class="form-control" placeholder="Religion" name="religion" type="text" >
                            </div>
                        </div>
                    </div>

                    <div class="row teacher">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth: </label>
                                <input autocomplete="off" name="date_of_birth" value="{{ $details->date_of_birth }}" type="text" class="form-control date-pick" placeholder="Date of birth">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Current Age: </label>
                                <input value="{{ $details->current_age }}" class="form-control" placeholder="Current age" name="current_age" type="text" >
                            </div>
                        </div>
                    </div>

                    <div class="row teacher">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Father's Name: </label>
                                <input value="{{ $details->fathers_name }}" class="form-control" placeholder="Farther's name" name="fathers_name" type="text" >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mother's Name: </label>
                                <input value="{{ $details->mothers_name }}" class="form-control" placeholder="Mother's name" name="mothers_name" type="text" >
                            </div>
                        </div>
                    </div>

                    <!-- basic info -->
                    <div class="teacher">
                        <div class="row" style="margin-top:5vh;">
                            <div class="col-md-6">
                                <div class="col-ting">
                                    <div class="control-group file-upload" id="file-upload1">
                                        <div class="image-box text-center">
                                            <p>Upload Passport Front</p>
                                            <img src="" alt="">
                                        </div>
                                        <div class="controls" style="display: none;">
                                            <input type="file" name="passport_copy_front"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-ting">
                                    <div class="control-group file-upload" id="file-upload1">
                                        <div class="image-box text-center">
                                            <p>Upload Passport Back</p>
                                            <img src="" alt="">
                                        </div>
                                        <div class="controls" style="display: none;">
                                            <input type="file" name="passport_copy_back"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Passport No: </label>
                                            <input value="{{ $details->passport_no }}" class="form-control" placeholder="Passport no" name="passpord_no" type="text" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Issue Date: </label>
                                            <input autocomplete="off" name="passport_issue_date" value="{{ $details->passport_issue_date }}" type="text" class="form-control date-pick" placeholder="Issue date">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiry Date: </label>
                                            <input autocomplete="off" name="passport_expiry_date" value="{{ $details->passport_expiry_date }}" type="text" class="form-control date-pick" placeholder="Expiry date">
                                        </div>
                                    </div>                                                          
                                </div>
                            </div>  

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Visa No: </label>
                                            <input value="{{ $details->visa_no }}" class="form-control" placeholder="Visa no" name="visa_no" type="text" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>UID No: </label>
                                            <input value="{{ $details->uid_no }}" class="form-control" placeholder="UID no" name="uid_no" type="text" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Issue Date: </label>
                                            <input autocomplete="off" name="uid_issue_date" value="{{ $details->uid_issue_date }}" type="text" class="form-control date-pick" placeholder="Issue date">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiry Date: </label>
                                            <input autocomplete="off" name="uid_expiry_date" value="{{ $details->uid_expiry_date }}" type="text" class="form-control date-pick" placeholder="Expiry date">
                                        </div>
                                    </div>                              
                                </div>

                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Emirates ID No: </label>
                                            <input value="{{ $details->emirates_id_no }}" class="form-control" placeholder="Emirates id" name="emirates_id_no" type="text" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiry Date: </label>
                                            <input autocomplete="off" name="emirates_expiry" value="{{ $details->emirates_expiry }}" type="text" class="form-control date-pick" placeholder="Expiry date">
                                        </div>
                                    </div>                              
                                </div>
                            </div>  
                    
                            <div class="col-md-4">
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Labour Card No: </label>
                                            <input value="{{ $details->labour_card_no }}" class="form-control" placeholder="Labour card no" name="labour_card_no" type="text" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiry Date: </label>
                                            <input autocomplete="off" name="labour_expiry" value="{{ $details->labour_expiry }}" type="text" class="form-control date-pick" placeholder="Expiry date">
                                        </div>
                                    </div>                             
                                
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Personal Number: </label>
                                            <input value="{{ $details->personal_number }}" class="form-control" placeholder="Personal number" name="personal_number" type="text" >
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Profession in Labour Card: </label>
                                            <input value="{{ $details->profession_in_labour_card }}" class="form-control" placeholder="Profession in labour card" name="profession_in_labour_card" type="text" >
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="teacher">
                        <!-- salary info -->
                        <div class="row"  style="margin-top:5vh">
                            <div class="col-md-6">
                                <div class="row">    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Basic Salary: </label>
                                            <input value="{{$details->basic_salary}}" class="form-control" placeholder="Basic salary" name="basic_salary" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="allowances">Allowances: </label>
                                            <select class="select form-control" id="allowances" name="allowances"  data-fouc data-placeholder="Choose..">
                                                <option value=""></option>
                                                <option {{ ($details->allowances == 'Housing allowance') ? 'selected' : '' }} value="Housing allowance">Housing allowance</option>
                                                <option {{ ($details->allowances == 'Transportation allowance') ? 'selected' : '' }} value="Transportation allowance">Transportation allowance</option>
                                                <option {{ ($details->allowances == 'Master degree allowance') ? 'selected' : '' }} value="Master degree allowance">Master degree allowance</option>
                                                <option {{ ($details->allowances == 'Experience allowance') ? 'selected' : '' }} value="Experience allowance">Experience allowance</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amount: </label>
                                            <input value="{{$details->allowances_amount}}" class="form-control" placeholder="" name="allowances_amount" type="text">
                                            change: <i class="icon-table allowances_change" style="cursor:pointer;" data-toggle="modal" data-target="#allowance"></i>
                                        </div>
                                        
                                        <div class="modal fade allowance_modal" id="allowance" tabindex="-1" role="dialog" aria-labelledby="allowanceLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Allowance</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">Year</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                                                                        
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input value="" class="form-control" placeholder="Year" name="new_allowance_year" type="text" >
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input value="" class="form-control" placeholder="Type" name="new_allowance_type" type="text" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input value="" class="form-control" placeholder="Amount" name="new_allowance_amount" type="text" >
                                                        </div>
                                                        <div class="col-md-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" name="setAllowance">Save changes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="allowances">Responsibility Allowances: </label>
                                            <select class="select form-control" id="responsibility_allowances" name="responsibility_allowances"  data-fouc data-placeholder="Choose..">
                                                <option value=""></option>
                                                <option {{ ($details->responsibility_allowances == 'Head of secondary allowance') ? 'selected' : '' }} value="Head of secondary allowance">Head of secondary allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Head of primary allowance') ? 'selected' : '' }} value="Head of primary allowance">Head of primary allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Head of Arabic & Islamic allowance') ? 'selected' : '' }} value="Head of Arabic & Islamic allowance">Head of Arabic & Islamic allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Head of department allowance') ? 'selected' : '' }} value="Head of department allowance">Head of department allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Timetable Allowance') ? 'selected' : '' }} value="Timetable Allowance">Timetable Allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'House points Allowance') ? 'selected' : '' }} value="House points Allowance">House points Allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Data & Assessments allowance') ? 'selected' : '' }} value="Data & Assessments allowance">Data & Assessments allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Curriculum allowance') ? 'selected' : '' }} value="Curriculum allowance">Curriculum allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Moral & Social allowance') ? 'selected' : '' }} value="Moral & Social allowance">Moral & Social allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Year Leader Allowance') ? 'selected' : '' }} value="Year Leader Allowance">Year Leader Allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Subject co-ordinator allowance') ? 'selected' : '' }} value="Subject co-ordinator allowance">Subject co-ordinator allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Teacher cover allowance') ? 'selected' : '' }} value="Teacher cover allowance">Teacher cover allowance</option>
                                                <option {{ ($details->responsibility_allowances == 'Arabic co-ordinators Allowance') ? 'selected' : '' }} value="Arabic co-ordinators Allowance">Arabic co-ordinators Allowance</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label>Amount: </label>
                                            <input value="{{$details->responsibility_allowances_amount}}" class="form-control" placeholder="" name="responsibility_allowances_amount" type="text">
                                            change: <i class="icon-table responsibility_allowances_change" style="cursor:pointer;" data-toggle="modal" data-target="#responsibility_allowance"></i>
                                        </div>

                                        <div class="modal fade responsibility_allowance_modal" id="responsibility_allowance" tabindex="-2" role="dialog" aria-labelledby="responsibility_allowanceLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Responsibility Allowance</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">Year</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                                                                        
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input value="" class="form-control" placeholder="Year" name="new_responsibility_allowance_year" type="text" >
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input value="" class="form-control" placeholder="Type" name="new_responsibility_allowance_type" type="text" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input value="" class="form-control" placeholder="Amount" name="new_responsibility_allowance_amount" type="text" >
                                                        </div>
                                                        <div class="col-md-3"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" name="setResponsibilityAllowance">Save changes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>     
                                </div>    
                                <div class="row">    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Total Salary: </label>
                                            <input value="{{$details->total_salary}}" class="form-control" placeholder="Total salary" name="total_salary" type="text" >
                                        </div>
                                    </div>
                                </div>                                    
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>New Salary: </label>
                                            <input value="{{$details->new_salary}}" class="form-control" placeholder="New salary" name="new_salary" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Increment: </label>
                                            <input value="{{$details->increment}}" class="form-control" placeholder="Increment" name="increment" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Year of Increment: </label>
                                            <input value="{{$details->year_of_increment}}" class="form-control" placeholder="Year of increment" name="year_of_increment" type="text" >
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bank (where salary transferred): </label>
                                    <input value="{{ $details->bank }}" class="form-control" placeholder="Bank" name="bank" type="text" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>IBAN: </label>
                                    <input value="{{ $details->iban }}" class="form-control" placeholder="IBAN" name="iban" type="text" >
                                </div>
                            </div>
                        </div>
                        <!-- Medical info -->
                        <div>

                            <div class="row"  style="margin-top:5vh">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="medical" style="margin-top: 2em;">Medical Entitlement: </label>
                                        <label class="switch" style="float:right">
                                            <input type="checkbox" name="medical_entitlement" 
                                                @if($details->medical_entitlement == 'on')
                                                    checked
                                                @endif
                                            >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3 medical">
                                    <div class="form-group">
                                        <label for="medical">Medical Category: </label>
                                        <select class="select form-control" id="meidcal_category" name="medical_category"  data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ ($details->medical_category == 'Plan A+') ? 'selected' : '' }} value="Plan A+">Plan A+</option>
                                            <option {{ ($details->medical_category == 'Plan A') ? 'selected' : '' }} value="Plan A">Plan A</option>
                                            <option {{ ($details->medical_category == 'Plan B') ? 'selected' : '' }} value="Plan B">Plan B</option>
                                            <option {{ ($details->medical_category == 'Plan over 60') ? 'selected' : '' }} value="Plan over 60">Plan over 60</option>
                                            <option {{ ($details->medical_category == 'Life') ? 'selected' : '' }} value="Life">Life</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 medical">
                                    <div class="form-group medical_life">
                                        <label for="medical">Details: </label>
                                        <textarea value="" class="form-control" placeholder="" name="medical_life" rows="3">{{ $details->medical_life }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>                                        

                                <div class="col-md-3 medical">
                                    <div class="form-group">
                                        <label for="allowances">Yealy: </label>
                                        <select class="select form-control" id="yearly" name="yearly"  data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ ($details->yearly == 'Yearly') ? 'selected' : '' }} value="Yearly">Yearly</option>
                                            <option {{ ($details->yearly == '2yearly') ? 'selected' : '' }} value="2yearly">2yearly</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 medical">
                                    <div class="form-group">
                                        <label for="allowances">Locally: </label>
                                        <select class="select form-control" id="locally" name="locally"  data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ ($details->locally == 'LHR') ? 'selected' : '' }} value="LHR">LHR</option>
                                            <option {{ ($details->locally == 'JNB') ? 'selected' : '' }} value="JNB">JNB</option>
                                            <option {{ ($details->locally == 'Cairo') ? 'selected' : '' }} value="Cairo">Cairo</option>
                                            <option {{ ($details->locally == 'New Delhi') ? 'selected' : '' }} value="New Delhi">New Delhi</option>
                                            <option {{ ($details->locally == 'Islamabad') ? 'selected' : '' }} value="Islamabad">Islamabad</option>
                                            <option {{ ($details->locally == 'Dhaka') ? 'selected' : '' }} value="Dhaka">Dhaka</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row medical">
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Medical Card No: </label>
                                        <input value="{{ $details->medical_card_no }}" class="form-control" placeholder="Medical card no" name="medical_card_no" type="text" >
                                    </div>
                                </div>                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Expiry Date: </label>
                                        <input autocomplete="off" name="medical_expiry_date" value="{{ $details->medical_expiry_date }}" type="text" class="form-control date-pick" placeholder="Expiry date">
                                    </div>
                                </div>                                
                            </div>
                            

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <label for="allowances" style="margin-top: 2em;">Flight Entitlement: </label>
                                            <label class="switch" style="float:right">
                                                <input type="checkbox" name="flight_entitlement"  
                                                    @if($details->flight_entitlement == 'on')
                                                        checked
                                                    @endif
                                                >
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <label for="allowances" style="margin-top: 2em;">Sector Entitlement: </label>
                                            <label class="switch" style="float:right">
                                                <input type="checkbox" name="sector_entitlement" 
                                                    @if($details->sector_entitlement == 'on')
                                                        checked
                                                    @endif
                                                >
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <label for="allowances" style="margin-top: 2em;">Last Availed: </label>
                                            <label class="switch" style="float:right;">
                                                <input type="checkbox" name="last_availed" 
                                                    @if($details->last_availed == 'on')
                                                        checked
                                                    @endif
                                                >
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div>
                                            <label for="allowances" style="margin-top: 2em;">Visa Entitlement: </label>
                                            <label class="switch" style="float:right;">
                                                <input type="checkbox" name="visa_entitlement" 
                                                    @if($details->visa_entitlement == 'on')
                                                        checked
                                                    @endif
                                                >
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Comment info -->
                        <div>

                            <div class="row" style="margin-top:5vh">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="last working">Last Working Day: </label>
                                        <textarea value="" class="form-control" placeholder="" name="last_working_day" rows="3">{{ $details->last_working_day }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="resignation">Reason for Resignation: </label>
                                        <textarea value="" class="form-control" placeholder="" name="reason_for_resignation" rows="3">{{ $details->reason_for_resignation }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="leave">Type of Leaving: </label>
                                        <select class="select form-control" id="leaving" name="type_of_leaving"  data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option {{ ($details->type_of_leaving == 'Medical leave') ? 'selected' : '' }} value="Medical leave">Medical leave</option>
                                            <option {{ ($details->type_of_leaving == 'Emergency leave') ? 'selected' : '' }} value="Emergency leave">Emergency leave</option>
                                            <option {{ ($details->type_of_leaving == 'Maternity leave') ? 'selected' : '' }} value="Maternity leave">Maternity leave</option>
                                        </select>
                                    </div>
                                </div>
                                @if($details->type_of_leaving == 'Emergency leave')
                                <div class="col-md-8">
                                    <div class="form-group emergency_leave">
                                        <label for="leave">Details: </label>
                                        <textarea value="" class="form-control" placeholder="" name="emergency_leave" rows="3">{{ $details->emergency_leave }}</textarea>
                                    </div>
                                </div>
                                @endif
                            </div> 
                            
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="leave">Comment on Leaving: </label>
                                        <textarea value="" class="form-control" placeholder="" name="comment_on_leaving" rows="5">{{ $details->comment_on_leaving }}</textarea>
                                    </div>
                                </div>
                            </div> 

                        </div>
                    </div>                      
                    
                </fieldset>
                @endif

            </form>
        </div>

        <script>

            var getAllowances = "{{ route('users.getAllowances')}}";
            var setAllowances = "{{ route('users.setAllowances')}}";
            var delAllowances = "{{ route('users.delAllowances')}}";

            var getResponsibilityAllowances = "{{ route('users.getResponsibilityAllowances')}}";
            var setResponsibilityAllowances = "{{ route('users.setResponsibilityAllowances')}}";
            var delResponsibilityAllowances = "{{ route('users.delResponsibilityAllowances')}}";

            var medical_entitlement = "{{ isset($details->medical_entitlement)?$details->medical_entitlement:'off' }}";
            var medical_life = "{{ isset($details->medical_category)?$details->medical_category:'off' }}";
            var emergency_leave = "{{ isset($details->type_of_leaving)?$details->type_of_leaving:'off' }}";

        </script>

    </div>
@endsection
