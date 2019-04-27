<?php 

namespace App\Laravel\Controllers\Frontend;

/*
*
* Models used for this controller
*/
use App\Laravel\Models\Waybill;


/*
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Frontend\ContactRequest;
use App\Laravel\Requests\Frontend\BookingInquiryRequest;

use App\Laravel\Events\SendEmail;


/*
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str, DB,Input,Event;

class MainController extends Controller{

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
		return $this->homepage();
	}

	public function homepage(){
		$this->data['page_title'] = " prioritize your time-sensitive shipments";
		return view('frontend.page.homepage',$this->data);
	}

	public function track(){
		$this->data['page_title'] = " Track Online";

		$waybill_id = Input::get('waybill_id');
		$this->data['waybill'] = Waybill::where('waybill_id',$waybill_id)->first();
		return view('frontend.page.track',$this->data);
	}

	public function faq(){
		$this->data['page_title'] = " FAQ - Shipping Guidelines";
		return view('frontend.page.faq',$this->data);
	}

	public function contact(){
		$this->data['page_title'] = " Contact Us";
		return view('frontend.page.contact',$this->data);
	}

	public function submit_inquiry(ContactRequest $request){
		Session::flash('notification-status','success');
		Session::flash('notification-msg',"Your inquiry was successfully sent. Please wait for our customer service to contact you.");

		$notification_data = new SendEmail(['input' => $request->all(),'type' => "inquiry"]);
		Event::fire('send-email', $notification_data);

		return redirect()->back();
	}

	public function booking(){
		$this->data['page_title'] = " Book now!";
		return view('frontend.page.booking',$this->data);
	}

	public function submit_booking (BookingInquiryRequest $request) {
		Session::flash('notification-status','success');
		Session::flash('notification-msg',"Your booking was successfully sent. Please wait for our customer service to contact you.");

		$notification_data = new SendEmail(['input' => $request->all(),'type' => "booking"]);
		Event::fire('send-email', $notification_data);

		return redirect()->route('frontend.booking');
	} 
}