<?php 

namespace App\Laravel\Controllers\System;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\User;
use App\Laravel\Models\Attendance;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\System\AccountInfoRequest;
use App\Laravel\Requests\System\AccountPasswordRequest;


/**
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str,Auth;

class AccountController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['types'] = ['' => "Choose Event Type", 'regular' => "Regular Working Day", 'regular_holiday' => "Regular Holiday", 'special_holiday' => "Special Non-working Day",'birthday' => "Birthday Celebration",'team_building' => "Team Building/Planning"];
		$this->data['heading'] = "My Account";
	}

	public function profile($username = NULL) {
		$this->data['page_title'] = " :: My Account";
		$this->data['user'] = User::where('username',$username)->first();

		if(!$this->data['user']){
			session()->flash('notification-status',"failed");
			session()->flash('notification-msg',"Unauthorized access.");
			return redirect()->route('system.dashboard');
		}

		return view('system.account.profile',$this->data);
	}

	public function edit_info(){
		$this->data['page_title'] = " :: Settings - Update Profile";
		return view('system.account.edit-info',$this->data);
	}

	public function update_info(AccountInfoRequest $request){
		$user = $this->data['auth'];
		$user->fill($request->except('password','type','username','id'));
		$user->username = Str::lower($request->get('username'));
		$user->save();

		$this->data['auth'] = $user;

		return redirect()->route('system.account.profile',[$user->username]);
	}

	public function edit_password(){
		$this->data['page_title'] = " :: Settings - Update Password";
		return view('system.account.edit-password',$this->data);
	}

	public function update_password(AccountPasswordRequest $request){
		$user = $this->data['auth'];
		$user->password = bcrypt($request->get('password'));
		$user->save();

		$this->data['auth'] = $user;
		return redirect()->route('system.account.profile',[$user->username]);
	}
}