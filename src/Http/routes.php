<?php

/** Notifications Routes **/
Route::group(['middleware' => 'auth', 'namespace' => 'Hechoenlaravel\JarvisFoundation\Http\Controllers'], function () {
    Route::get('notifications', ['as' => 'notifications.index', 'uses' => 'NotificationsController@index']);
    Route::get('notifications/{id}/read', ['as' => 'notifications.read', 'uses' => 'NotificationsController@read']);
    Route::group(['prefix' => 'api'], function(){
        Route::group(['prefix' => 'core'], function(){
            Route::resource('entity/{id}/fields', 'Core\FieldsController', ['only' => ['index', 'store', 'update', 'destroy']]);
            Route::put('entity/{id}/order-fields', 'Core\FieldsController@reOrderFieldId');
            Route::get('field-type/{type}/form', 'Core\FieldsController@fieldTypeForm');
            /** Flows and steps resources **/
            Route::resource('/flows', 'Core\FlowController');
            Route::resource('/steps', 'Core\StepController');
            Route::resource('/transitions', 'Core\TransitionController');
        });
    });
});
