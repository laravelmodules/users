<?php

namespace Modules\Users\Repositories\Backend\Access\Permission;

use Modules\Users\Repositories\BaseRepository;
use Modules\Users\Models\Access\Permission\Permission;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Permission::class;
}
