<?php

Route::post('/post-session', array(
        'as' => 'session1',
        'uses' => 'HomeController@PostSession'
    ));

Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});

Route::post('/estados', array(
        'as' => 'estados',
        'uses' => 'HomeController@ajax'
    ));

Route::post('/estados-quitar', array(
        'as' => 'session-quitar',
        'uses' => 'HomeController@quitarSession'
    ));

Route::get('/api/v1/users', array(
        'as' => 'apiUsers',
        'uses' => 'UsersController@index'
    ));




Route::get('login/fb/callback', function() {
    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();

    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

    $me = $facebook->api('/me');

    $profile = Profile::whereUid($uid)->first();
     if (empty($profile)) {

    	$user = new User;
    	$user->name = $me['first_name'].' '.$me['last_name'];
    	$user->email = $me['email'];
    	$user->photo = 'https://graph.facebook.com/'.$me['id'].'/picture?type=large';
    	//$user->bday = $me['bio'];
    	//$user->relationship = $me['relationship_status'];

        $user->save();

        $profile = new Profile();
        $profile->uid = $uid;
    	$profile->username = $me['name'];
    	$profile = $user->profiles()->save($profile);
    }

    $profile->access_token = $facebook->getAccessToken();
    $profile->save();

    $user = $profile->user;

    Auth::login($user);

    return Redirect::to('/')->with('message', 'Logged in with Facebook');
});

Route::get('/', function()
{
    $data = array();

    if (Auth::check()) {
        $data = Auth::user();
    }
    return View::make('user', array('data'=>$data));
});

Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('/');
});

Route::get('mysitemap', function(){

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // add items to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to('/'), '2014-07-25T20:10:00+02:00', '1.0', 'daily');
    //$sitemap->add(URL::to('page'), '2014-07-26T12:30:00+02:00', '0.9', 'monthly');

    // get all posts from db
   // $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();

    // add every post to the sitemap
    /*foreach ($posts as $post)
    {
        $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
    }*/

    // generate your sitemap (format, filename)
    $sitemap->store('xml', 'sitemap');
    // this will generate file mysitemap.xml to your public folder

});