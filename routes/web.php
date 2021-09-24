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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);

// Authentication Routes...
// $this
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () {
    // USUARIOS
    Route::get('edit', 'Catalogos\User\UserDataController@showEditUserData')->name('edit');
    Route::put('Edit', 'Catalogos\User\UserDataController@update')->name('Edit');
    Route::get('showEditProfilePhoto/', 'Catalogos\User\UserDataController@showEditProfilePhoto')->name('showEditProfilePhoto/');
    Route::get('editUser/{Id}', 'Catalogos\User\UserDataController@showEditUser')->name('editUser');
    Route::put('EditUser', 'Catalogos\User\UserDataController@updateUser')->name('EditUser');
});

Route::group(['middleware' => 'role:auth|Administrator|SysOp'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('newUser', 'Catalogos\User\UserDataController@newUser')->name('newUser');
    Route::post('createUser', 'Catalogos\User\UserDataController@createUser')->name('createUser');
    Route::get('removeUser/{id}', 'Catalogos\User\UserDataController@removeUser')->name('removeUser');
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
    Route::get('listEstatus/', 'Denuncia\EstatuController@index')->name('listEstatus');
    Route::get('editEstatu/{Id}', 'Denuncia\EstatuController@editItem')->name('editEstatu');
    Route::put('updateEstatu', 'Denuncia\EstatuController@updateItem')->name('updateEstatu');
    Route::get('newEstatu', 'Denuncia\EstatuController@newItem')->name('newEstatu');
    Route::post('createEstatu', 'Denuncia\EstatuController@createItem')->name('createEstatu');
    Route::get('removeEstatu/{id}', 'Denuncia\EstatuController@removeItem')->name('removeEstatu');
    Route::get('addDepEstatu/{Id}/{IdDep}', 'Denuncia\EstatuController@addDepEstatu')->name('addDepEstatu');
    Route::get('removeDepEstatu/{Id}/{IdDep}', 'Denuncia\EstatuController@removeDepEstatu')->name('removeDepEstatu');

    // Catálogo de Medidas
    Route::get('listMedidas/', 'Denuncia\MedidaController@index')->name('listMedidas');
    Route::get('editMedida/{Id}', 'Denuncia\MedidaController@editItem')->name('editMedida');
    Route::put('updateMedida', 'Denuncia\MedidaController@updateItem')->name('updateMedida');
    Route::get('newMedida', 'Denuncia\MedidaController@newItem')->name('newMedida');
    Route::post('createMedida', 'Denuncia\MedidaController@createItem')->name('createMedida');
    Route::get('removeMedida/{id}', 'Denuncia\MedidaController@removeItem')->name('removeMedida');

    // Catálogo de Origenes
    Route::get('listOrigenes/', 'Denuncia\OrigenController@index')->name('listOrigenes');
    Route::get('editOrigen/{Id}', 'Denuncia\OrigenController@editItem')->name('editOrigen');
    Route::put('updateOrigen', 'Denuncia\OrigenController@updateItem')->name('updateOrigen');
    Route::get('newOrigen', 'Denuncia\OrigenController@newItem')->name('newOrigen');
    Route::post('createOrigen', 'Denuncia\OrigenController@createItem')->name('createOrigen');
    Route::get('removeOrigen/{id}', 'Denuncia\OrigenController@removeItem')->name('removeOrigen');

    // Catálogo de Prioridades
    Route::get('listPrioridades/', 'Denuncia\PrioridadController@index')->name('listPrioridades');
    Route::get('editPrioridad/{Id}', 'Denuncia\PrioridadController@editItem')->name('editPrioridad');
    Route::put('updatePrioridad', 'Denuncia\PrioridadController@updateItem')->name('updatePrioridad');
    Route::get('newPrioridad', 'Denuncia\PrioridadController@newItem')->name('newPrioridad');
    Route::post('createPrioridad', 'Denuncia\PrioridadController@createItem')->name('createPrioridad');
    Route::get('removePrioridad/{id}', 'Denuncia\PrioridadController@removeItem')->name('removePrioridad');

    // Catálogo de Servicios
    Route::get('listServicios/', 'Denuncia\ServicioController@index')->name('listServicios');
    Route::get('editServicio/{Id}', 'Denuncia\ServicioController@editItem')->name('editServicio');
    Route::put('updateServicio', 'Denuncia\ServicioController@updateItem')->name('updateServicio');
    Route::get('newServicio', 'Denuncia\ServicioController@newItem')->name('newServicio');
    Route::post('createServicio', 'Denuncia\ServicioController@createItem')->name('createServicio');
    Route::get('removeServicio/{id}', 'Denuncia\ServicioController@removeItem')->name('removeServicio');

    // Catálogo de Afiliaciones
    Route::get('listAfiliaciones/', 'Denuncia\AfiliacionController@index')->name('listAfiliaciones');
    Route::get('editAfiliacion/{Id}', 'Denuncia\AfiliacionController@editItem')->name('editAfiliacion');
    Route::put('updateAfiliacion', 'Denuncia\AfiliacionController@updateItem')->name('updateAfiliacion');
    Route::get('newAfiliacion', 'Denuncia\AfiliacionController@newItem')->name('newAfiliacion');
    Route::post('createAfiliacion', 'Denuncia\AfiliacionController@createItem')->name('createAfiliacion');
    Route::get('removeAfiliacion/{id}', 'Denuncia\AfiliacionController@removeItem')->name('removeAfiliacion');

    // Catálogo de Asentamientos
    Route::get('listAsentamientos/', 'Catalogos\Domicilio\AsentamientoController@index')->name('listAsentamientos');
    Route::get('editAsentamiento/{Id}', 'Catalogos\Domicilio\AsentamientoController@editItem')->name('editAsentamiento');
    Route::put('updateAsentamiento', 'Catalogos\Domicilio\AsentamientoController@updateItem')->name('updateAsentamiento');
    Route::get('newAsentamiento', 'Catalogos\Domicilio\AsentamientoController@newItem')->name('newAsentamiento');
    Route::post('createAsentamiento', 'Catalogos\Domicilio\AsentamientoController@createItem')->name('createAsentamiento');
    Route::get('removeAsentamiento/{id}', 'Catalogos\Domicilio\AsentamientoController@removeItem')->name('removeAsentamiento');

    // Catálogo de Calles
    Route::get('listCalles/', 'Catalogos\Domicilio\CalleController@index')->name('listCalles');
    Route::get('editCalle/{Id}', 'Catalogos\Domicilio\CalleController@editItem')->name('editCalle');
    Route::put('updateCalle', 'Catalogos\Domicilio\CalleController@updateItem')->name('updateCalle');
    Route::get('newCalle', 'Catalogos\Domicilio\CalleController@newItem')->name('newCalle');
    Route::post('createCalle', 'Catalogos\Domicilio\CalleController@createItem')->name('createCalle');
    Route::get('removeCalle/{id}', 'Catalogos\Domicilio\CalleController@removeItem')->name('removeCalle');

    // Catálogo de Ciudades
    Route::get('listCiudades/', 'Catalogos\Domicilio\CiudadController@index')->name('listCiudades');
    Route::get('editCiudad/{Id}', 'Catalogos\Domicilio\CiudadController@editItem')->name('editCiudad');
    Route::put('updateCiudad', 'Catalogos\Domicilio\CiudadController@updateItem')->name('updateCiudad');
    Route::get('newCiudad', 'Catalogos\Domicilio\CiudadController@newItem')->name('newCiudad');
    Route::post('createCiudad', 'Catalogos\Domicilio\CiudadController@createItem')->name('createCiudad');
    Route::get('removeCiudad/{id}', 'Catalogos\Domicilio\CiudadController@removeItem')->name('removeCiudad');

    // Catálogo de Localidades
    Route::get('listLocalidades/', 'Catalogos\Domicilio\LocalidadController@index')->name('listLocalidades');
    Route::get('editLocalidad/{Id}', 'Catalogos\Domicilio\LocalidadController@editItem')->name('editLocalidad');
    Route::put('updateLocalidad', 'Catalogos\Domicilio\LocalidadController@updateItem')->name('updateLocalidad');
    Route::get('newLocalidad', 'Catalogos\Domicilio\LocalidadController@newItem')->name('newLocalidad');
    Route::post('createLocalidad', 'Catalogos\Domicilio\LocalidadController@createItem')->name('createLocalidad');
    Route::get('removeLocalidad/{id}', 'Catalogos\Domicilio\LocalidadController@removeItem')->name('removeLocalidad');

    // Catálogo de Municipios
    Route::get('listMunicipios/', 'Catalogos\Domicilio\MunicipioController@index')->name('listMunicipios');
    Route::get('editMunicipio/{Id}', 'Catalogos\Domicilio\MunicipioController@editItem')->name('editMunicipio');
    Route::put('updateMunicipio', 'Catalogos\Domicilio\MunicipioController@updateItem')->name('updateMunicipio');
    Route::get('newMunicipio', 'Catalogos\Domicilio\MunicipioController@newItem')->name('newMunicipio');
    Route::post('createMunicipio', 'Catalogos\Domicilio\MunicipioController@createItem')->name('createMunicipio');
    Route::get('removeMunicipio/{id}', 'Catalogos\Domicilio\MunicipioController@removeItem')->name('removeMunicipio');

    // Catálogo de Estados
    Route::get('listEstados/', 'Catalogos\Domicilio\EstadoController@index')->name('listEstados');
    Route::get('editEstado/{Id}', 'Catalogos\Domicilio\EstadoController@editItem')->name('editEstado');
    Route::put('updateEstado', 'Catalogos\Domicilio\EstadoController@updateItem')->name('updateEstado');
    Route::get('newEstado', 'Catalogos\Domicilio\EstadoController@newItem')->name('newEstado');
    Route::post('createEstado', 'Catalogos\Domicilio\EstadoController@createItem')->name('createEstado');
    Route::get('removeEstado/{id}', 'Catalogos\Domicilio\EstadoController@removeItem')->name('removeEstado');

    // Catálogo de Codigopostales
    Route::get('listCodigopostales/', 'Catalogos\Domicilio\CodigopostalController@index')->name('listCodigopostales');
    Route::get('editCodigopostal/{Id}', 'Catalogos\Domicilio\CodigopostalController@editItem')->name('editCodigopostal');
    Route::put('updateCodigopostal', 'Catalogos\Domicilio\CodigopostalController@updateItem')->name('updateCodigopostal');
    Route::get('newCodigopostal', 'Catalogos\Domicilio\CodigopostalController@newItem')->name('newCodigopostal');
    Route::post('createCodigopostal', 'Catalogos\Domicilio\CodigopostalController@createItem')->name('createCodigopostal');
    Route::get('removeCodigopostal/{id}', 'Catalogos\Domicilio\CodigopostalController@removeItem')->name('removeCodigopostal');

    // Catálogo de Tipoasentamientos
    Route::get('listTipoasentamientos/', 'Catalogos\Domicilio\TipoasentamientoController@index')->name('listTipoasentamientos');
    Route::get('editTipoasentamiento/{Id}', 'Catalogos\Domicilio\TipoasentamientoController@editItem')->name('editTipoasentamiento');
    Route::put('updateTipoasentamiento', 'Catalogos\Domicilio\TipoasentamientoController@updateItem')->name('updateTipoasentamiento');
    Route::get('newTipoasentamiento', 'Catalogos\Domicilio\TipoasentamientoController@newItem')->name('newTipoasentamiento');
    Route::post('createTipoasentamiento', 'Catalogos\Domicilio\TipoasentamientoController@createItem')->name('createTipoasentamiento');
    Route::get('removeTipoasentamiento/{id}', 'Catalogos\Domicilio\TipoasentamientoController@removeItem')->name('removeTipoasentamiento');

    // Catálogo de Tipocomunidades
    Route::get('listTipocomunidades/', 'Catalogos\Domicilio\TipocomunidadController@index')->name('listTipocomunidades');
    Route::get('editTipocomunidad/{Id}', 'Catalogos\Domicilio\TipocomunidadController@editItem')->name('editTipocomunidad');
    Route::put('updateTipocomunidad', 'Catalogos\Domicilio\TipocomunidadController@updateItem')->name('updateTipocomunidad');
    Route::get('newTipocomunidad', 'Catalogos\Domicilio\TipocomunidadController@newItem')->name('newTipocomunidad');
    Route::post('createTipocomunidad', 'Catalogos\Domicilio\TipocomunidadController@createItem')->name('createTipocomunidad');
    Route::get('removeTipocomunidad/{id}', 'Catalogos\Domicilio\TipocomunidadController@removeItem')->name('removeTipocomunidad');

    // Catálogo de Comunidades
    Route::get('listComunidades/', 'Catalogos\Domicilio\ComunidadController@index')->name('listComunidades');
    Route::get('editComunidad/{Id}', 'Catalogos\Domicilio\ComunidadController@editItem')->name('editComunidad');
    Route::put('updateComunidad', 'Catalogos\Domicilio\ComunidadController@updateItem')->name('updateComunidad');
    Route::get('newComunidad', 'Catalogos\Domicilio\ComunidadController@newItem')->name('newComunidad');
    Route::post('createComunidad', 'Catalogos\Domicilio\ComunidadController@createItem')->name('createComunidad');
    Route::get('removeComunidad/{id}', 'Catalogos\Domicilio\ComunidadController@removeItem')->name('removeComunidad');

    // Catálogo de Colonias
    Route::get('listColonias/', 'Catalogos\Domicilio\ColoniaController@index')->name('listColonias');
    Route::get('editColonia/{Id}', 'Catalogos\Domicilio\ColoniaController@editItem')->name('editColonia');
    Route::put('updateColonia', 'Catalogos\Domicilio\ColoniaController@updateItem')->name('updateColonia');
    Route::get('newColonia', 'Catalogos\Domicilio\ColoniaController@newItem')->name('newColonia');
    Route::post('createColonia', 'Catalogos\Domicilio\ColoniaController@createItem')->name('createColonia');
    Route::get('removeColonia/{id}', 'Catalogos\Domicilio\ColoniaController@removeItem')->name('removeColonia');

    // Catálogo de Ubicaciones
    Route::get('listUbicaciones/', 'Catalogos\Domicilio\UbicacionController@index')->name('listUbicaciones');
    Route::get('editUbicacion/{Id}', 'Catalogos\Domicilio\UbicacionController@editItem')->name('editUbicacion');
    Route::put('updateUbicacion', 'Catalogos\Domicilio\UbicacionController@updateItem')->name('updateUbicacion');
    Route::get('newUbicacion', 'Catalogos\Domicilio\UbicacionController@newItem')->name('newUbicacion');
    Route::post('createUbicacion', 'Catalogos\Domicilio\UbicacionController@createItem')->name('createUbicacion');
    Route::get('removeUbicacion/{id}', 'Catalogos\Domicilio\UbicacionController@removeItem')->name('removeUbicacion');

    // ROLES
    Route::get('asignaRoleList/{Id}','Catalogos\User\RoleController@index')->name('asignaRoleList');
    Route::post('assignRoleToUser','Catalogos\User\RoleController@asignar')->name('assignRoleToUser');
    Route::post('unAssignRoleToUser','Catalogos\User\RoleController@desasignar')->name('unAssignRoleToUser');

    // PERMISSIONS
    Route::get('asignaPermissionList/{Id}','Catalogos\User\PermissionController@index')->name('asignaPermissionList');
    Route::post('assignPermissionToUser','Catalogos\User\PermissionController@asignar')->name('assignPermissionToUser');
    Route::post('unAssignPermissionToUser','Catalogos\User\PermissionController@desasignar')->name('unAssignPermissionToUser');

    // EXTERNAL FILES
    Route::get('archivosConfig','Storage\StorageExternalFilesController@archivos_config')->name('archivosConfig');
    Route::post('subirArchivoBase/', 'Storage\StorageExternalFilesController@subirArchivoBase')->name('subirArchivoBase/');

//    Route::get('quitarArchivoBase/{driver}/{archivo}', 'Storage\StorageExternalFilesController@quitarArchivoBase')->name('quitarArchivoBase/');
    Route::post('quitarArchivoBase', 'Storage\StorageExternalFilesController@quitarArchivoBase')->name('quitarArchivoBase');

    Route::post('showFileListUserExcel1A','External\User\ListUserXLSXController@getListUserXLSX')->name('showFileListUserExcel1A');

    //    Route::post('showFileListNivelExcel','External\Nivel\ListNivelXLSXController@getListNivelXLSX')->name('showFileListNivelExcel');
    //    Route::post('showFileListParentescoExcel','External\Parentesco\ListParentescoXLSXController@getListParentescoXLSX')->name('showFileListParentescoExcel');
    //    Route::post('showFileListFamiliaExcel','External\Familia\ListFamiliaXLSXController@getListFamiliaXLSX')->name('showFileListFamiliaExcel');
    //    Route::post('showFileListRegFisExcel','External\Registros_Fiscales\ListaRegFisXLSXController@getListRegFisXLSX')->name('showFileListRegFisExcel');
    Route::post('getUserByRoleToXLSX','External\User\ListUserXLSXController@getUserByRoleToXLSX')->name('getUserByRoleToXLSX');

    Route::post('getModelListXlS/{model}','External\ListModelXLSXController@getListModelXLSX')->name('getModelListXlS');

    // Catálogo de Denuncias
    Route::get('listDenuncias/', 'Denuncia\DenunciaController@index')->name('listDenuncias');
    Route::get('editDenuncia/{Id}', 'Denuncia\DenunciaController@editItem')->name('editDenuncia');
    Route::put('updateDenuncia', 'Denuncia\DenunciaController@updateItem')->name('updateDenuncia');
    Route::get('newDenuncia', 'Denuncia\DenunciaController@newItem')->name('newDenuncia');
    Route::post('createDenuncia', 'Denuncia\DenunciaController@createItem')->name('createDenuncia');
    Route::get('removeDenuncia/{id}', 'Denuncia\DenunciaController@removeItem')->name('removeDenuncia');
    Route::get('searchAdress/', 'Denuncia\DenunciaController@searchAdress')->name('searchAdress');
    Route::get('getUbi/{IdUbi}', 'Denuncia\DenunciaController@getUbi')->name('getUbi');
    Route::get('showModalSearchDenuncia/', 'Denuncia\DenunciaController@showModalSearchDenuncia')->name('showModalSearchDenuncia');
    Route::put('findDataInDenuncia/', 'Denuncia\DenunciaController@findDataInDenuncia')->name('findDataInDenuncia');
    Route::post('showDataListDenunciaExcel1A/', 'External\Denuncia\ListDenunciaXLSXController@getListDenunciaXLSX')->name('showDataListDenunciaExcel1A');
    Route::get('/imprimir_denuncia/{Id}', 'External\Denuncia\HojaDenunciaController@imprimirDenuncia')->name('imprimirDenuncia/');

    Route::get('getServiciosFromDependencias/{id}', 'Denuncia\DenunciaController@getServiciosFromDependencias')->name('getServiciosFromDependencias');
//    Route::get('newServicioDependenciaDenuncia', 'Denuncia\DenunciaController@newServicioDependenciaDenuncia')->name('newServicioDependenciaDenuncia');
//    Route::post('addServicioDependenciaDenuncia', 'Denuncia\DenunciaController@addServicioDependenciaDenuncia')->name('addServicioDependenciaDenuncia');

    // PIVOTE DENUNCIA DEPENDENCIA SERVICIO
//    Route::get('listDenunciaDependenciaServicio/{Id}', 'Denuncia\DenunciaDependenciaServicioController@index')->name('listDenunciaDependenciaServicio');

});

