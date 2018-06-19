<?php

namespace App\Repositories\Interfaces;

use App\User;

interface IUserRepository
{
    /**
     * @param array $attributes
     * @return User
     */
    function create(array $attributes);

    /**
     * @param User $user
     * @param array $attributes
     * @return User
     */
    function edit(User $user, array $attributes);

    /**
     * @param int $id
     * @return User
     */
    function get($id);
}