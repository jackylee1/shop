<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 19.06.2018
 * Time: 22:08
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}