## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).


## How to install

Follow this steps to make it work.

### Download composer to download the libraries used in this application

Download [composer](http://getcomposer.org) here. 
Then run this command. 'composer install' without the qoute.

Once done. Check the source code if 'vendor' folder exist.

### Create or Update .env file to configure the application setting

Check your root folder if .env file exist if not, copy the .env.example file and re-create an .env file
Update the following settings based on your server setting.

DATABASE NAME AND CREDENTIALS
BLOB STORAGE SETTING

Replace the FILE_STORAGE and IMAGE_STORAGE to 'azure' if you want to use the Azure Blob Storage service.