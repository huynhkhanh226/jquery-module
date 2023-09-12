<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	if(Request::path()=='/') Session::set('modlogin',0);
	if (Config::get('app.appSecure',false)==true){
        if(!Request::secure())
        {
            return Redirect::secure(Request::path());
        }
    }
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	//Kiem tra neu chua thiet lap database
	if (\Config::get('database.connections.sqlsrv.database') == ""){
		return Redirect::guest('/adminlogin');
	}
    //echo "Go rout";
	if(Session::get('modlogin')==0) {
		//echo "Go mode 0";
		if (!Auth::user()->check() || !Session::has("W91P0000"))
		{
			if (Request::ajax())
			{
				return Response::make('Unauthorized', 401);
			}
			else
			{
				return Redirect::guest('login');
			}
		}
	}
	else {
		//echo "Go mode 1";
		if (!Auth::ess()->check()  || !Session::has("W91P0000"))
		{
			if (Request::ajax() )
			{
				return Response::make('Unauthorized', 401);
			}
			else
			{
				return Redirect::guest('esslogin');
			}
		}

	}

});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::user()->check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
App::setlocale(Session::get("locate"));