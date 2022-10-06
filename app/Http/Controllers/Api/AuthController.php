<?php

namespace App\Http\Controllers\Api;

use App\Events\NewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;


class AuthController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $userInterface) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->user = $userInterface;
    }

    /**
     * @OA\Post(
     *   tags={"Usuario"},
     *   path="/login",
     *   summary="Login para pegar token JWT",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"email", "password"},
     *       @OA\Property(property="email", type="string"),
     *       @OA\Property(property="password", type="string"),
     *     ),
     *   ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function login(Request $request){
    	$response = $this->user->login($request);
        return $response;
    }

    /**
     * @OA\Post(
     *   tags={"Usuario"},
     *   path="/register",
     *   summary="Cadastro de Usuário",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name", "email", "password", "password_confirmation"},
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="email", type="string"),
     *       @OA\Property(property="password", type="string"),
     *       @OA\Property(property="password_confirmation", type="string"),
     *     ),
     *   ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function register(Request $request) {
        $response = $this->user->register($request);
        // event(new NewUser($request->all()));
        return response()->json($response);
    }

    public function logout() {
        $response = $this->user->logout();
        return response()->json($response);
    }

    public function refresh() {
        $response = $this->user->refresh();
        return response()->json($response);
    }

    public function userProfile() {
        $response = $this->user->userProfile();
        return response()->json($response);
    }
}
