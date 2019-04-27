<?php 

namespace App\Laravel\Controllers\System;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\FileManager;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\System\FileManagerRequest;

/**
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str,ImageUploader,FileUploader;

class FileManagerController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['file_types'] = [ '' => "Choose File type", 'file' => "File", 'image' => "Image"];
		$this->data['heading'] = "File Manager";
	}

	public function index () {
		$this->data['page_title'] = " :: File Manager - Record Data";
		$this->data['files'] = FileManager::orderBy('updated_at',"DESC")->paginate(15);
		return view('system.file.index',$this->data);
	}

	public function create () {
		$this->data['page_title'] = " :: File Manager - Add new record";
		return view('system.file.create',$this->data);
	}

	public function store (FileManagerRequest $request) {
		try {
			$new_file = new FileManager;
			$new_file->fill($request->only('type','custom_filename'));

			if($request->hasFile('file')) {
			    $image = $new_file->type == "image" ? ImageUploader::upload($request->file('file'), "uploads/file") : FileUploader::upload($request->file('file'), "uploads/file");
			    $new_file->path = $image['path'];
			    $new_file->directory = $image['directory'];
			    $new_file->filename = $image['filename'];
            	$new_file->source = $image['source'];

			}
			if($new_file->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"New record has been added.");
				return redirect()->route('system.file.index');
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
		$this->data['page_title'] = " :: File Manager - Edit record";
		$file = FileManager::find($id);

		if (!$file) {
			session()->flash('notification-status',"failed");
			session()->flash('notification-msg',"Record not found.");
			return redirect()->route('system.file.index');
		}

		if($id < 0){
			session()->flash('notification-status',"warning");
			session()->flash('notification-msg',"Unable to update special record.");
			return redirect()->route('system.file.index');	
		}

		$this->data['file'] = $file;
		return view('system.file.edit',$this->data);
	}

	public function update (FileManagerRequest $request, $id = NULL) {
		try {
			$file = FileManager::find($id);

			if (!$file) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.file.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to update special record.");
				return redirect()->route('system.file.index');	
			}

			$file->fill($request->only('type','custom_filename'));

			if($request->hasFile('file')) {
			    $image = $file->type == "image" ? ImageUploader::upload($request->file('file'), "uploads/file") : FileUploader::upload($request->file('file'), "uploads/file");
			    $file->path = $image['path'];
			    $file->directory = $image['directory'];
			    $file->filename = $image['filename'];
            	$file->source = $image['source'];

			}

			if($file->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been modified successfully.");
				return redirect()->route('system.file.index');
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
			$file = FileManager::find($id);

			if (!$file) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.file.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to remove special record.");
				return redirect()->route('system.file.index');	
			}

			if($file->delete()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been deleted.");
				return redirect()->route('system.file.index');
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