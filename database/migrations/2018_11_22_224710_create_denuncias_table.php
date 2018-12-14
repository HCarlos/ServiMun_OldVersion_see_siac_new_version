<?php

use Illuminate\Support\Facades\DB;
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
            $table->boolean('predeterminado')->default(false)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['prioridades'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('prioridad',50)->default('')->nullable();
            $table->boolean('predeterminado')->default(false)->nullable();
            $table->string('class_css',50)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['estatus'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('estatus',50)->default('')->nullable();
            $table->boolean('predeterminado')->default(false)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create($tableNames['origenes'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('origen',100)->default('')->nullable();
            $table->boolean('predeterminado')->default(false)->nullable();
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


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $tableNames = config('atemun.table_names.catalogos');
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

    }
}
