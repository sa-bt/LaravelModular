<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Sabt\Course\Models\Course;
use Sabt\Course\Models\Lesson;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/', function ()
//{
//    return view('index');
//});


Route::get('/test', function ()
{
    $query = http_build_query([
        'client_id' => 4,
        'redirect_uri' => 'http://127.0.0.1:8001/callback',
        'response_type' => 'code',
        'scope' => ['edit-task']
    ]);

    return redirect('http://127.0.0.1:8000/oauth/authorize?' . $query);
});

Route::get('/callback', function (Request $request) {
    $response = (new GuzzleHttp\Client)->post('http://127.0.0.1:8000/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 4,
            'client_secret' => 'fms6y9dvUIIclIQiicufaKFdu8suCgT4oSJ6NFg8',
            'redirect_uri' => 'http://127.0.0.1:8001/callback',
            'code' => $request->code,
        ]
    ]);

    session()->put('token', json_decode((string)$response->getBody(), true));

    return redirect('/todos');
});

Route::get('/todos', function () {
    if (!session()->has('token')) {
        return redirect('/ahmad');
    }

    $response = (new GuzzleHttp\Client)->get('http://127.0.0.1:8000/api/todos', [
        'headers' => [
            'Authorization' => 'Bearer ' . Session::get('token.access_token')
        ]
    ]);

    return json_decode((string)$response->getBody(), true);
});
Route::get('/ahmad',function (){
    return 'Salam';
});
