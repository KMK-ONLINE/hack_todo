<?hh

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',             ['as' => 'tasks.index',   'uses' => 'TasksController@index']);
Route::post('/task',        ['as' => 'tasks.store',   'uses' => 'TasksController@store']);
Route::put('/task/{id}',    ['as' => 'tasks.update',  'uses' => 'TasksController@update']);
Route::delete('/task/{id}', ['as' => 'tasks.destroy', 'uses' => 'TasksController@destroy']);
