<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'fname' => 'Superadmin', 
            // 'email' => 'portals@mjunction.in',
            'email' => 'admin@gmail.com',
            // 'username' => 'superadmin',
            'contact' => 1122334455,
            //'password' => 'Superadmin@2022',
            'designation_id' => 1,
            'business_unit_id' => 1,
            'account_type_id' => 1,
            'category_id' => 1,
            'password' => 'admin@123',
            'role_id' => 1
        ]);
    
        $role = Role::create(['name' => 'superadmin','description'=>'superadmin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
