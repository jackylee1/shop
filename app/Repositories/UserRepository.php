<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return User::create($attributes);
    }

    public function edit(User $user, array $attributes)
    {
        return $user->fill($attributes);
    }

    public function get($id)
    {
        return $this->model->find($id);
    }
}