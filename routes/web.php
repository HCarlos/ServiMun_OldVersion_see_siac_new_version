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

    // Catálogo de Areas
    Route::get('listAreas/', 'Catalogos\Dependencia\AreaController@index')->name('listAreas');
    Route::get('editArea/{Id}', 'Catalogos\Dependencia\AreaController@editArea')->name('editArea');
    Route::put('updateArea', 'Catalogos\Dependencia\AreaController@updateArea')->name('updateArea');
    Route::get('newArea', 'Catalogos\Dependencia\AreaController@newArea')->name('newArea');
    Route::post('createArea', 'Catalogos\Dependencia\AreaController@createArea')->name('createArea');
    Route::get('removeArea/{id}', 'Catalogos\Dependencia\AreaController@removeArea')->name('removeArea');

    // Catálogo de Subareas
    Route::get('listSubareas/', 'Catalogos\Dependencia\SubareaController@index')->name('listSubareas');
    Route::get('editSubarea/{Id}', 'Catalogos\Dependencia\SubareaController@editSubarea')->name('editSubarea');
    Route::put('updateSubarea', 'Catalogos\Dependencia\SubareaController@updateSubarea')->name('updateSubarea');
    Route::get('newSubarea', 'Catalogos\Dependencia\SubareaController@newSubarea')->name('newSubarea');
    Route::post('createSubarea', 'Catalogos\Dependencia\SubareaController@createSubarea')->name('createSubarea');
    Route::get('removeSubarea/{id}', 'Catalogos\Dependencia\SubareaController@removeSubarea')->name('removeSubarea');

    // Catálogo de Estatus
    Route::get('listEstatus/', 'Catalogos\EstatuController@index')->name('listEstatus');
    Route::get('editEstatu/{Id}', 'Catalogos\EstatuController@editItem')->name('editEstatu');
    Route::put('updateEstatu', 'Catalogos\EstatuController@updateItem')->name('updateEstatu');
    Route::get('newEstatu', 'Catalogos\EstatuController@newItem')->name('newEstatu');
    Route::post('createEstatu', 'Catalogos\EstatuController@createItem')->name('createEstatu');
    Route::get('removeEstatu/{id}', 'Catalogos\EstatuController@removeItem')->name('removeEstatu');
    Route::get('addDepEstatu/{Id}/{IdDep}', 'Catalogos\EstatuController@addDepEstatu')->name('addDepEstatu');
    Route::get('removeDepEstatu/{Id}/{IdDep}', 'Catalogos\EstatuController@removeDepEstatu')->name('removeDepEstatu');

    // Catálogo de Medidas
    Route::get('listMedidas/', 'Catalogos\MedidaController@index')->name('listMedidas');
    Route::get('editMedida/{Id}', 'Catalogos\MedidaController@editItem')->name('editMedida');
    Route::put('updateMedida', 'Catalogos\MedidaController@updateItem')->name('updateMedida');
    Route::get('newMedida', 'Catalogos\MedidaController@newItem')->name('newMedida');
    Route::post('createMedida', 'Catalogos\MedidaController@createItem')->name('createMedida');
    Route::get('removeMedida/{id}', 'Catalogos\MedidaController@removeItem')->name('removeMedida');

    // Catálogo de Origenes
    Route::get('listOrigenes/', 'Catalogos\OrigenController@index')->name('listOrigenes');
    Route::get('editOrigen/{Id}', 'Catalogos\OrigenController@editItem')->name('editOrigen');
    Route::put('updateOrigen', 'Catalogos\OrigenController@updateItem')->name('updateOrigen');
    Route::get('newOrigen', 'Catalogos\OrigenController@newItem')->name('newOrigen');
    Route::post('createOrigen', 'Catalogos\OrigenController@createItem')->name('createOrigen');
    Route::get('removeOrigen/{id}', 'Catalogos\OrigenController@removeItem')->name('removeOrigen');

    // Catálogo de Prioridades
    Route::get('listPrioridades/', 'Catalogos\PrioridadController@index')->name('listPrioridades');
    Route::get('editPrioridad/{Id}', 'Catalogos\PrioridadController@editItem')->name('editPrioridad');
    Route::put('updatePrioridad', 'Catalogos\PrioridadController@updateItem')->name('updatePrioridad');
    Route::get('newPrioridad', 'Catalogos\PrioridadController@newItem')->name('newPrioridad');
    Route::post('createPrioridad', 'Catalogos\PrioridadController@createItem')->name('createPrioridad');
    Route::get('removePrioridad/{id}', 'Catalogos\PrioridadController@removeItem')->name('removePrioridad');

    // Catálogo de Servicios
    Route::get('listServicios/', 'Catalogos\ServicioController@index')->name('listServicios');
    Route::get('editServicio/{Id}', 'Catalogos\ServicioController@editItem')->name('editServicio');
    Route::put('updateServicio', 'Catalogos\ServicioController@updateItem')->name('updateServicio');
    Route::get('newServicio', 'Catalogos\ServicioController@newItem')->name('newServicio');
    Route::post('createServicio', 'Catalogos\ServicioController@createItem')->name('createServicio');
    Route::get('removeServicio/{id}', 'Catalogos\ServicioController@removeItem')->name('removeServicio');


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

