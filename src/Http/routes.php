<?php

/** Some Core Routes for API calls **/
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['prefix' => 'core', 'namespace' => 'Hechoenlaravel\JarvisFoundation\Http\Controllers'], function($api) {
        $api->resource('entity/{id}/fields', 'Core\FieldsController', ['only' => ['index', 'store', 'update', 'destroy']]);
    });
});