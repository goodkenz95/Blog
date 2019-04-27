<?php

$this->group([

	/**
	*
	* Backend routes main config
	*/
	'namespace' => "System", 
	'as' => "system.", 

], function(){

	$this->group(['middleware' => ["web","system.guest"]], function(){
		$this->get('register/{_token?}',['as' => "register",'uses' => "AuthController@register"]);
		$this->post('register/{_token?}',['uses' => "AuthController@store"]);
		$this->get('login/{redirect_uri?}',['as' => "login",'uses' => "AuthController@login"]);
		$this->post('login/{redirect_uri?}',['uses' => "AuthController@authenticate"]);
	});

	$this->group(['middleware' => ["web","system.auth","system.client_partner_not_allowed"]], function(){
		
		$this->get('lock',['as' => "lock", 'uses' => "AuthController@lock"]);
		$this->post('lock',['uses' => "AuthController@unlock"]);
		$this->get('logout',['as' => "logout",'uses' => "AuthController@destroy"]);

		$this->group(['as' => "account."],function(){
			$this->get('p/{username?}',['as' => "profile",'uses' => "AccountController@profile"]);
			$this->group(['prefix' => "setting"],function(){
				$this->get('info',['as' => "edit-info",'uses' => "AccountController@edit_info"]);
				$this->post('info',['uses' => "AccountController@update_info"]);
				$this->get('password',['as' => "edit-password",'uses' => "AccountController@edit_password"]);
				$this->post('password',['uses' => "AccountController@update_password"]);
			});
		});

		$this->group(['middleware' => ["system.update_profile_first"]], function() {
			$this->get('/',['as' => "dashboard",'uses' => "DashboardController@index"]);

			$this->group(['prefix' => "system-account", 'as' => "user."], function () {
				$this->get('/',['as' => "index", 'uses' => "UserController@index"]);
				$this->get('create',['as' => "create", 'uses' => "UserController@create"]);
				$this->post('create',['uses' => "UserController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "UserController@edit"]);
				$this->post('edit/{id?}',['uses' => "UserController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "UserController@destroy"]);
			});

			$this->group(['prefix' => "file-manager", 'as' => "file."], function () {
				$this->get('/',['as' => "index", 'uses' => "FileManagerController@index"]);
				$this->get('create',['as' => "create", 'uses' => "FileManagerController@create"]);
				$this->post('create',['uses' => "FileManagerController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "FileManagerController@edit"]);
				$this->post('edit/{id?}',['uses' => "FileManagerController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "FileManagerController@destroy"]);
			});

			
			$this->group(['prefix' => "page", 'as' => "page."], function () {
				$this->get('/',['as' => "index", 'uses' => "PageController@index"]);
				$this->get('create',['as' => "create", 'uses' => "PageController@create"]);
				$this->post('create',['uses' => "PageController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "PageController@edit"]);
				$this->post('edit/{id?}',['uses' => "PageController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "PageController@destroy"]);
			});

			$this->group(['prefix' => "category", 'as' => "category."], function () {
				$this->get('/',['as' => "index", 'uses' => "CategoryController@index"]);
				$this->get('create',['as' => "create", 'uses' => "CategoryController@create"]);
				$this->post('create',['uses' => "CategoryController@store"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "CategoryController@edit"]);
				$this->post('edit/{id?}',['uses' => "CategoryController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "CategoryController@destroy"]);
			});

			$this->group(['prefix' => "article", 'as' => "article."], function () {
				$this->get('/',['as' => "index", 'uses' => "ArticleController@index"]);
				$this->get('published',['as' => "published", 'uses' => "ArticleController@published"]);
				$this->get('pending',['as' => "pending", 'uses' => "ArticleController@pending"]);

				$this->get('create',['as' => "create", 'uses' => "ArticleController@create"]);
				$this->post('create',['uses' => "ArticleController@store"]);
				$this->get('fcm/{id?}',['as' => "force_notification", 'uses' => "ArticleController@force_notification"]);
				$this->get('edit/{id?}',['as' => "edit", 'uses' => "ArticleController@edit"]);
				$this->post('edit/{id?}',['uses' => "ArticleController@update"]);
				$this->any('delete/{id?}',['as' => "destroy", 'uses' => "ArticleController@destroy"]);
			});
		});
	});
});