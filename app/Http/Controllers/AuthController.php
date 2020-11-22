<?php


namespace App\Http\Controllers;


use App\Repositories\AuthRepository;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var AuthRepository
     */
    private $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);

        return response()->json([]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);
        dd($request->all());
        $result = $this->repository->createUser($request->all());
        return response()->json($result, 201);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function viewRegister() {
        return view('register');
    }


}
