<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $user;
    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }


    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }

    public function dashboard()
    {
        $d=[];
        if(Qs::userIsTeamSAT()){
            $d['users'] = $this->user->getAll();
        }

        return view('pages.support_team.dashboard', $d);
    }

    public function addEvents(Request $req){

        $start = $req->input('start');
        $end = $req->input('end');
        $title = $req->input('title');

        $id = DB::table('calendar_events')->insertGetId(array('start'=>$start,'end'=>$end,'title'=>$title));
        return $id;


    }

    public function getEvents(){

        $events = DB::table('calendar_events')->get();
        return $events;

    }

    public function delEvents(Request $req){

        $id = $req->input('id');

        $res = DB::table('calendar_events')->where('id',$id)->delete();
        return $res;


    }
}
