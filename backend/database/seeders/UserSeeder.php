<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{

    protected $user;
    protected $role;
    protected $permission;



    public function __construct(
        User $user,
        Role $role,
        Permission $permission
    ) {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->user->create([
            'name' => 'LUIZ FELIPE PIMENTEL DE CARVALHO',
            'email' => 'kranildo@gmail.com',
            'password' => Hash::make("12345678"),
        ]);

        $role = $this->role->create(['name' => 'Super Admin', 'guard_name' => 'api']);
        $user->assignRole($role);
    }
}