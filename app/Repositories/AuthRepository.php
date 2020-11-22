<?php


namespace App\Repositories;


use App\Models\User;

class AuthRepository
{
    /**
     * @var User
     */
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function createUser(array $all)
    {
        $all['password'] = \Hash::make($all['password']);
        return $this->model->create($all);
    }
}
