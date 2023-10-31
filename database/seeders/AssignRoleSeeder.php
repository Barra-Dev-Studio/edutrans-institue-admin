<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $accessAdmin = Permission::where('name','access-admin')->first();
        $admin->givePermissionTo($accessAdmin);

        $member = Role::where('name', 'member')->first();
        $accessMember = Permission::where('name', 'access-member')->first();
        $member->givePermissionTo($accessMember);
    }
}
