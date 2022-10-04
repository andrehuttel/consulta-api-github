<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\GithubServiceProvider as Github;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($author = 'andrehuttel')
    {

        $users = User::count();
        $response_user = $this->get_author($author);
        $response = $this->get_repo($author);


        $widget = [
            'users' => $users,
            //...
        ];


        return view('home', compact('widget', 'response_user', 'response'));
    }

    public function get_author($author){
        $author = $author ?: 'andrehuttel';
        $ch = curl_init();
        $url = 'https://api.github.com/users/'.$author;
        $authHeader = "content-Type: application/json', '-H Accept: application/vnd.github+json', Authorization: Bearer " .env('TOKEN_GITHUB');
        $userAgentHeader = "User-Agent: '".$author."'";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader, $userAgentHeader));

        curl_close($ch);
        return json_decode(curl_exec($ch));
    }

    public function get_repo($author){
        $author = $author ?: 'andrehuttel';
        $ch = curl_init();
        $url = 'https://api.github.com/users/'.$author.'/repos';
        $authHeader = "content-Type: application/json', '-H Accept: application/vnd.github+json', Authorization: Bearer " .env('TOKEN_GITHUB');
        $userAgentHeader = "User-Agent: '".$author."'";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader, $userAgentHeader));

        curl_close($ch);
        return json_decode(curl_exec($ch)); 
    }
}
