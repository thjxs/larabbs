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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'serializer:array',
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
        $api->post('verificationCodes', 'VerificationCodesController@store')->name('api.verificationCodes.store');
        $api->post('users', 'UsersController@store')->name('api.users.store');
        $api->post('captchas', 'CaptchasController@store')->name('api.captchas.store');
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')->name('api.socials.authorizations.store');
        $api->post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
        $api->put('authorizations/current', 'AuthorizationsController@update')->name('api.authorizations.update');
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')->name('api.authorizations.destroy');
        $api->get('categories', 'CategoriesController@index')->name('api.categories.index');
        $api->group(['middleware' => 'api.auth'], function($api) {
            $api->get('user', 'UsersController@me')->name('api.user.show');
            $api->post('images', 'ImagesController@store')->name('api.images.store');
            $api->patch('user', 'UsersController@update')->name('api.user.update');
        });
    });
});