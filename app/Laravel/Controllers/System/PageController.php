<?php 

namespace App\Laravel\Controllers\System;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\Page;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\System\PageRequest;

/**
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str,ImageUploader;

class PageController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['statuses'] = [ "pending" => "Pending for Approval",'yes' => "Approve and Published","no" => "Disapprove"];
		$this->data['heading'] = "Pages";
	}

	public function index () {
		$this->data['page_title'] = " :: Pages - Record Data";
		$this->data['pages'] = Page::orderBy('updated_at',"DESC")->paginate(15);
		return view('system.page.index',$this->data);
	}

	public function create () {
		$this->data['page_title'] = " :: Pages - Add new record";
		return view('system.page.create',$this->data);
	}

	public function store (PageRequest $request) {
		try {
			$new_page = new Page;
			$user = $request->user();
        	$new_page->fill($request->only('title','content'));
			// $new_page->status = $request->get('status');
			$new_page->user_id = $request->user()->id;
			if($new_page->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"New record has been added.");
				return redirect()->route('system.page.index');
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
		$this->data['page_title'] = " :: Pages - Edit record";
		$page = Page::find($id);

		if (!$page) {
			session()->flash('notification-status',"failed");
			session()->flash('notification-msg',"Record not found.");
			return redirect()->route('system.page.index');
		}

		if($id < 0){
			session()->flash('notification-status',"warning");
			session()->flash('notification-msg',"Unable to update special record.");
			return redirect()->route('system.page.index');	
		}

		$this->data['page'] = $page;
		return view('system.page.edit',$this->data);
	}

	public function update (PageRequest $request, $id = NULL) {
		try {
			$page = Page::find($id);

			if (!$page) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.page.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to update special record.");
				return redirect()->route('system.page.index');	
			}
			$user = $request->user();
        	$page->fill($request->only('title','content'));

			if($page->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been modified successfully.");
				return redirect()->route('system.page.index');
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
			$page = Page::find($id);

			if (!$page) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.page.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to remove special record.");
				return redirect()->route('system.page.index');	
			}

			if($page->delete()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been deleted.");
				return redirect()->route('system.page.index');
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