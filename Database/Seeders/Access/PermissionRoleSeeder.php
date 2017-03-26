<?php

namespace Modules\Users\Database\Seeders\Access;

use Modules\Base\Database\Seeders\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\Users\Models\Access\Role\Role;
use Modules\Base\Database\Seeders\DisableForeignKeys;

/**
 * Class PermissionRoleSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.permission_role_table'));

        /*
         * Assign view backend and manage user permissions to executive role as example
         */
        Role::find(2)->permissions()->sync([1, 2]);

        $this->enableForeignKeys();
    }
}
