<?php 

namespace App\Laravel\Controllers\System;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\ArticleCategory as Category;
use App\Laravel\Models\Article;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\System\ArticleRequest;

/**
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str,ImageUploader;

class ArticleController extends Controller{

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
		$this->data['categories'] = ['--Choose Category--'] + Category::pluck('name','id')->toArray();
		$this->data['heading'] = "Article";
	}

	public function index () {
		$this->data['page_title'] = " :: Article - Record Data";
		$this->data['articles'] = Article::orderBy('updated_at',"DESC")->paginate(15);
		return view('system.article.index',$this->data);
	}

	public function pending () {
		$this->data['page_title'] = " :: Article - Pending for Approval";
		$this->data['articles'] = Article::where('is_approved','pending')->orderBy('updated_at',"DESC")->paginate(15);
		return view('system.article.index',$this->data);
	}

	public function published () {
		$this->data['page_title'] = " :: Article - Published Data";
		$this->data['articles'] = Article::where('is_approved','yes')->orderBy('updated_at',"DESC")->paginate(15);
		return view('system.article.index',$this->data);
	}

	public function create () {
		$this->data['page_title'] = " :: Article - Add new record";
		return view('system.article.create',$this->data);
	}

	public function store (ArticleRequest $request) {
		try {
			$new_article = new Article;
			$user = $request->user();
        	$new_article->fill($request->only('title','video_url','content','category_id'));
			if($request->hasFile('file')) {
			    $image = ImageUploader::upload($request->file('file'), "uploads/images/users/{$user->id}/articles");
			    $new_article->path = $image['path'];
			    $new_article->directory = $image['directory'];
			    $new_article->filename = $image['filename'];
            	$new_article->source = $image['source'];

			}
			// $new_article->status = $request->get('status');
			$new_article->user_id = $request->user()->id;
			if($new_article->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"New record has been added.");
				return redirect()->route('system.article.pending');
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
		$this->data['page_title'] = " :: Article - Edit record";
		$article = Article::find($id);

		if (!$article) {
			session()->flash('notification-status',"failed");
			session()->flash('notification-msg',"Record not found.");
			return redirect()->route('system.article.index');
		}

		if($id < 0){
			session()->flash('notification-status',"warning");
			session()->flash('notification-msg',"Unable to update special record.");
			return redirect()->route('system.article.index');	
		}

		$this->data['article'] = $article;
		return view('system.article.edit',$this->data);
	}

	public function update (ArticleRequest $request, $id = NULL) {
		try {
			$article = Article::find($id);

			if (!$article) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.article.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to update special record.");
				return redirect()->route('system.article.index');	
			}
			$user = $request->user();
        	$article->fill($request->only('title','video_url','content','category_id'));
        	if($request->hasFile('file')) {
        	    $image = ImageUploader::upload($request->file('file'), "uploads/images/users/{$user->id}/articles");
        	    $article->path = $image['path'];
        	    $article->directory = $image['directory'];
        	    $article->filename = $image['filename'];
            	$article->source = $image['source'];
        	}

        	switch(Str::lower($request->get('is_approved'))){
        		case 'yes':
        			$article->is_approved = "yes";
        			$article->status = "published";
        		break;

        		case 'pending':
        			$article->is_approved = "pending";
        			$article->status = "draft";

        		break;

        		default:
        			$article->is_approved = "no";
        			$article->status = "declined";
        	}

			if($article->save()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been modified successfully.");
				return redirect()->route('system.article.index');
			}

			session()->flash('notification-status','failed');
			session()->flash('notification-msg','Something went wrong.');

		} catch (Exception $e) {
			session()->flash('notification-status','failed');
			session()->flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

	public function force_notification($id = NULL){
		$article = Article::find($id);

		if (!$article) {
			session()->flash('notification-status',"failed");
			session()->flash('notification-msg',"Record not found.");
			return redirect()->route('system.article.index');
		}

		$owner = $article->author;

		session()->flash('notification-status','success');
		session()->flash('notification-msg',"Force Push notification successfully sent.");
		return redirect()->route('system.article.index');
	}

	public function destroy ($id = NULL) {
		try {
			$article = Article::find($id);

			if (!$article) {
				session()->flash('notification-status',"failed");
				session()->flash('notification-msg',"Record not found.");
				return redirect()->route('system.article.index');
			}

			if($id < 0){
				session()->flash('notification-status',"warning");
				session()->flash('notification-msg',"Unable to remove special record.");
				return redirect()->route('system.article.index');	
			}

			if($article->delete()) {
				session()->flash('notification-status','success');
				session()->flash('notification-msg',"Record has been deleted.");
				return redirect()->route('system.article.index');
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