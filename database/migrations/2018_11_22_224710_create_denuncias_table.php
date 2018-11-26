<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $tableNames = config('atemun.table_names.catalogos');

        Schema::create($tableNames['medidas'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('medida',50)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['prioridades'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('prioridad',50)->default('')->nullable();
            $table->boolean('predeterminado')->default(true)->nullable();
            $table->string('class_css',50)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['estatus'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('estatus',50)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['origenes'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('origen',100)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['dependencias'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->string('dependencia',250)->default('')->nullable();
            $table->string('abreviatura',5)->default('')->nullable();
            $table->string('class_css',50)->default('')->nullable();
            $table->boolean('visible_internet')->default(true)->nullable();
            $table->boolean('is_areas')->default(false)->nullable();
            $table->unsignedInteger('jefe_id')->default(0);
            $table->unsignedInteger('user_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['dependencia', 'jefe_id']);
            $table->foreign('jefe_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableNames['areas'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->string('area',250)->default('GENERAL')->nullable();
            $table->unsignedInteger('dependencia_id')->default(1)->index();
            $table->unsignedInteger('jefe_id')->default(1)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['area', 'dependencia_id']);
            $table->foreign('dependencia_id')
                ->references('id')
                ->on($tableNames['dependencias'])
                ->onDelete('cascade');
            $table->foreign('jefe_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableNames['subareas'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->string('subarea',250)->default('GENERAL')->nullable();
            $table->unsignedInteger('area_id')->default(1)->index();
            $table->unsignedInteger('jefe_id')->default(1)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['subarea', 'area_id']);
            $table->foreign('area_id')
                ->references('id')
                ->on($tableNames['areas'])
                ->onDelete('cascade');
            $table->foreign('jefe_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['servicios'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->string('servicio',250)->default('GENERAL')->nullable();
            $table->boolean('habilitado')->default(true)->nullable();
            $table->unsignedInteger('medida_id')->default(1);
            $table->unsignedInteger('subarea_id')->default(1);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['servicio', 'subarea_id']);

            $table->foreign('medida_id')
                ->references('id')
                ->on($tableNames['medidas'])
                ->onDelete('cascade');

            $table->foreign('subarea_id')
                ->references('id')
                ->on($tableNames['subareas'])
                ->onDelete('cascade');
        });


        Schema::create($tableNames['ubicaciones'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('calle',250)->default('')->nullable();
            $table->string('num_ext',100)->default('')->nullable();
            $table->string('num_int',100)->default('')->nullable();
            $table->string('colonia',150)->default('')->nullable();
            $table->string('localidad',150)->default('')->nullable();
            $table->string('municipio',25)->default('')->nullable();
            $table->string('estado',25)->default('TABASCO')->nullable();
            $table->string('pais',25)->default('MÉXICO')->nullable();
            $table->string('cp',10)->default('')->nullable();
            $table->string('latitud',25)->default('')->nullable();
            $table->string('longitud',25)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['denuncias'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->dateTime('fecha_ingreso')->nullable();
            $table->decimal('cantidad',10,4)->default(0)->nullable();
            $table->text('descripcion')->default("")->nullable();
            $table->string('referencia',250)->default("")->nullable();
            $table->string('oficio_envio',50)->default("")->nullable();
            $table->date('fecha_oficio_dependencia')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->date('fecha_ejecucion')->nullable();
            $table->unsignedInteger('prioridad_id')->default(0);
            $table->unsignedInteger('origen_id')->default(0);
            $table->unsignedInteger('dependecia_id')->default(0);
            $table->unsignedInteger('ubicacion_id')->default(0);
            $table->unsignedInteger('servicio_id')->default(0);
            $table->unsignedInteger('ciudadano_id')->default(0);
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedSmallInteger('status_denuncia')->default(1)->nullable();
            $table->unsignedSmallInteger('empresa_id')->default(0)->nullable()->index();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('prioridad_id')
                ->references('id')
                ->on($tableNames['prioridades'])
                ->onDelete('cascade');

            $table->foreign('origen_id')
                ->references('id')
                ->on($tableNames['origenes'])
                ->onDelete('cascade');

            $table->foreign('dependecia_id')
                ->references('id')
                ->on($tableNames['dependencias'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNames['ubicaciones'])
                ->onDelete('cascade');

            $table->foreign('servicio_id')
                ->references('id')
                ->on($tableNames['servicios'])
                ->onDelete('cascade');

            $table->foreign('ciudadano_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['respuestas'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->dateTime('fecha')->nullable();
            $table->text('respuesta')->default("")->nullable();
            $table->text('observaciones')->default("")->nullable();
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('user_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'user_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableNames['denuncia_prioridad'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('prioridad_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'prioridad_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('prioridad_id')
                ->references('id')
                ->on($tableNames['prioridades'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['denuncia_origen'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('origen_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'origen_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('origen_id')
                ->references('id')
                ->on($tableNames['origenes'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['denuncia_dependencia'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('dependencia_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'dependencia_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('dependencia_id')
                ->references('id')
                ->on($tableNames['dependencias'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['denuncia_ubicacion'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'ubicacion_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNames['ubicaciones'])
                ->onDelete('cascade');
        });

        Schema::create($tableNames['denuncia_servicio'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('servicio_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'servicio_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('servicio_id')
                ->references('id')
                ->on($tableNames['servicios'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['denuncia_ciudadano'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('ciudadano_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'ciudadano_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('ciudadano_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['denuncia_user'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('user_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'user_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNames['denuncias'])
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');

        });

        Schema::create($tableNames['dependencia_estatu'], function (Blueprint $table) use ($tableNames){
            $table->increments('id');
            $table->unsignedInteger('estatu_id')->default(0)->index();
            $table->unsignedInteger('dependencia_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['estatu_id', 'dependencia_id']);

            $table->foreign('estatu_id')
                ->references('id')
                ->on($tableNames['estatus'])
                ->onDelete('cascade');

            $table->foreign('dependencia_id')
                ->references('id')
                ->on($tableNames['dependencias'])
                ->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $tableNames = config('atemun.table_names.catalogos');
        Schema::dropIfExists($tableNames['denuncia_user']);
        Schema::dropIfExists($tableNames['denuncia_ciudadano']);
        Schema::dropIfExists($tableNames['denuncia_servicio']);
        Schema::dropIfExists($tableNames['denuncia_ubicacion']);
        Schema::dropIfExists($tableNames['denuncia_dependencia']);
        Schema::dropIfExists($tableNames['denuncia_origen']);
        Schema::dropIfExists($tableNames['denuncia_prioridad']);
        Schema::dropIfExists($tableNames['dependencia_estatu']);
        Schema::dropIfExists($tableNames['user_subarea']);
        Schema::dropIfExists($tableNames['subarea_user']);

        Schema::dropIfExists($tableNames['estatus']);
        Schema::dropIfExists($tableNames['respuestas']);

        Schema::dropIfExists($tableNames['denuncias']);

        Schema::dropIfExists($tableNames['servicios']);
        Schema::dropIfExists($tableNames['subareas']);
        Schema::dropIfExists($tableNames['areas']);
        Schema::dropIfExists($tableNames['dependencias']);

        Schema::dropIfExists($tableNames['origenes']);
        Schema::dropIfExists($tableNames['prioridades']);
        Schema::dropIfExists($tableNames['medidas']);
        Schema::dropIfExists($tableNames['ubicaciones']);

    }
}
