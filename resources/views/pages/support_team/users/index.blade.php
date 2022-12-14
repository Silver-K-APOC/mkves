@extends('layouts.master')
@section('page_title', 'Manage Profiles')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Profiles</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            @if(Auth::user()->user_type == 'super_admin')
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#new-user" class="nav-link active" data-toggle="tab">Create</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($user_types as $ut)
                            <a href="#ut-{{ Qs::hash($ut->id) }}" class="dropdown-item" data-toggle="tab" trigger-toggle="{{ $ut->title }}">{{ $ut->name }}s</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="new-user">
                    <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-store" action="{{ route('users.store') }}" data-fouc>
                        @csrf
                        <h6>Personal Data</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="user_type"> Select Type: </label>
                                        <select data-placeholder="Select User" class="form-control select" name="user_type" id="user_type">
                                        @foreach($user_types as $ut)
                                            <option value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                                        @endforeach
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
                                
                                <div class="col-md-8 staff" style="padding:20px">
                                    <div class="form-group">
                                        <label>Full Name: </label>
                                        <input value="" type="text" name="name" placeholder="Full Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Username: </label>
                                        <input value="" type="text" name="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address: </label>
                                        <input value="" type="email" name="email" class="form-control" placeholder="your@email.com">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone:</label>
                                                <input value="" type="text" name="phone" class="form-control" placeholder="+2341234567" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Telephone:</label>
                                                <input value="" type="text" name="phone2" class="form-control" placeholder="+2341234567" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address: </label>
                                        <input value="" class="form-control" placeholder="Address" name="address" type="text">
                                    </div>
                                </div>

                                <div class="col-md-8 teacher" style="margin-top:5vh;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Serial No: </label>
                                                <input value=""  type="text" name="serial_no" placeholder="Serial no" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>File No: </label>
                                                <input value=""  type="text" name="file_no" placeholder="File no" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Known Name: </label>
                                                <input value=""  type="text" name="known_name" placeholder="Known name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name as per Passport: </label>
                                                <input value="" class="form-control" placeholder="Name as per passport" name="name_as_per_passport" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row teacher">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Position in School: </label>
                                        <input value="" class="form-control" placeholder="Position in school"  type="text" name="position_in_school">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Profession in Visa: </label>
                                        <input value="" class="form-control" placeholder="Profession in visa" name="profession_in_visa" type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="row teacher">
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Joining: </label>
                                        <input autocomplete="off" name="date_of_joining" value="" type="text" class="form-control date-pick" placeholder="Date of joining">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract">Type of Contract: </label>
                                        <select class="select form-control" id="contract" name="type_of_contract"  data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option value="Overseas contracts">Overseas contracts</option>
                                            <option value="Local plus contracts">Local plus contracts</option>
                                            <option value="Local contracts">Local contracts</option>
                                            <option value="UAE national contracts">UAE national contracts</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="marital">Marital Status: </label>
                                        <select class="select form-control" id="marital" name="marital_status"  data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Religion: </label>
                                        <input value="" class="form-control" placeholder="Religion" name="religion" type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="row teacher">
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Birth: </label>
                                        <input autocomplete="off" name="date_of_birth" value="" type="text" class="form-control date-pick" placeholder="Date of birth">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Current Age: </label>
                                        <input value="" class="form-control" placeholder="Current age" name="current_age" type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="row teacher">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father's Name: </label>
                                        <input value="" class="form-control" placeholder="Father's name" name="fathers_name" type="text" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mother's Name: </label>
                                        <input value="" class="form-control" placeholder="Mother's name" name="mothers_name" type="text" >
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
                                                    <input value="" class="form-control" placeholder="Passport no" name="passpord_no" type="text" >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Issue Date: </label>
                                                    <input autocomplete="off" name="passport_issue_date" value="" type="text" class="form-control date-pick" placeholder="Issue date">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Expiry Date: </label>
                                                    <input autocomplete="off" name="passport_expiry_date" value="" type="text" class="form-control date-pick" placeholder="Expiry date">
                                                </div>
                                            </div>                                                          
                                        </div>
                                    </div>  

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Visa No: </label>
                                                    <input value="" class="form-control" placeholder="Visa no" name="visa_no" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>UID No: </label>
                                                    <input value="" class="form-control" placeholder="UID no" name="uid_no" type="text" >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Issue Date: </label>
                                                    <input autocomplete="off" name="uid_issue_date" value="" type="text" class="form-control date-pick" placeholder="Issue date">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Expiry Date: </label>
                                                    <input autocomplete="off" name="uid_expiry_date" value="" type="text" class="form-control date-pick" placeholder="Expiry date">
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
                                                    <input value="" class="form-control" placeholder="Emirates id" name="emirates_id_no" type="text" >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Expiry Date: </label>
                                                    <input autocomplete="off" name="emirates_expiry" value="" type="text" class="form-control date-pick" placeholder="Expiry date">
                                                </div>
                                            </div>                              
                                        </div>
                                    </div>  
                            
                                    <div class="col-md-4">
                                        <div class="row">
                                        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Labour Card No: </label>
                                                    <input value="" class="form-control" placeholder="Labour card no" name="labour_card_no" type="text" >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Expiry Date: </label>
                                                    <input autocomplete="off" name="labour_expiry" value="" type="text" class="form-control date-pick" placeholder="Expiry date">
                                                </div>
                                            </div>                             
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Personal Number: </label>
                                                    <input value="" class="form-control" placeholder="Personal number" name="personal_number" type="text" >
                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Profession in Labour Card: </label>
                                                    <input value="" class="form-control" placeholder="Profession in labour card" name="profession_in_labour_card" type="text" >
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
                                                    <input value="" class="form-control" placeholder="Basic salary" name="basic_salary" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="allowances">Allowances: </label>
                                                    <select class="select form-control" id="allowances" name="allowances"  data-fouc data-placeholder="Choose..">
                                                        <option value=""></option>
                                                        <option value="Housing allowance">Housing allowance</option>
                                                        <option value="Transportation allowance">Transportation allowance</option>
                                                        <option value="Master degree allowance">Master degree allowance</option>
                                                        <option value="Experience allowance">Experience allowance</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Amount: </label>
                                                    <input value="" class="form-control" placeholder="" name="allowances_amount" type="text">
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
                                                        <option value="Head of secondary allowance">Head of secondary allowance</option>
                                                        <option value="Head of primary allowance">Head of primary allowance</option>
                                                        <option value="Head of Arabic & Islamic allowance">Head of Arabic & Islamic allowance</option>
                                                        <option value="Head of department allowance">Head of department allowance</option>
                                                        <option value="Timetable Allowance">Timetable Allowance</option>
                                                        <option value="House points Allowance">House points Allowance</option>
                                                        <option value="Data & Assessments allowance">Data & Assessments allowance</option>
                                                        <option value="Curriculum allowance">Curriculum allowance</option>
                                                        <option value="Moral & Social allowance">Moral & Social allowance</option>
                                                        <option value="Year Leader Allowance">Year Leader Allowance</option>
                                                        <option value="Subject co-ordinator allowance">Subject co-ordinator allowance</option>
                                                        <option value="Teacher cover allowance">Teacher cover allowance</option>
                                                        <option value="Arabic co-ordinators Allowance">Arabic co-ordinators Allowance</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">


                                                <div class="form-group">
                                                    <label>Amount: </label>
                                                    <input value="" class="form-control" placeholder="" name="responsibility_allowances_amount" type="text">
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
                                                    <input value="" class="form-control" placeholder="Total salary" name="total_salary" type="text" >
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>New Salary: </label>
                                                    <input value="" class="form-control" placeholder="New salary" name="new_salary" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Increment: </label>
                                                    <input value="" class="form-control" placeholder="Increment" name="increment" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Year of Increment: </label>
                                                    <input value="" class="form-control" placeholder="Year of increment" name="year_of_increment" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bank (where salary transferred): </label>
                                            <input value="" class="form-control" placeholder="Bank" name="bank" type="text" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>IBAN: </label>
                                            <input value="" class="form-control" placeholder="IBAN" name="iban" type="text" >
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
                                                    <input type="checkbox" name="medical_entitlement">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3 medical">
                                            <div class="form-group">
                                                <label for="medical">Medical Category: </label>
                                                <select class="select form-control" id="meidcal_category" name="medical_category"  data-fouc data-placeholder="Choose..">
                                                    <option value=""></option>
                                                    <option value="Plan A+">Plan A+</option>
                                                    <option value="Plan A">Plan A</option>
                                                    <option value="Plan B">Plan B</option>
                                                    <option value="Plan over 60">Plan over 60</option>
                                                    <option value="Life">Life</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 medical">
                                            <div class="form-group medical_life">
                                                <label for="medical">Details: </label>
                                                <textarea value="" class="form-control" placeholder="" name="medical_life" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>                                        

                                        <div class="col-md-3 medical">
                                            <div class="form-group">
                                                <label for="allowances">Yealy: </label>
                                                <select class="select form-control" id="yearly" name="yearly"  data-fouc data-placeholder="Choose..">
                                                    <option value=""></option>
                                                    <option value="Yearly">Yearly</option>
                                                    <option value="2yearly">2yearly</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 medical">
                                            <div class="form-group">
                                                <label for="allowances">Locally: </label>
                                                <select class="select form-control" id="locally" name="locally"  data-fouc data-placeholder="Choose..">
                                                    <option value=""></option>
                                                    <option value="LHR">LHR</option>
                                                    <option value="JNB">JNB</option>
                                                    <option value="Cairo">Cairo</option>
                                                    <option value="New Delhi">New Delhi</option>
                                                    <option value="Islamabad">Islamabad</option>
                                                    <option value="Dhaka">Dhaka</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row medical">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Medical Card No: </label>
                                                <input value="" class="form-control" placeholder="Medical card no" name="medical_card_no" type="text" >
                                            </div>
                                        </div>                                

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Expiry Date: </label>
                                                <input autocomplete="off" name="medical_expiry_date" value="" type="text" class="form-control date-pick" placeholder="Expiry date">
                                            </div>
                                        </div>                                
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div>
                                                    <label for="allowances" style="margin-top: 2em;">Flight Entitlement: </label>
                                                    <label class="switch" style="float:right">
                                                        <input type="checkbox" name="flight_entitlement">
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
                                                        <input type="checkbox" name="sector_entitlement">
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
                                                        <input type="checkbox" name="last_availed">
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
                                                        <input type="checkbox" name="visa_entitlement">
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
                                                <textarea value="" class="form-control" placeholder="" name="last_working_day" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="resignation">Reason for Resignation: </label>
                                                <textarea value="" class="form-control" placeholder="" name="reason_for_resignation" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">                                
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="leave">Type of Leaving: </label>
                                                <select class="select form-control" id="leaving" name="type_of_leaving"  data-fouc data-placeholder="Choose..">
                                                    <option value=""></option>
                                                    <option value="Medical leave">Medical leave</option>
                                                    <option value="Emergency leave">Emergency leave</option>
                                                    <option value="Maternity leave">Maternity leave</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group emergency_leave">
                                                <label for="leave">Details: </label>
                                                <textarea value="" class="form-control" placeholder="" name="emergency_leave" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="row">                                
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="leave">Comment on Leaving: </label>
                                                <textarea value="" class="form-control" placeholder="" name="comment_on_leaving" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div> 

                                </div>  

                            </div>                         
                            
                        </fieldset>
                    </form>
                </div>
                @foreach($user_types as $ut)
                    <div class="tab-pane fade" id="ut-{{Qs::hash($ut->id)}}">                         
                        @if($ut->title == 'teacher')
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Birth</th>
                                <th>Position in School</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users->where('user_type', $ut->title) as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="photo"></td>
                                    <td>{{ $u->name }}</td>
                                    @foreach($details->where('created_by_user_code', $u->code) as $d)
                                        <td>{{ $d->date_of_birth }}</td>
                                        <td>{{ $d->position_in_school }}</td>
                                    @endforeach
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    {{--View Profile--}}
                                                    <a href="{{ route('users.show', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Profile</a>
                                                    
                                                @if(Qs::userIsSuperAdmin())

                                                        {{--Edit--}}
                                                        <a href="{{ route('users.edit', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                        <!-- <a href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a> -->
                                                        {{--Delete--}}
                                                        <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form>
                                                @endif

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else                 

                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Telephone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users->where('user_type', $ut->title) as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="photo"></td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->phone }}</td>
                                    <td>{{ $u->telephone }}</td>
                                    <td>{{ $u->address }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    
                                                @if(Qs::userIsSuperAdmin())
                                                        {{--Edit--}}
                                                        <a href="{{ route('users.edit', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                        <a href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a>
                                                        {{--Delete--}}
                                                        <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form>
                                                @endif

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                @endforeach
            </div>
            @else
                @foreach($user_types as $ut)
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Birth</th>
                        <th>Position in School</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users->where('user_type', $ut->title) as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="photo"></td>
                            <td>{{ $u->name }}</td>
                            @foreach($details->where('created_by_user_code', $u->code) as $d)
                                <td>{{ $d->date_of_birth }}</td>
                                <td>{{ $d->position_in_school }}</td>
                            @endforeach
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                            {{--View Profile--}}
                                            <a href="{{ route('users.show', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Profile</a>
                                            
                                        @if(Qs::userIsSuperAdmin())

                                                {{--Edit--}}
                                                <a href="{{ route('users.edit', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                <!-- <a href="{{ route('users.reset_pass', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a> -->
                                                {{--Delete--}}
                                                <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('users.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endforeach
            @endif
        </div>

        <script>

            var getAllowances = "{{ route('users.getAllowances')}}";
            var setAllowances = "{{ route('users.setAllowances')}}";
            var delAllowances = "{{ route('users.delAllowances')}}";

            var getResponsibilityAllowances = "{{ route('users.getResponsibilityAllowances')}}";
            var setResponsibilityAllowances = "{{ route('users.setResponsibilityAllowances')}}";
            var delResponsibilityAllowances = "{{ route('users.delResponsibilityAllowances')}}";

            var medical_entitlement = 'off';
            var medical_life = 'off';
            var emergency_leave = 'off';

            var teacher_list = "{{ isset($teacher_list)?'on':'off' }}";
            console.log("teacher_list", teacher_list);
            var admin_list = "{{ isset($admin_list)?'on':'off' }}";
            console.log("admin_list", admin_list);

        </script>
    </div>

    {{--Student List Ends--}}

@endsection
