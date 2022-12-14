@extends('layouts.master')
@section('page_title', 'User Profile - '.$user->name)
@section('content')
    <div class="row">
        <!-- <div class="col-md-3 text-center">
            <div class="card">
                <div class="card-body">
                    <img style="width: 90%; height:90%" src="{{ $user->photo }}" alt="photo" class="rounded-circle">
                    <br>
                    <h3 class="mt-3" id="PDFName">{{ $user->name }}</h3>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-md-9"> -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('users.teacher_list') }}" style="float:right;"><i class="icon-paragraph-justify3"></i></a>
                    
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" >{{ $user->name }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="btn btn-primary pdf_maker" style="margin-bottom: 10px;">PDF <i class="icon-file-pdf"></i></div>
                        <div class="btn btn-primary pdf_printer" style="margin-bottom: 10px;">Print <i class="icon-printer"></i></div>
                        {{--Basic Info--}}
                        <div class="tab-pane fade show active" id="PDFTarget" style="overflow-x: scroll;">

                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td rowspan="2" colspan="2"><img style="height: 150px;" src="{{ $user->photo }}" alt="photo"></td>
                                    <td class="font-weight-bold">Serial No: {{ $details->serial_no }}</td>
                                    <td class="font-weight-bold">File No: {{ $details->file_no }}</td>
                                    
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Known Name: <br/>{{ $details->known_name }}</td>                                
                                    <td class="font-weight-bold">Name as per Passport: <br/>{{ $details->name_as_per_passport }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Position in School</td>
                                    <td colspan="2">{{ $details->position_in_school }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Profession in Visa</td>
                                    <td colspan="2">{{ $details->profession_in_visa }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Date of Joining</td>
                                    <td>{{ $details->date_of_joining }}</td>
                                
                                    <td class="font-weight-bold">Type of Contract</td>
                                    <td>{{ $details->type_of_contract }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Marital Status</td>
                                    <td>{{ $details->marital_status }}</td>
                                
                                    <td class="font-weight-bold">Religion</td>
                                    <td>{{ $details->religion }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Date of Birth</td>
                                    <td>{{ $details->date_of_birth }}</td>
                                
                                    <td class="font-weight-bold">Current Age</td>
                                    <td>{{ $details->current_age }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" colspan="2">Father's Name</td>
                                    <td colspan="2">{{ $details->fathers_name }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Mother's Name</td>
                                    <td colspan="2">{{ $details->mothers_name }}</td>
                                </tr>



                                <!-- passport -->
                                <tr>
                                    <td class="font-weight-bold" rowspan="2">Passport No: {{ $details->passport_no }}</td> 
                                    <td><strong> Issue Date: </strong> {{ $details->passport_issue_date }}</td>
                                    <td rowspan="2"><img style="width: 150px" src="{{ $details->passport_copy_front }}" alt="Passport Front"></td>
                                    <td rowspan="2"><img style="width: 150px" src="{{ $details->passport_copy_back }}" alt="Passport Back"></td></td>
                                </tr>
                                <tr><td><strong> Expiry Date: </strong> {{ $details->passport_expiry_date }}</td></tr>
                                


                                <tr>
                                    <td class="font-weight-bold" colspan="2">Visa No </td>
                                    <td colspan="2">{{ $details->visa_no }}</td>
                                </tr>


                                <tr>
                                    <td class="font-weight-bold" colspan="2">UID No: {{ $details->uid_no }}</td>
                                    <td><strong> Issue Date: </strong> {{ $details->uid_issue_date }}</td>
                                    <td><strong> Expiry Date: </strong> {{ $details->uid_expiry_date }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Emirates ID No: {{ $details->emirates_id_no }}</td>
                                    <td colspan="2"> <strong> Expiry Date: </strong> {{ $details->emirates_expiry }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Personal Number</td>
                                    <td> {{ $details->personal_number }}</td>
                                
                                    <td class="font-weight-bold">Profession in Labour Card</td>
                                    <td>{{ $details->profession_in_labour_card }}</td>
                                </tr>

                                <!-- Salary -->
                                <tr>
                                    <td class="font-weight-bold" rowspan="2">Basic Salary</td>
                                    <td rowspan="2">{{ $details->basic_salary }}</td>
                                
                                    <td><strong>Allowance:</strong> <br/>{{$details->allowances}} </td>
                                    <td>{{ $details->allowances_amount }} DHS</td>
                                </tr>
                                <tr>
                                    <td><strong>Responsibility Allowance:</strong> <br/>{{$details->responsibility_allowances}} </td>
                                    <td>{{ $details->responsibility_allowances_amount }} DHS</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" rowspan="2">New Salary</td>
                                    <td rowspan="2">{{ $details->new_salary }}</td>
                                
                                    <td><strong>Increment</strong></td>
                                    <td>{{ $details->increment }} </td>
                                </tr>
                                <tr>
                                    <td><strong>Year of Increment</strong></td>
                                    <td>{{ $details->year_of_increment }} </td>
                                </tr>


                                <tr>
                                    <td class="font-weight-bold" colspan="2">Total Salary</td>
                                    <td colspan="2">{{ $details->total_salary }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Bank(where salary transferred)</td>
                                    <td>{{ $details->bank }}</td>
                                    <td class="font-weight-bold">IBAN</td>
                                    <td>{{ $details->iban }}</td>
                                </tr>

                                @if($details->medical_entitlement == 'off')
                                <tr>
                                    <td class="font-weight-bold" colspan="2">Medical Entitlement</td>
                                    <td colspan="2">off</td>
                                </tr>
                                @else
                                    @if($details->medical_category == 'Life')
                                    <tr>
                                        <td class="font-weight-bold" rowspan="3">Medical Entitlement</td>
                                        <td rowspan="3">{{$details->medical_category}}</td>
                                        <td colspan="2">{{$details->medical_life}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$details->yearly}}</td>
                                        <td>{{$details->locally}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Medical Card No:</strong> <br/>{{$details->medical_card_no}}</td>
                                        <td><strong>Expiry Date:</storng> <br/>{{$details->medical_expiry_date}}</td>
                                    </tr>
                                    
                                    @else
                                    <tr>
                                        <td class="font-weight-bold" rowspan="2">Medical Entitlement</td>
                                        <td rowspan="2">{{$details->medical_category}}</td>
                                        <td>{{$details->yearly}}</td>
                                        <td>{{$details->locally}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Medical Card No:</strong> <br/>{{$details->medical_card_no}}</td>
                                        <td><strong>Expiry Date:</storng> <br/>{{$details->medical_expiry_date}}</td>
                                    </tr>
                                    @endif
                                @endif

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Flight Entitlement</td>
                                    <td colspan="2">{{ $details->flight_entitlement }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Sector Entitlement</td>
                                    <td colspan="2">{{ $details->sector_entitlement }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Last Availed</td>
                                    <td colspan="2">{{ $details->last_availed }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold" colspan="2">Visa Entitlement</td>
                                    <td colspan="2">{{ $details->visa_entitlement }}</td>
                                </tr>

                                <!-- last working -->

                                <tr>
                                    <td class="font-weight-bold">Last Working Day</td>
                                    <td colspan="3">{{ $details->last_working_day }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Reason for Resignation</td>
                                    <td colspan="3">{{ $details->reason_for_resignation }}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Type of Leaving</td>
                                    <td colspan="3">{{ $details->type_of_leaving }}
                                        @if($details->type_of_leaving == 'Emergency leave')
                                        <br/> "{{$details->emergency_leave}}"
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">Comment on Leaving</td>
                                    <td colspan="3">{{ $details->comment_on_leaving }}</td>
                                </tr>

                                </tbody>
                            </table>
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

                            var filename = "{{ $user->name }}";

                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--User Profile Ends--}}

@endsection
