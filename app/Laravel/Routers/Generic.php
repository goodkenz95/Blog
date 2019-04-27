<?php

$this->group([

	/**
	*
	* Generic routes main config
	*/
	'namespace' => "Generic", 
	'as' => "generic.", 

	], function(){
		$this->get('google3571593336c8d03e.html',function(){
			echo "google-site-verification: google3571593336c8d03e.html";
		});

		$this->get('privacy-policy',['as' => "privacy_policy",'uses' => "PageController@privacy_policy"]);
		$this->get('disclaimer',['as' => "disclaimer",'uses' => "PageController@disclaimer"]);
		$this->get('about-yes',['as' => "about_yes",'uses' => "PageController@about_yes"]);

		$this->get('terms-and-condition',['as' => "terms",'uses' => "PageController@terms"]);

		$this->get('reset-password/{token?}',['as' => "reset_password",'uses' => "ResetPasswordController@index" ]);
		$this->post('reset-password/{token?}',['uses' => "ResetPasswordController@submit" ]);

		$this->get('verify/{token?}',['as' => "verify",'uses' => "VerifyAccountController@verify_email" ]);

});