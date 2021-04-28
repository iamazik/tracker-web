<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// http -h POST http://tracker.test/api/auth email=example@gmail.com password=password
Route::middleware('api')->post('/auth', function (Request $request) {
	if (\App\User::where('email', $request->email)->exists()) {
		$user = \App\User::where('email', $request->email)->first();

		if (Hash::check($request->password, $user->password)) {
			return response()->json([
				'user' => $user,
				'profile' => \App\Http\Controllers\ImageController::getProfilePicture('profile.jpg')
			]);
		}

		return response()->json(['field' => 'password'], 401);
	}

	return response()->json(['field' => 'email'], 401);
});


Route::middleware('api')->post('/store', function (Request $request)
{
	return $request->all();
});

// Store offline stored data
Route::middleware('api')->post('/offline', function (Request $request)
{
	return $request->all();
});


Route::middleware('api')->post('/projects', function (Request $request)
{
	if (count(\App\Project::all())) {
		return \App\Project::all();
	}

	return response()->json(['status' => 204], 204);
});
