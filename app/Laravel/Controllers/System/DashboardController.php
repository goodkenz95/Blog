<?php 

namespace App\Laravel\Controllers\System;

/*
*
* Models used for this controller
*/
use App\Laravel\Models\User;
use App\Laravel\Models\Article;

/*
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str, DB;

class DashboardController extends Controller{

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

	public function index(){
		return redirect()->route('system.article.index');
	}
}