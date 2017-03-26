<?php

if (! function_exists('users_config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed
     */
     function users_config($key = null, $default = null)
     {
         return config('module.users.'.$key, $default);
     }
}

if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

use Modules\Users\Models\Access\User\User;
if (! function_exists('access_can')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access_can(User $user)
    {
        if (access()->user()->id === $user->id || access()->hasRole('Administrator')) {
            return true;
        }
        if (!access()->hasRole('Administrator') && $user->hasRole('Administrator') || $user->hasRole('Executive')) {
            return false;
        }
        return true;
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}
