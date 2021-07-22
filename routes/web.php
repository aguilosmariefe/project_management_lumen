<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('login', 'AuthController@login');

    $router->get('users', 'UserController@index');
    $router->get('users/summary', 'UserController@summary');
    $router->get('users/types/{role}','UserController@getByRole');
    $router->get('users/{id}/projects', 'UserController@projects');
    $router->post('users', 'UserController@store');
    $router->put('users/{id}', 'UserController@update');

    $router->get('projects', 'ProjectController@index');
    $router->get('projects/{id}', 'ProjectController@show');
    $router->get('projects/{id}/assignees', 'ProjectController@getAssignees');
    $router->post('projects', 'ProjectController@store');
    $router->put('projects/{id}', 'ProjectController@update');

    $router->get('projects/{projectId}/tasks', 'TaskController@index');
    $router->get('projects/tasks/{id}', 'TaskController@show');
    $router->post('projects/{projectId}/tasks', 'TaskController@store');
    $router->put('projects/tasks/{id}', 'TaskController@update');

    $router->put('create', ['uses' => 'ToDoController@create']);
    $router->get('todolist', ['uses' => 'ToDoController@todolist']);
});
