<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Base\Database\Seeders\DisableForeignKeys;

/**
 * Class AccessTableSeeder.
 */
class AccessTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->call(Access\UserTableSeeder::class);
        $this->call(Access\RoleTableSeeder::class);
        $this->call(Access\UserRoleSeeder::class);
        $this->call(Access\PermissionTableSeeder::class);
        $this->call(Access\PermissionRoleSeeder::class);

        $this->enableForeignKeys();
    }
}
