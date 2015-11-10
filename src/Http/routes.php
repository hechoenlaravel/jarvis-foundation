<?php

/** Notifications Routes **/
Route::group(['middleware' => 'auth', 'prefix' => 'notifications', 'namespace' => 'Hechoenlaravel\JarvisFoundation\Http\Controllers'], function(){
    Route::get('/', ['as' => 'notifications', 'uses' => 'NotificationsController@index']);
    Route::get('{id}/read', ['as' => 'notifications.read', 'uses' => 'NotificationsController@read']);
});

/** Some Core Routes for API calls **/
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['middleware' => ['api.auth'], 'providers' => ['inSession']], function($api) {
        $api->group(['prefix' => 'core', 'namespace' => 'Hechoenlaravel\JarvisFoundation\Http\Controllers'], function($api) {
            $api->resource('entity/{id}/fields', 'Core\FieldsController', ['only' => ['index', 'store', 'update', 'destroy']]);
            $api->put('entity/{id}/order-fields', 'Core\FieldsController@reOrderFieldId');
            $api->get('field-type/{type}/form', 'Core\FieldsController@fieldTypeForm');
            /** Flows and steps resources **/
            $api->resource('/flows', 'Core\FlowController');
            $api->resource('/steps', 'Core\StepController');
            $api->resource('/transitions', 'Core\TransitionController');
        });
    });
});