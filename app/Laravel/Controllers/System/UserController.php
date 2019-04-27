<?php 

namespace App\Laravel\Controllers\System;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\User;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\System\UserRequest;

/**
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str;

class UserController extends Controller{

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
		$this->data['user_types'] = ['' => "Choose Account Type",/*'super_user' => "Master Admin",*/'admin' => "Administrator"/*,'customer_service' => "Customer Service"*/,'account_officer' => "Account Officer",'chief_editor' => "Chief Editor",'editor' => "Content Editor",'technical' => "Technical",'moderator' => "Moderator"];
		$this->data['heading'] = "System Account";
	}

	public function index () {
		$this->data['page_title'] = " :: System Account - Record Data";
		$this->data['users'] = User::where('id','<>','1')->types(['admin','moderator','editor','chief_editor','account_officer','technical'])->orderBy('created_at',"DESC")->paginate(15);
		return view('system.user.index',$this->data);
	}

	public function create () {
		$this->data['page_title'] = " :: System Account - Add new account";
		return view('system.user.create',$this->data);
	}

	public function store (UserRequest $request) {
		try {
			$new_user = new User;
			$new_user->fill($request->except('password'));
			$new_user->type = $request->get('type');
			$new_user->password = bcrypt($request->get('password'));
			if($new_user->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"New account has been added.");
				return redirect()->route('system.user.index');
			}
			session()->flash('notification-status','failed');
			session()->flash('notification-msg','Something went wrong.');

			return redirect()->back();
		} catch (Exception $e) {
			session()->flash('notification-status','failed');
			session()->flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

	public function edit ($id = NULL) {
		$this->data['page_title'] = " :: System Account - Edit record";
		$user = User::where('id','<>','1')->types(['admin','moderator','editor','chief_editor','account_officer','technical'])->where('id',$id)->first();

		if (!$user) {
			session()->flash('notification-status',"failed");
			session()->flash('notification-msg',"Record not found.");
			return redirect()->route('system.user.index');
		}

		$this->data['user'] = $user;
		return view('system.user.edit',$this->data);
	}

	public function update (UserRequest $request, $id = NULL) {
		try {
			$user = User::where('id','<>','1')->types(['admin','customer_service'])->where('id',$id)->first();

			if (!$user) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.user.index');
			}

			$user->fill($request->except('password'));
			$user->type = $request->get('type');
			if($request->has('password')){
				$user->password = bcrypt($request->get('password'));
			}


			if($user->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Account has been modified successfully.");
				return redirect()->route('system.user.index');
			}

			session()->flash('notification-status','failed');
			session()->flash('notification-msg','Something went wrong.');

		} catch (Exception $e) {
			session()->flash('notification-status','failed');
			session()->flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

	public function destroy ($id = NULL) {
		try {
			$user = User::where('id','<>','1')->types(['admin','customer_service'])->where('id',$id)->first();

			if (!$user) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.user.index');
			}

			if($user->delete()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been deleted.");
				return redirect()->route('system.user.index');
			}

			session()->flash('notification-status','failed');
			session()->flash('notification-msg','Something went wrong.');

		} catch (Exception $e) {
			session()->flash('notification-status','failed');
			session()->flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

}