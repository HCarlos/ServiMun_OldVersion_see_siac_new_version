<?php

use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\Catalogos\Afiliacion;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()['cache']->forget('spatie.permission.cache');

        $F = new FuncionesController();
        $ip   = 'root_init';//$_SERVER['REMOTE_ADDR'];
        $host = 'root_init';//gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $idemp = 1;

        $P1 = Permission::create(['name' => 'all']);
        $P2 = Permission::create(['name' => 'crear']);
        $P3 = Permission::create(['name' => 'guardar']);
        $P4 = Permission::create(['name' => 'editar']);
        $P5 = Permission::create(['name' => 'modificar']);
        $P6 = Permission::create(['name' => 'eliminar']);
        $P7 = Permission::create(['name' => 'consultar']);
        $P8 = Permission::create(['name' => 'imprimir']);
        $P9 = Permission::create(['name' => 'asignar']);
        $P10 = Permission::create(['name' => 'desasignar']);
        $P11 = Permission::create(['name' => 'sysop']);

        $role_admin = Role::create([
            'name' => 'Administrator',
            'description' => 'Administrator',
            'guard_name' => 'web',
        ]);
        $role_admin->permissions()->attach($P1);

        $role_sysop = Role::create([
            'name' => 'SysOp',
            'description' => 'System Operator',
            'guard_name' => 'web',
        ]);
        $role_sysop->permissions()->attach($P11);

        $role_invitado = Role::create([
            'name' => 'Invitado',
            'description' => 'Invitado',
            'guard_name' => 'web',
        ]);
        $role_invitado->permissions()->attach($P7);

        $user = new User();
        $user->nombre = 'Administrador';
        $user->username = 'Admin';
        $user->email = 'sentauro@gmail.com';
        $user->password = bcrypt('secret');
        $user->genero = 1;
        $user->admin = true;
        $user->empresa_id = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($role_admin);
        $user->permissions()->attach($P1);
        $user->user_adress()->create();
        $user->user_data_extend()->create();
        $F->validImage($user,'profile','profile/');

        $user = new User();
        $user->nombre = 'System Operator';
        $user->username = 'SysOp';
        $user->email = 'sysop@example.com';
        $user->password = bcrypt('sysop');
        $user->admin = false;
        $user->empresa_id = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($role_sysop);
        $user->permissions()->attach($P11);
        $user->user_adress()->create();
        $user->user_data_extend()->create();
        $F->validImage($user,'profile','profile/');


        Role::create(['name'=>'JEFE','description'=>'Jefe','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'SUBJEFE','description'=>'Subjefe','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'REPORTES','description'=>'Reportes','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA_A','description'=>'Capturista_A','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA_B','description'=>'Capturista_B','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA_C','description'=>'Capturista_C','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ENLACE','description'=>'Enlace','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CIUDADANO','description'=>'Ciudadano','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'DELEGADO','description'=>'Delegado','guard_name'=>'web'])->permissions()->attach($P7);


        factory(User::class, 50)->create()->each(function ($user) use ($P7){
            $user->roles()->attach(12);
            $user->permissions()->attach($P7);
            $user->user_adress()->create();
            $user->user_data_extend()->create();
        });

        factory(Afiliacion::class, 10)->create();

    }



}
