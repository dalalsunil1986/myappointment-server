<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Src\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param User $userRepository
     */
    public function __construct(User $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->with(['favorites'])->all();
        return response()->json(['data' => $users]);
    }

    public function show($id)
    {
        $user = $this->userRepository->with(['favorites'])->find($id);
        return response()->json(['data' => $user]);
    }


}
