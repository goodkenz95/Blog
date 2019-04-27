<?php 

namespace App\Laravel\Controllers\Generic;

/*
*
* Models used for this controller
*/
use App\Laravel\Models\Page;


/*
*
* Requests used for validating inputs
*/


/*
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str, DB,Input,Event;

class PageController extends Controller{

	/*
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
	}

	public function privacy_policy(){
		$page = Page::find(1);
		if(!$page){
			$this->data['page_title'] = "Page Not Found";
			return view('generic.not_found',$this->data);
		}
		$this->data['page_title'] = $page->title;
		$this->data['page'] = $page;
		return view('generic.page',$this->data);
	}

	public function disclaimer(){
		$page = Page::find(2);
		if(!$page){
			$this->data['page_title'] = "Page Not Found";
			return view('generic.not_found',$this->data);
		}
		$this->data['page_title'] = $page->title;
		$this->data['page'] = $page;
		return view('generic.page',$this->data);
	}

	public function terms(){
		$page = Page::find(3);
		if(!$page){
			$this->data['page_title'] = "Page Not Found";
			return view('generic.not_found',$this->data);
		}
		$this->data['page_title'] = $page->title;
		$this->data['page'] = $page;
		return view('generic.page',$this->data);
	}

	public function about_yes(){
		$page = Page::find(4);
		if(!$page){
			$this->data['page_title'] = "Page Not Found";
			return view('generic.not_found',$this->data);
		}
		$this->data['page_title'] = $page->title;
		$this->data['page'] = $page;
		return view('generic.page',$this->data);
	}

}