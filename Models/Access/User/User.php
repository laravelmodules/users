<?php

namespace Modules\Users\Models\Access\User;

use Illuminate\Notifications\Notifiable;
use Modules\Users\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Users\Models\Access\User\Traits\Scope\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Users\Models\Access\User\Traits\UserSendPasswordReset;
use Modules\Users\Models\Access\User\Traits\Attribute\UserAttribute;
use Modules\Users\Models\Access\User\Traits\Relationship\UserRelationship;

use Modules\Teams\Models\CanJoinTeams;
/**
 * Class User.
 */
class User extends Authenticatable
{
    use UserScope,
        UserAccess,
        Notifiable,
        SoftDeletes,
        UserAttribute,
        UserRelationship,
        UserSendPasswordReset;
    use CanJoinTeams;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username','name','lastname', 'email', 'password','logins', 'status', 'confirmation_code', 'confirmed','last_login'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at','last_login'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.users_table');
    }
}