Route::group(['middleware' => 'role:auth|Administrator|SysOp|DELEGADO'], function () {

    Route::get('/home-ciudadano', 'HomeController@index_ciudadano')->name('home_ciudadano');

    Route::get('showEditProfilePassword/', 'Catalogos\User\UserDataController@showEditProfilePassword')->name('showEditProfilePassword/');
    Route::put('changePasswordUser/', 'Catalogos\User\UserDataController@changePasswordUser')->name('changePasswordUser/');
    Route::post('subirFotoProfile/', 'Storage\StorageProfileController@subirArchivoProfile')->name('subirArchivoProfile/');
    Route::get('quitarFotoProfile/', 'Storage\StorageProfileController@quitarArchivoProfile')->name('quitarArchivoProfile/');

    // PIVOTE DENUNCIA DEPENDENCIA SERVICIO
    Route::get('listDenunciaDependenciaServicio/{Id}', 'Denuncia\DenunciaDependenciaServicioController@index')->name('listDenunciaDependenciaServicio');
    Route::get('addDenunciaDependenciaServicio/{Id}', 'Denuncia\DenunciaDependenciaServicioController@addItem')->name('addDenunciaDependenciaServicio');
    Route::post('postAddDenunciaDependenciaServicio', 'Denuncia\DenunciaDependenciaServicioController@postNew')->name('postAddDenunciaDependenciaServicio');
    Route::get('editDenunciaDependenciaServicio/{Id}', 'Denuncia\DenunciaDependenciaServicioController@editItem')->name('editDenunciaDependenciaServicio');
    Route::post('putAddDenunciaDependenciaServicio', 'Denuncia\DenunciaDependenciaServicioController@putEdit')->name('putAddDenunciaDependenciaServicio');
    Route::get('removeDenunciaDependenciaServicio/{id}', 'Denuncia\DenunciaDependenciaServicioController@removeItem')->name('removeDenunciaDependenciaServicio');

    // Catálogo de DENUNCIAS CIUDADANAS
    Route::get('listDenunciasCiudadanas/', 'Denuncia\DenunciaCiudadanaController@index')->name('listDenunciasCiudadanas');
    Route::get('editDenuncia/{Id}', 'Denuncia\DenunciaController@editItem')->name('editDenuncia');
    Route::put('updateDenuncia', 'Denuncia\DenunciaController@updateItem')->name('updateDenuncia');
    Route::get('newDenuncia', 'Denuncia\DenunciaController@newItem')->name('newDenuncia');
    Route::post('createDenuncia', 'Denuncia\DenunciaController@createItem')->name('createDenuncia');
    Route::get('removeDenuncia/{id}', 'Denuncia\DenunciaController@removeItem')->name('removeDenuncia');
    Route::get('searchAdress/', 'Denuncia\DenunciaController@searchAdress')->name('searchAdress');
    Route::get('getUbi/{IdUbi}', 'Denuncia\DenunciaController@getUbi')->name('getUbi');

    // Catálogo de Respuestas
    Route::get('listRespuestas/{Id}', 'Denuncia\Respuesta\RespuestaController@index')->name('listRespuestas');
    Route::get('removeRespuesta/{id}', 'Denuncia\Respuesta\RespuestaController@removeItem')->name('removeRespuesta');
    Route::get('/showModalRespuestaNew/{denuncia_id}', 'Denuncia\Respuesta\RespuestaController@showModalRespuestaNew')->name('/showModalRespuestaNew');
    Route::get('showModalRespuestaEdit/{Id}', 'Denuncia\Respuesta\RespuestaController@showModalRespuestaEdit')->name('/showModalRespuestaEdit');
    Route::post('saveRespuestaDen/', 'Denuncia\Respuesta\RespuestaController@saveRespuestaDen')->name('saveRespuestaDen');
    Route::put('saveRespuestaDen/', 'Denuncia\Respuesta\RespuestaController@saveRespuestaDen')->name('saveRespuestaDen');

    Route::get('/RespuestaARespuestaNew/{denuncia_id}/{respuesta_id}', 'Denuncia\Respuesta\RespuestaController@RespuestaARespuestaNew')->name('/RespuestaARespuestaNew');
    Route::post('saveRespuestaARespuestaDen/', 'Denuncia\Respuesta\RespuestaController@saveRespuestaARespuestaDen')->name('saveRespuestaARespuestaDen');

    Route::get('listRespuestasCiudadanas/{Id}', 'Denuncia\Respuesta\RespuestaCiudadanaController@index')->name('listRespuestasCiudadanas');
    Route::get('removeRespuestaCiudadana/{id}', 'Denuncia\Respuesta\RespuestaCiudadanaController@removeItem')->name('removeRespuestaCiudadana');
    Route::get('/showModalRespuestaCiudadanaNew/{denuncia_id}', 'Denuncia\Respuesta\RespuestaCiudadanaController@showModalRespuestaCiudadanaNew')->name('/showModalRespuestaCiudadanaNew');
    Route::get('showModalRespuestaCiudadanaEdit/{Id}', 'Denuncia\Respuesta\RespuestaCiudadanaController@showModalRespuestaCiudadanaEdit')->name('/showModalRespuestaCiudadanaEdit');
//    Route::post('saveRespuestaDen/', 'Denuncia\Respuesta\RespuestaCiudadanaController@saveRespuestaDen')->name('saveRespuestaDen');
//    Route::put('saveRespuestaDen/', 'Denuncia\Respuesta\RespuestaCiudadanaController@saveRespuestaDen')->name('saveRespuestaDen');

    // Catálogo de Imagenes
    Route::get('listImagenes/{Id}', 'Denuncia\Imagene\ImageneController@index')->name('listImagenes');
    Route::get('removeImagene/{id}', 'Denuncia\Imagene\ImageneController@removeItem')->name('removeImagene');
    Route::get('/showModalImageneNew/{denuncia_id}', 'Denuncia\Imagene\ImageneController@showModalImageneNew')->name('/showModalImageneNew');
    Route::get('showModalImageneEdit/{Id}', 'Denuncia\Imagene\ImageneController@showModalImageneEdit')->name('/showModalImageneEdit');
    Route::post('saveImageneDen/', 'Denuncia\Imagene\ImageneController@saveImageneDen')->name('saveImageneDen');
    Route::put('saveImageneDen/', 'Denuncia\Imagene\ImageneController@saveImageneDen')->name('saveImageneDen');

    Route::get('/ImagenAImagenNew/{denuncia_id}/{imagen_id}', 'Denuncia\Imagene\ImageneController@ImagenAImagenNew')->name('/ImagenAImagenNew');
    Route::post('saveImagenAImagenDen/', 'Denuncia\Imagene\ImageneController@saveImagenAImagenDen')->name('saveImagenAImagenDen');
    Route::get('removeImagenParent/{id}', 'Denuncia\Imagene\ImageneController@removeImagenParent')->name('removeImagenParent');


});


    // END FILES EXTERNAL




Route::get('enviar', ['as' => 'enviar', function () {
    $data = ['link' => 'http://atemun.mx'];
    Mail::send('emails.notificacion', $data, function ($message) {
        $message->from('manager@logydes.com.mx', 'Logydes.com.mx');
        $message->to('logydes@gmail.com')->subject('Notificación');
    });
    return "Se envío el email";
}]);

