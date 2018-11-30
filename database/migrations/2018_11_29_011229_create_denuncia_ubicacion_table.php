<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenunciaUbicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNamesCatalogos = config('atemun.table_names.catalogos');
        $tableNamesDomicilios = config('atemun.table_names.domicilios');

        Schema::create($tableNamesDomicilios['ubicaciones'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->string('calle',250)->default('')->nullable();
            $table->string('num_ext',100)->default('')->nullable();
            $table->string('num_int',100)->default('')->nullable();
            $table->string('colonia',150)->default('')->nullable();
            $table->string('localidad',150)->default('')->nullable();
            $table->string('ciudad',100)->default('')->nullable();
            $table->string('municipio',50)->default('')->nullable();
            $table->string('estado',50)->default('TABASCO')->nullable();
            $table->string('pais',25)->default('MÉXICO')->nullable();
            $table->string('cp',10)->default('')->nullable();
            $table->float('latitud',4,10)->default(0)->nullable();
            $table->float('longitud',4,10)->default(0)->nullable();
            $table->unsignedInteger('calle_id')->default(0)->nullable()->index();
            $table->unsignedInteger('colonia_id')->default(0)->nullable()->index();
            $table->unsignedInteger('localidad_id')->default(0)->nullable()->index();
            $table->unsignedInteger('ciudad_id')->default(0)->nullable()->index();
            $table->unsignedInteger('municipio_id')->default(0)->nullable()->index();
            $table->unsignedInteger('estado_id')->default(0)->nullable()->index();
            $table->unsignedInteger('codigopostal_id')->default(0)->nullable()->index();
            $table->unique(['calle_id', 'colonia_id','localidad_id','ciudad_id', 'municipio_id','estado_id', 'codigopostal_id']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('calle_id')
                ->references('id')
                ->on($tableNamesDomicilios['calles'])
                ->onDelete('cascade');

            $table->foreign('colonia_id')
                ->references('id')
                ->on($tableNamesDomicilios['colonias'])
                ->onDelete('cascade');

            $table->foreign('localidad_id')
                ->references('id')
                ->on($tableNamesDomicilios['localidades'])
                ->onDelete('cascade');

            $table->foreign('ciudad_id')
                ->references('id')
                ->on($tableNamesDomicilios['ciudades'])
                ->onDelete('cascade');

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableNamesDomicilios['municipios'])
                ->onDelete('cascade');

            $table->foreign('estado_id')
                ->references('id')
                ->on($tableNamesDomicilios['estados'])
                ->onDelete('cascade');

            $table->foreign('codigopostal_id')
                ->references('id')
                ->on($tableNamesDomicilios['codigospostales'])
                ->onDelete('cascade');

        });


        Schema::create($tableNamesDomicilios['calle_ubicacion'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('calle_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['calle_id', 'ubicacion_id']);

            $table->foreign('calle_id')
                ->references('id')
                ->on($tableNamesDomicilios['calles'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');

        });


        Schema::create($tableNamesDomicilios['colonia_ubicacion'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('colonia_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['colonia_id', 'ubicacion_id']);

            $table->foreign('colonia_id')
                ->references('id')
                ->on($tableNamesDomicilios['colonias'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');

        });


        Schema::create($tableNamesDomicilios['localidad_ubicacion'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('localidad_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['localidad_id', 'ubicacion_id']);

            $table->foreign('localidad_id')
                ->references('id')
                ->on($tableNamesDomicilios['localidades'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesDomicilios['ciudad_ubicacion'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('ciudad_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['ciudad_id', 'ubicacion_id']);

            $table->foreign('ciudad_id')
                ->references('id')
                ->on($tableNamesDomicilios['ciudades'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesDomicilios['municipio_ubicacion'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('municipio_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['municipio_id', 'ubicacion_id']);

            $table->foreign('municipio_id')
                ->references('id')
                ->on($tableNamesDomicilios['municipios'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesDomicilios['estado_ubicacion'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('estado_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['estado_id', 'ubicacion_id']);

            $table->foreign('estado_id')
                ->references('id')
                ->on($tableNamesDomicilios['estados'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesDomicilios['codigopostal_ubicacion'], function (Blueprint $table) use ($tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('codigopostal_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['codigopostal_id', 'ubicacion_id']);

            $table->foreign('codigopostal_id')
                ->references('id')
                ->on($tableNamesDomicilios['codigospostales'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');

        });

        DB::statement("ALTER DATABASE dbatemun set default_text_search_config = 'spanish'");
        DB::statement("ALTER TABLE ubicaciones ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE ubicaciones SET searchtext = to_tsvector('spanish', coalesce(trim(calle),'') || ' ' || coalesce(trim(colonia),'') || ' ' || coalesce(trim(localidad),'') || ' ' || coalesce(trim(ciudad),'') || ' ' || coalesce(trim(municipio),'') || ' ' || coalesce(trim(estado),'') )");
        DB::statement("CREATE INDEX searchtext_gin ON ubicaciones USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON ubicaciones FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.spanish', 'calle', 'colonia', 'localidad', 'ciudad', 'municipio', 'estado')");


        Schema::create($tableNamesCatalogos['denuncias'], function (Blueprint $table) use ($tableNamesCatalogos) {
            $table->increments('id');
            $table->dateTime('fecha_ingreso')->nullable();
            $table->decimal('cantidad',10,4)->default(0)->nullable();
            $table->text('descripcion')->default("")->nullable();
            $table->string('referencia',250)->default("")->nullable();
            $table->string('oficio_envio',50)->default("")->nullable();
            $table->date('fecha_oficio_dependencia')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->date('fecha_ejecucion')->nullable();
            $table->string('calle',250)->default('')->nullable();
            $table->string('num_ext',100)->default('')->nullable();
            $table->string('num_int',100)->default('')->nullable();
            $table->string('colonia',150)->default('')->nullable();
            $table->string('localidad',150)->default('')->nullable();
            $table->string('ciudad',100)->default('')->nullable();
            $table->string('municipio',50)->default('')->nullable();
            $table->string('estado',50)->default('TABASCO')->nullable();
            $table->string('pais',25)->default('MÉXICO')->nullable();
            $table->string('cp',10)->default('')->nullable();
            $table->float('latitud',4,10)->default(0)->nullable();
            $table->float('longitud',4,10)->default(0)->nullable();
            $table->unsignedSmallInteger('status_denuncia')->default(1)->nullable();
            $table->unsignedInteger('prioridad_id')->default(0)->nullable()->unique();
            $table->unsignedInteger('origen_id')->default(0)->nullable()->unique();
            $table->unsignedInteger('dependecia_id')->default(0)->nullable()->unique();
            $table->unsignedInteger('ubicacion_id')->default(0)->nullable()->unique();
            $table->unsignedInteger('servicio_id')->default(0)->nullable()->unique();
            $table->unsignedInteger('ciudadano_id')->default(0)->nullable()->unique();
            $table->unsignedSmallInteger('empresa_id')->default(0)->nullable()->index();
            $table->unsignedInteger('creadopor_id')->default(0)->nullable()->unique();
            $table->unsignedInteger('modificadopor_id')->default(0)->nullable()->unique();
            $table->string('ip',150)->default('')->nullable();
            $table->string('host',150)->default('')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('prioridad_id')
                ->references('id')
                ->on($tableNamesCatalogos['prioridades'])
                ->onDelete('cascade');

            $table->foreign('origen_id')
                ->references('id')
                ->on($tableNamesCatalogos['origenes'])
                ->onDelete('cascade');

            $table->foreign('dependecia_id')
                ->references('id')
                ->on($tableNamesCatalogos['dependencias'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesCatalogos['ubicaciones'])
                ->onDelete('cascade');

            $table->foreign('servicio_id')
                ->references('id')
                ->on($tableNamesCatalogos['servicios'])
                ->onDelete('cascade');

            $table->foreign('ciudadano_id')
                ->references('id')
                ->on($tableNamesCatalogos['users'])
                ->onDelete('cascade');

            $table->foreign('creadopor_id')
                ->references('id')
                ->on($tableNamesCatalogos['users'])
                ->onDelete('cascade');

            $table->foreign('modificadopor_id')
                ->references('id')
                ->on($tableNamesCatalogos['users'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesCatalogos['respuestas'], function (Blueprint $table) use ($tableNamesCatalogos){
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
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($tableNamesCatalogos['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableNamesCatalogos['denuncia_prioridad'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('prioridad_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'prioridad_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('prioridad_id')
                ->references('id')
                ->on($tableNamesCatalogos['prioridades'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesCatalogos['denuncia_origen'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('origen_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'origen_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('origen_id')
                ->references('id')
                ->on($tableNamesCatalogos['origenes'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesCatalogos['denuncia_dependencia'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('dependencia_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'dependencia_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('dependencia_id')
                ->references('id')
                ->on($tableNamesCatalogos['dependencias'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesCatalogos['denuncia_servicio'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('servicio_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'servicio_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('servicio_id')
                ->references('id')
                ->on($tableNamesCatalogos['servicios'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesCatalogos['ciudadano_denuncia'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('ciudadano_id')->default(0)->index();
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'ciudadano_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('ciudadano_id')
                ->references('id')
                ->on($tableNamesCatalogos['users'])
                ->onDelete('cascade');

        });

        Schema::create($tableNamesCatalogos['creadopor_denuncia'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('creadopor_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('creadopor_id')
                ->references('id')
                ->on($tableNamesCatalogos['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableNamesCatalogos['denuncia_modificadopor'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('modificadopor_id')->default(0)->index();
            $table->text('descripcion')->default("")->nullable();
            $table->string('referencia',250)->default("")->nullable();
            $table->string('oficio_envio',50)->default("")->nullable();
            $table->date('fecha_oficio_dependencia')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->date('fecha_ejecucion')->nullable();
            $table->unsignedSmallInteger('status_denuncia')->default(1)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('modificadopor_id')
                ->references('id')
                ->on($tableNamesCatalogos['users'])
                ->onDelete('cascade');
        });

        Schema::create($tableNamesCatalogos['dependencia_estatu'], function (Blueprint $table) use ($tableNamesCatalogos){
            $table->increments('id');
            $table->unsignedInteger('estatu_id')->default(0)->index();
            $table->unsignedInteger('dependencia_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['estatu_id', 'dependencia_id']);

            $table->foreign('estatu_id')
                ->references('id')
                ->on($tableNamesCatalogos['estatus'])
                ->onDelete('cascade');

            $table->foreign('dependencia_id')
                ->references('id')
                ->on($tableNamesCatalogos['dependencias'])
                ->onDelete('cascade');

        });




        Schema::create($tableNamesCatalogos['denuncia_ubicacion'], function (Blueprint $table) use ($tableNamesCatalogos, $tableNamesDomicilios){
            $table->increments('id');
            $table->unsignedInteger('denuncia_id')->default(0)->index();
            $table->unsignedInteger('ubicacion_id')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['denuncia_id', 'ubicacion_id']);

            $table->foreign('denuncia_id')
                ->references('id')
                ->on($tableNamesCatalogos['denuncias'])
                ->onDelete('cascade');

            $table->foreign('ubicacion_id')
                ->references('id')
                ->on($tableNamesDomicilios['ubicaciones'])
                ->onDelete('cascade');
        });

        DB::statement("ALTER DATABASE dbatemun set default_text_search_config = 'spanish'");
        DB::statement("ALTER TABLE denuncias ADD COLUMN searchtextdenuncia TSVECTOR");
        DB::statement("UPDATE denuncias SET searchtextdenuncia = to_tsvector('spanish', coalesce(trim(descripcion),'') || ' ' || coalesce(trim(referencia),'') || ' ' || coalesce(trim(calle),'') || ' ' || coalesce(trim(colonia),'') || ' ' || coalesce(trim(localidad),'') || ' ' || coalesce(trim(ciudad),'') || ' ' || coalesce(trim(municipio),'') || ' ' || coalesce(trim(estado),'') )");
        DB::statement("CREATE INDEX searchtextdenuncia_gin ON denuncias USING GIN(searchtextdenuncia)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON denuncias FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtextdenuncia', 'pg_catalog.spanish', 'descripcion', 'referencia', 'calle', 'colonia', 'localidad', 'ciudad', 'municipio', 'estado')");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNamesDomicilios = config('atemun.table_names.domicilios');
        $tableNamesCatalogos = config('atemun.table_names.catalogos');

        Schema::dropIfExists($tableNamesCatalogos['ciudadano_denuncia']);
        Schema::dropIfExists($tableNamesCatalogos['denuncia_servicio']);
        Schema::dropIfExists($tableNamesCatalogos['denuncia_dependencia']);
        Schema::dropIfExists($tableNamesCatalogos['denuncia_origen']);
        Schema::dropIfExists($tableNamesCatalogos['denuncia_prioridad']);
        Schema::dropIfExists($tableNamesCatalogos['denuncia_ubicacion']);

        Schema::dropIfExists($tableNamesCatalogos['respuestas']);

        Schema::dropIfExists($tableNamesCatalogos['creadopor_denuncia']);
        Schema::dropIfExists($tableNamesCatalogos['denuncia_modificadopor']);

        DB::statement("DROP TRIGGER IF EXISTS tsvector_update_trigger ON denuncias");
        DB::statement("DROP INDEX IF EXISTS searchtextdenuncia_gin");
        DB::statement("DROP TRIGGER IF EXISTS ts_searchtext ON denuncias");
        DB::statement("ALTER TABLE denuncias DROP COLUMN IF EXISTS searchtextdenuncia");

        Schema::dropIfExists($tableNamesCatalogos['denuncias']);

        Schema::dropIfExists($tableNamesDomicilios['calle_ubicacion']);
        Schema::dropIfExists($tableNamesDomicilios['colonia_ubicacion']);
        Schema::dropIfExists($tableNamesDomicilios['localidad_ubicacion']);
        Schema::dropIfExists($tableNamesDomicilios['ciudad_ubicacion']);
        Schema::dropIfExists($tableNamesDomicilios['municipio_ubicacion']);
        Schema::dropIfExists($tableNamesDomicilios['estado_ubicacion']);
        Schema::dropIfExists($tableNamesDomicilios['codigopostal_ubicacion']);

        DB::statement("DROP TRIGGER IF EXISTS tsvector_update_trigger ON ubicaciones");
        DB::statement("DROP INDEX IF EXISTS searchtext_gin");
        DB::statement("DROP TRIGGER IF EXISTS ts_searchtext ON ubicaciones");
        DB::statement("ALTER TABLE ubicaciones DROP COLUMN IF EXISTS searchtext");

        Schema::dropIfExists($tableNamesDomicilios['ubicaciones']);


    }
}
