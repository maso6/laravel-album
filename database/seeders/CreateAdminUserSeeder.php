<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{

    private function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $password = $this->rand_string(16);

        $user = User::create([
            'name' => 'Mads Lind', 
            'email' => 'mads@madslind.nu',
            'password' => bcrypt($password)
        ]);

        echo "Ny bruger: \n";
        echo "name: " . $user->name . "\n";
        echo "email: " . $user->email . "\n";
        echo "Password: " . $password . "\n";

        $role = Role::create(['name' => 'Admin']);
     
        // Permission
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'gallery-list',
            'token-list'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}