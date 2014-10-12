<?php

/*******************
 * Models bindings *
 *******************/
Route::model('application', 'Application');
Route::bind('application', function($value, $route){
    return Application::where('slug', $value)->first();
});

Route::model('news', 'News');
Route::model('news_categories', 'NewsCategory');
Route::model('questions', 'Question');
Route::bind('questions', function($value, $route){
    return Question::with('answers')->find($value);
});

Route::model('app', 'Application');
Route::bind('app', function($value, $route){
	return Application::where('api_key', $value)->first();
});


/**************
 * API ROUTES *
 **************/
Route::group(['prefix'=>'api/', 'before'=>'secure'], function()
{
	//News 
	Route::get('app/{app}/news', ['as' => 'api.news', 'uses' => 'ApiNewsController@index']);
	Route::get('app/{app}/news/{news}/show', ['as' => 'api.news.show', 'uses' => 'ApiNewsController@show']);
	Route::get('app/{app}/news/category/{news_categories}', ['as' => 'api.news.category', 'uses' => 'ApiNewsController@category']);
	//News Categories
	Route::get('app/{app}/news-categories', ['as' => 'api.news_category', 'uses' => 'ApiNewsCategoryController@index']);
	Route::get('app/{app}/news-categories/{news_categories}/show', ['as' => 'api.news_category.show', 'uses' => 'ApiNewsCategoryController@show']);
	//Questions 
	Route::get('app/{app}/questions', ['as' => 'api.questions', 'uses' => 'ApiQuestionController@index']);
	Route::get('app/{app}/questions/{questions}/show', ['as' => 'api.questions.show', 'uses' => 'ApiQuestionController@show']);
	
	//Route::resource('app', 'ApiController');
});


/**********************
 * APPLICATION ROUTES *
 **********************/
Route::group(['before'=>'auth'], function()
{
	Route::group(['prefix' => 'application/{application}'], function()
	{
		Route::resource('news', 'NewsController');
		Route::resource('news-categories', 'NewsCategoryController');
		Route::resource('questions', 'QuestionsController');
	});

    //Application routing
	Route::resource('application', 'ApplicationController');
	//Developer routing
	Route::get('developer/console', 'DeveloperController@console');
	Route::post('developer/response', 'DeveloperController@response');
	//homepage routing
	Route::get('/', ['as' => 'home', 'uses' => 'ApplicationController@index']);
});

//Authentication 
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);