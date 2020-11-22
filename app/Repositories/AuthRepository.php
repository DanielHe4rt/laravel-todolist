<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function authenticate($email, $password) : void
    {
        $model = $this->model->where('email', $email)
            ->first();

        if (!Hash::check($password, $model->password)) {
            throw new \Exception('Senha incorreta');
        }

        Auth::login($model);
    }
}
