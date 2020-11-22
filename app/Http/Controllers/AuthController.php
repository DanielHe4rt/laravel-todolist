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
        try {
            $this->repository->authenticate(
                $request->input('email'),
                $request->input('password')
            );
            return response()->json([]);
        } catch(\Exception $exception) {
            return response()->json(['Deu ruim'], 401);
        }

    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);
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

    public function viewLogin() {
        return view('login');
    }
}
