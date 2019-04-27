<?php 

namespace App\Laravel\Controllers\System;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\ArticleCategory as Category;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\System\CategoryRequest;

/**
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str;

class CategoryController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['statuses'] = [ 'active' => "Active","inactive" => "Inactive"];
		$this->data['heading'] = "Article Categories";
	}

	public function index () {
		$this->data['page_title'] = " :: Article Categories - Record Data";
		$this->data['categories'] = Category::orderBy('updated_at',"DESC")->paginate(15);
		return view('system.category.index',$this->data);
	}

	public function create () {
		$this->data['page_title'] = " :: Article Categories - Add new record";
		return view('system.category.create',$this->data);
	}

	public function store (CategoryRequest $request) {
		try {
			$new_category = new Category;
			$new_category->fill($request->only('name'));
			$new_category->status = $request->get('status');
			$new_category->user_id = $request->user()->id;
			if($new_category->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"New record has been added.");
				return redirect()->route('system.category.index');
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
		$this->data['page_title'] = " :: Article Categories - Edit record";
		$category = Category::find($id);

		if (!$category) {
			session()->flash('notification-status',"failed");
			session()->flash('notification-msg',"Record not found.");
			return redirect()->route('system.category.index');
		}

		if($id < 0){
			session()->flash('notification-status',"warning");
			session()->flash('notification-msg',"Unable to update special record.");
			return redirect()->route('system.category.index');	
		}

		$this->data['category'] = $category;
		return view('system.category.edit',$this->data);
	}

	public function update (CategoryRequest $request, $id = NULL) {
		try {
			$category = Category::find($id);

			if (!$category) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.category.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to update special record.");
				return redirect()->route('system.category.index');	
			}

			$category->fill($request->only('name'));
			$category->status = $request->get('status');
			$category->user_id = $request->user()->id;
			

			if($category->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been modified successfully.");
				return redirect()->route('system.category.index');
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
			$category = Category::find($id);

			if (!$category) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.category.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to remove special record.");
				return redirect()->route('system.category.index');	
			}

			if($category->delete()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been deleted.");
				return redirect()->route('system.category.index');
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