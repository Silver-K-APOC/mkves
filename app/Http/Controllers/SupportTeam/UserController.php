<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\UserRequest;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    protected $user, $loc, $my_class;

    public function __construct(UserRepo $user, LocationRepo $loc, MyClassRepo $my_class)
    {
        $this->middleware('teamSA', ['only' => ['index', 'store', 'edit', 'update'] ]);
        $this->middleware('super_admin', ['only' => ['reset_pass','destroy'] ]);

        $this->user = $user;
        $this->loc = $loc;
        $this->my_class = $my_class;
    }

    public function index()
    {
        $ut = $this->user->getAllTypes();
        $ut2 = $ut->where('level', '>', 2);

        $d['user_types'] = Qs::userIsAdmin() ? $ut2 : $ut;
        $d['states'] = $this->loc->getStates();
        $d['users'] = $this->user->getPTAUsers();
        $d['nationals'] = $this->loc->getAllNationals();
        $d['blood_groups'] = $this->user->getBloodGroups();
        $d['details'] = DB::table('user_details')->get();

        return view('pages.support_team.users.index', $d);
    }

    public function teacherList()
    {
        $ut = $this->user->getAllTypes();
        $ut2 = $ut->where('level', '>', 2);

        $d['user_types'] = Qs::userIsAdmin() ? $ut2 : $ut;
        $d['states'] = $this->loc->getStates();
        $d['users'] = $this->user->getPTAUsers();
        $d['nationals'] = $this->loc->getAllNationals();
        $d['blood_groups'] = $this->user->getBloodGroups();
        $d['details'] = DB::table('user_details')->get();
        $d['teacher_list'] = 'on';

        return view('pages.support_team.users.index', $d);
    }

    public function adminList()
    {
        $ut = $this->user->getAllTypes();
        $ut2 = $ut->where('level', '>', 2);

        $d['user_types'] = Qs::userIsAdmin() ? $ut2 : $ut;
        $d['states'] = $this->loc->getStates();
        $d['users'] = $this->user->getPTAUsers();
        $d['nationals'] = $this->loc->getAllNationals();
        $d['blood_groups'] = $this->user->getBloodGroups();
        $d['details'] = DB::table('user_details')->get();
        $d['admin_list'] = 'on';

        return view('pages.support_team.users.index', $d);
    }

    public function edit($id)
    {
        $id = Qs::decodeHash($id);
        $d['user'] = $this->user->find($id);
        $d['states'] = $this->loc->getStates();
        $d['users'] = $this->user->getPTAUsers();
        $d['blood_groups'] = $this->user->getBloodGroups();
        $d['nationals'] = $this->loc->getAllNationals();
        $obj = DB::table('user_details')->where('created_by_user_code', $d['user']->code)->get();
        $d['details'] = isset($obj[0])?$obj[0]:array();
        return view('pages.support_team.users.edit', $d);
    }

    public function reset_pass($id)
    {
        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headSA($id)){
            return back()->with('flash_danger', __('msg.denied'));
        }

        $data['password'] = Hash::make('123456789');
        $this->user->update($id, $data);
        return back()->with('flash_success', __('msg.pu_reset'));
    }

    public function store(UserRequest $req)
    {
        $user_type = $this->user->findType($req->user_type)->title;

        $data = $req->except(Qs::getStaffRecord());
        if($user_type != 'teacher'){
            $data['name'] = ucwords($req->name);
        }else{
            $data['name'] = ucwords($req->known_name);
        }
        $data['user_type'] = $user_type;
        $data['photo'] = Qs::getDefaultUserImage();
        $data['code'] = strtoupper(Str::random(10));

        $user_is_staff = in_array($user_type, Qs::getStaff());
        $user_is_teamSA = in_array($user_type, Qs::getTeamSA());

        $staff_id = Qs::getAppCode().'/STAFF/'.date('Y/m', strtotime($req->emp_date)).'/'.mt_rand(1000, 9999);

        if($user_type != 'teacher'){
            $data['username'] = $req->username;
        }else{
            $data['username'] = $data['code'];
        }

        // $pass = $req->password ?: $user_type;
        $data['password'] = Hash::make('123456789');

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type).$data['code'], $f['name']);
            $data['photo'] = asset('storage/' . $f['path']);
        }

        /* Ensure that both username and Email are not blank*/
        // if(!$uname && !$req->email){
        //     return back()->with('pop_error', __('msg.user_invalid'));
        // }
        if($user_type == 'teacher'){
            
            $passport_copy_front = Qs::getDefaultNoneImage();
            $passport_copy_back = Qs::getDefaultNoneImage();

            if($req->hasFile('passport_copy_front')) {
                $passport_copy_front = $req->file('passport_copy_front');
                $f = Qs::getFileMetaData($passport_copy_front);
                $f['name'] = 'passport_copy_front.' . $f['ext'];
                $f['path'] = $passport_copy_front->storeAs(Qs::getUploadPath($user_type).$data['code'], $f['name']);
                $passport_copy_front = asset('storage/' . $f['path']);
            }

            if($req->hasFile('passport_copy_back')) {
                $passport_copy_back = $req->file('passport_copy_back');
                $f = Qs::getFileMetaData($passport_copy_back);
                $f['name'] = 'passport_copy_back.' . $f['ext'];
                $f['path'] = $passport_copy_back->storeAs(Qs::getUploadPath($user_type).$data['code'], $f['name']);
                $passport_copy_back = asset('storage/' . $f['path']);
            }

            $medical_entitlement = isset($req->medical_entitlement)?'on':'off';
            $flight_entitlement = isset($req->flight_entitlement)?'on':'off';
            $sector_entitlement = isset($req->sector_entitlement)?'on':'off';
            $last_availed = isset($req->last_availed)?'on':'off';
            $visa_entitlement = isset($req->visa_entitlement)?'on':'off';
            

            $value = DB::table('user_details')->insert([

                'serial_no' => $req->serial_no,
                'file_no' => $req->file_no,
                'known_name' => $req->known_name,
                'name_as_per_passport' => $req->name_as_per_passport,
                'position_in_school' => $req->position_in_school,
                'profession_in_visa' => $req->profession_in_visa,
                'date_of_joining' => date('Y/m/d',strtotime($req->date_of_joining)),
                'type_of_contract' => $req->type_of_contract,
                'marital_status' => $req->marital_status,
                'religion' => $req->religion,
                'date_of_birth' => date('Y/m/d',strtotime($req->date_of_birth)),
                'current_age' => $req->current_age,
                'mothers_name' => $req->mothers_name,
                'fathers_name' => $req->fathers_name,

                // card info
                'passport_copy_front'=> $passport_copy_front,
                'passport_copy_back'=> $passport_copy_back,
                'passport_no'=> $req->passport_no,
                'passport_issue_date'=> date('Y/m/d', strtotime($req->passport_issue_date)),
                'passport_expiry_date'=> date('Y/m/d', strtotime($req->passport_expiry_date)),
                
                'visa_no'=> $req->visa_no,
    
                'uid_no'=> $req->uid_no,
                'uid_issue_date'=> date('Y/m/d', strtotime($req->uid_issue_date)),
                'uid_expiry_date'=> date('Y/m/d', strtotime($req->uid_expiry_date)),
    
                'emirates_id_no'=> $req->emirates_id_no,
                'emirates_expiry'=> date('Y/m/d', strtotime($req->emirates_expiry)),
                
                'labour_card_no'=> $req->labour_card_no,
                'labour_expiry'=> date('Y/m/d', strtotime($req->labour_expiry)),
    
                'personal_number'=> $req->personal_number,
                'profession_in_labour_card'=> $req->profession_in_labour_card,
                

                // salary info
                'basic_salary'=> $req->basic_salary,
                
                'allowances'=> $req->allowances,
                'allowances_amount'=> $req->allowances_amount,
                'responsibility_allowances'=> $req->responsibility_allowances,
                'responsibility_allowances_amount'=> $req->responsibility_allowances_amount,

                'new_salary'=> $req->new_salary,
                'increment'=> $req->increment,
                'year_of_increment'=> $req->year_of_increment,
                
                'total_salary'=> $req->total_salary,
                'bank'=> $req->bank,
                'iban'=> $req->iban,
    

                //medical entitlement
                'medical_entitlement'=> $medical_entitlement,
                'medical_category'=> $req->medical_category,
                'medical_life'=> $req->medical_life,
                'yearly'=> $req->yearly,
                'locally'=> $req->locally,
                'medical_card_no'=> $req->medical_card_no,
                'medical_expiry_date'=> date('Y/m/d', strtotime($req->medical_expiry_date)),
    
                'flight_entitlement'=> $flight_entitlement,
                'sector_entitlement'=> $sector_entitlement,
                'last_availed'=> $last_availed,
                'visa_entitlement'=> $visa_entitlement,
                
                //comment info
                'last_working_day'=> $req->last_working_day,
                'reason_for_resignation'=> $req->reason_for_resignation,
                'type_of_leaving'=> $req->type_of_leaving,
                'emergency_leave'=>$req->emergency_leave,
                'comment_on_leaving'=> $req->comment_on_leaving,

                'created_by_user_code' => $data['code'],
            ]);
        }

        $user = $this->user->create($data); // Create User

        /* CREATE STAFF RECORD */
        if($user_is_staff){
            $d2 = $req->only(Qs::getStaffRecord());
            $d2['user_id'] = $user->id;
            $d2['code'] = $staff_id;
            $this->user->createStaffRecord($d2);
        }

        return Qs::jsonStoreOk();
    }

    public function update(UserRequest $req, $id)
    {
        $id = Qs::decodeHash($id);

        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headSA($id)){
            return Qs::json(__('msg.denied'), FALSE);
        }

        $user = $this->user->find($id);

        $user_type = $user->user_type;
        $user_is_staff = in_array($user_type, Qs::getStaff());
        $user_is_teamSA = in_array($user_type, Qs::getTeamSA());

        $data = $req->except(Qs::getStaffRecord());
        $data['name'] = ucwords($req->name);
        $data['username'] = $req->username;
        $data['user_type'] = $user_type;

        if($user_type == 'teacher'){
            $data['name'] = ucwords($req->known_name);
            $data['username'] = $user->code;
        }

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type).$user->code, $f['name']);
            $data['photo'] = asset('storage/' . $f['path']);
        }


        if($user_type == 'teacher'){

            $details = DB::table('user_details')->where('created_by_user_code',$user->code)->get();
            
            $passport_copy_front = $details[0]->passport_copy_front;
            $passport_copy_back = $details[0]->passport_copy_back;

            if($req->hasFile('passport_copy_front')) {
                $passport_copy_front = $req->file('passport_copy_front');
                $f = Qs::getFileMetaData($passport_copy_front);
                $f['name'] = 'passport_copy_front.' . $f['ext'];
                $f['path'] = $passport_copy_front->storeAs(Qs::getUploadPath($user_type).$data['code'], $f['name']);
                $passport_copy_front = asset('storage/' . $f['path']);
            }

            if($req->hasFile('passport_copy_back')) {
                $passport_copy_back = $req->file('passport_copy_back');
                $f = Qs::getFileMetaData($passport_copy_back);
                $f['name'] = 'passport_copy_back.' . $f['ext'];
                $f['path'] = $passport_copy_back->storeAs(Qs::getUploadPath($user_type).$data['code'], $f['name']);
                $passport_copy_back = asset('storage/' . $f['path']);
            }

            $medical_entitlement = isset($req->medical_entitlement)?'on':'off';
            $flight_entitlement = isset($req->flight_entitlement)?'on':'off';
            $sector_entitlement = isset($req->sector_entitlement)?'on':'off';
            $last_availed = isset($req->last_availed)?'on':'off';
            $visa_entitlement = isset($req->visa_entitlement)?'on':'off';

            $value = DB::table('user_details')->where('created_by_user_code',$user->code)->update([

                'serial_no' => $req->serial_no,
                'file_no' => $req->file_no,
                'known_name' => $req->known_name,
                'name_as_per_passport' => $req->name_as_per_passport,
                'position_in_school' => $req->position_in_school,
                'profession_in_visa' => $req->profession_in_visa,
                'date_of_joining' => date('Y/m/d',strtotime($req->date_of_joining)),
                'type_of_contract' => $req->type_of_contract,
                'marital_status' => $req->marital_status,
                'religion' => $req->religion,
                'date_of_birth' => date('Y/m/d',strtotime($req->date_of_birth)),
                'current_age' => $req->current_age,
                'mothers_name' => $req->mothers_name,
                'fathers_name' => $req->fathers_name,

                // card info
                'passport_copy_front'=> $passport_copy_front,
                'passport_copy_back'=> $passport_copy_back,
                'passport_no'=> $req->passport_no,
                'passport_issue_date'=> date('Y/m/d', strtotime($req->passport_issue_date)),
                'passport_expiry_date'=> date('Y/m/d', strtotime($req->passport_expiry_date)),
                
                'visa_no'=> $req->visa_no,
    
                'uid_no'=> $req->uid_no,
                'uid_issue_date'=> date('Y/m/d', strtotime($req->uid_issue_date)),
                'uid_expiry_date'=> date('Y/m/d', strtotime($req->uid_expiry_date)),
    
                'emirates_id_no'=> $req->emirates_id_no,
                'emirates_expiry'=> date('Y/m/d', strtotime($req->emirates_expiry)),
                
                'labour_card_no'=> $req->labour_card_no,
                'labour_expiry'=> date('Y/m/d', strtotime($req->labour_expiry)),
    
                'personal_number'=> $req->personal_number,
                'profession_in_labour_card'=> $req->profession_in_labour_card,
                

                // salary info
                'basic_salary'=> $req->basic_salary,
                
                'allowances'=> $req->allowances,
                'allowances_amount'=> $req->allowances_amount,
                'responsibility_allowances'=> $req->responsibility_allowances,
                'responsibility_allowances_amount'=> $req->responsibility_allowances_amount,

                'new_salary'=> $req->new_salary,
                'increment'=> $req->increment,
                'year_of_increment'=> $req->year_of_increment,
                
                'total_salary'=> $req->total_salary,
                'bank'=> $req->bank,
                'iban'=> $req->iban,
    

                //medical entitlement
                'medical_entitlement'=> $medical_entitlement,
                'medical_category'=> $req->medical_category,
                'medical_life'=> $req->medical_life,
                'yearly'=> $req->yearly,
                'locally'=> $req->locally,
                'medical_card_no'=> $req->medical_card_no,
                'medical_expiry_date'=> date('Y/m/d', strtotime($req->medical_expiry_date)),
    
                'flight_entitlement'=> $flight_entitlement,
                'sector_entitlement'=> $sector_entitlement,
                'last_availed'=> $last_availed,
                'visa_entitlement'=> $visa_entitlement,
                
                //comment info
                'last_working_day'=> $req->last_working_day,
                'reason_for_resignation'=> $req->reason_for_resignation,
                'type_of_leaving'=> $req->type_of_leaving,
                'emergency_leave'=>$req->emergency_leave,
                'comment_on_leaving'=> $req->comment_on_leaving,

            ]);
        }

        $this->user->update($id, $data);   /* UPDATE USER RECORD */

        /* UPDATE STAFF RECORD */
        if($user_is_staff){
            $d2 = $req->only(Qs::getStaffRecord());
            $d2['code'] = $data['username'];
            $this->user->updateStaffRecord(['user_id' => $id], $d2);
        }

        return Qs::jsonUpdateOk();
    }

    public function show($user_id)
    {
        $user_id = Qs::decodeHash($user_id);
        if(!$user_id){return back();}

        $data['user'] = $this->user->find($user_id);        

        $details = DB::table('user_details')
                                ->where('created_by_user_code',$data['user']->code)
                                ->get();
        
        $data['details'] = $details[0];

        /* Prevent Other Students from viewing Profile of others*/
        if(Auth::user()->id != $user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild(Auth::user()->id, $user_id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('pages.support_team.users.show', $data);
    }

    public function destroy($id)
    {
        $id = Qs::decodeHash($id);

        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headSA($id)){
            return back()->with('pop_error', __('msg.denied'));
        }

        $user = $this->user->find($id);

        if($user->user_type == 'teacher' && $this->userTeachesSubject($user)) {
            return back()->with('pop_error', __('msg.del_teacher'));
        }

        $path = Qs::getUploadPath($user->user_type).$user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : true;
        $this->user->delete($user->id);
        DB::table('user_details')->where('created_by_user_code',$user->code)->delete();

        return back()->with('flash_success', __('msg.del_ok'));
    }

    protected function userTeachesSubject($user)
    {
        $subjects = $this->my_class->findSubjectByTeacher($user->id);
        return ($subjects->count() > 0) ? true : false;
    }

    public function getAllowances(Request $req)
    {
        $type = $req->input('type');
        $allowances = DB::table('allowances')->where('type',$type)->orderBy('start','asc')->get();
        return $allowances;
    }

    public function setAllowances(Request $req)
    {
        $year = $req->input('year');
        $year_arr = explode("/", $year);

        $id = DB::table('allowances')->insertGetId(['start'=>$year_arr[0], 'end'=>$year_arr[1], 'type'=>$req->input('type'), 'amount'=> $req->input('amount')]);
        return $id;
    }
    
    public function delAllowances(Request $req)
    {   
        $id = $req->input('id');
        $allowances = DB::table('allowances')->where('id',$id)->delete();
        return $allowances;
    }

    public function getResponsibilityAllowances(Request $req)
    {
        $type = $req->input('type');
        $allowances = DB::table('responsibility_allowances')->where('type',$type)->orderBy('start','asc')->get();
        return $allowances;
    }

    public function setResponsibilityAllowances(Request $req)
    {
        $year = $req->input('year');
        $year_arr = explode("/", $year);

        $id = DB::table('responsibility_allowances')->insertGetId(['start'=>$year_arr[0], 'end'=>$year_arr[1], 'type'=>$req->input('type'), 'amount'=> $req->input('amount')]);
        return $id;
    }
    
    public function delResponsibilityAllowances(Request $req)
    {   
        $id = $req->input('id');
        $allowances = DB::table('responsibility_allowances')->where('id',$id)->delete();
        return $allowances;
    }

}
