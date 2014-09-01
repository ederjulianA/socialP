<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function PostSession()
	{
		if(isset($_POST['miDato']))
		{
			Session::put('dato', $_POST['miDato']);
			return Redirect::to('/');
		}
	}

	public function quitarSession()
	{
		if(isset($_POST['miDato']))
		{
			Session::forget('dato');
			return Redirect::to('/');
		}
	}

	public function ajax()

	{
		header('Content-type: text/javascript');
		$users = array('nombre'=>'eder', 'apellido'=>'alvarez');
		$estados = array('estado1' => 'aprobado','estado2'=>'no aprobado');

		return Response::json(array('users'=>$users,'estados'=>$estados));
	}

}
