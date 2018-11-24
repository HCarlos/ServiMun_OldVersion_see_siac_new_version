<?php

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

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes(['verify' => true]);

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');
//$this->post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
/*
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');


    // USUARIOS
    Route::get('edit', 'Catalogos\User\UserDataController@showEditUserData')->name('edit');
    Route::put('Edit', 'Catalogos\User\UserDataController@update')->name('Edit');
    Route::get('showEditProfilePhoto/', 'Catalogos\User\UserDataController@showEditProfilePhoto')->name('showEditProfilePhoto/');
    Route::get('editUser/{Id}', 'Catalogos\User\UserDataController@showEditUser')->name('editUser');
    Route::put('EditUser', 'Catalogos\User\UserDataController@updateUser')->name('EditUser');
    Route::get('newUser', 'Catalogos\User\UserDataController@newUser')->name('newUser');
    Route::post('createUser', 'Catalogos\User\UserDataController@createUser')->name('createUser');
    Route::get('removeUser/{id}', 'Catalogos\User\UserDataController@removeUser')->name('removeUser');
    Route::get('showEditProfilePassword/', 'Catalogos\User\UserDataController@showEditProfilePassword')->name('showEditProfilePassword/');
    Route::put('changePasswordUser/', 'Catalogos\User\UserDataController@changePasswordUser')->name('changePasswordUser/');
    Route::post('subirFotoProfile/', 'Storage\StorageProfileController@subirArchivoProfile')->name('subirArchivoProfile/');
    Route::get('quitarFotoProfile/', 'Storage\StorageProfileController@quitarArchivoProfile')->name('quitarArchivoProfile/');
    Route::get('list-users/', 'Catalogos\User\UserDataController@showListUser')->name('listUsers');

    // Catálogo de Categorías
    Route::get('listCategorias/', 'Catalogos\User\CategoriaController@index')->name('listCategorias');
    Route::get('editCategoria/{Id}', 'Catalogos\User\CategoriaController@editCategoria')->name('editCategoria');
    Route::put('updateCategoria', 'Catalogos\User\CategoriaController@updateCategoria')->name('updateCategoria');
    Route::get('newCategoria', 'Catalogos\User\CategoriaController@newCategoria')->name('newCategoria');
    Route::post('createCategoria', 'Catalogos\User\CategoriaController@createCategoria')->name('createCategoria');
    Route::get('removeCategoria/{id}', 'Catalogos\User\CategoriaController@removeCategoria')->name('removeCategoria');

    // Catálogo de Dependencias
    Route::get('listDependencias/', 'Catalogos\Dependencia\DependenciaController@index')->name('listDependencias');
    Route::get('editDependencia/{Id}', 'Catalogos\Dependencia\DependenciaController@editDependencia')->name('editDependencia');
    Route::put('updateDependencia', 'Catalogos\Dependencia\DependenciaController@updateDependencia')->name('updateDependencia');
    Route::get('newDependencia', 'Catalogos\Dependencia\DependenciaController@newDependencia')->name('newDependencia');
    Route::post('createDependencia', 'Catalogos\Dependencia\DependenciaController@createDependencia')->name('createDependencia');
    Route::get('removeDependencia/{id}', 'Catalogos\Dependencia\DependenciaController@removeDependencia')->name('removeDependencia');


    // ROLES
    Route::get('asignaRole/{Id}','Catalogos\User\RoleController@index')->name('asignaRole');
    Route::get('assignRoleToUser/{Id}/{nameRoles}','Catalogos\User\RoleController@asignar')->name('assignRoleToUser');
    Route::get('unAssignRoleToUser/{Id}/{nameRoles}','Catalogos\User\RoleController@desasignar')->name('unAssignRoleToUser');
    // PERMISSIONS
    Route::get('asignaPermission/{Id}','Catalogos\User\PermissionController@index')->name('asignaPermission');
    Route::get('assignPermissionToUser/{Id}/{namePermissions}','Catalogos\User\PermissionController@asignar')->name('assignPermissionToUser');
    Route::get('unAssignPermissionToUser/{Id}/{namePermissions}','Catalogos\User\PermissionController@desasignar')->name('unAssignPermissionToUser');

    // EXTERNAL FILES
    Route::get('archivosConfig','Storage\StorageExternalFilesController@archivos_config')->name('archivosConfig');
    Route::post('subirArchivoBase/', 'Storage\StorageExternalFilesController@subirArchivoBase')->name('subirArchivoBase/');
    Route::get('quitarArchivoBase/{driver}/{archivo}', 'Storage\StorageExternalFilesController@quitarArchivoBase')->name('quitarArchivoBase/');
//
    Route::post('showFileListUserExcel1A','External\User\ListUserXLSXController@getListUserXLSX')->name('showFileListUserExcel1A');
//    Route::post('showFileListNivelExcel','External\Nivel\ListNivelXLSXController@getListNivelXLSX')->name('showFileListNivelExcel');
//    Route::post('showFileListParentescoExcel','External\Parentesco\ListParentescoXLSXController@getListParentescoXLSX')->name('showFileListParentescoExcel');
//    Route::post('showFileListFamiliaExcel','External\Familia\ListFamiliaXLSXController@getListFamiliaXLSX')->name('showFileListFamiliaExcel');
//    Route::post('showFileListRegFisExcel','External\Registros_Fiscales\ListaRegFisXLSXController@getListRegFisXLSX')->name('showFileListRegFisExcel');
    Route::post('getUserByRoleToXLSX','External\User\ListUserXLSXController@getUserByRoleToXLSX')->name('getUserByRoleToXLSX');

    // END FILES EXTERNAL



});

Route::get('enviar', ['as' => 'enviar', function () {
    $data = ['link' => 'http://atemun.mx'];
    Mail::send('emails.notificacion', $data, function ($message) {
        $message->from('manager@logydes.com.mx', 'Logydes.com.mx');
        $message->to('logydes@gmail.com')->subject('Notificación');
    });
    return "Se envío el email";
}]);

