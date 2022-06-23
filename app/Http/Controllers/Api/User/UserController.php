<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private WalletRepository $repository;

    /**
     * @param WalletRepository $repository
     */
    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function user(Request $request): array
    {
        return $request->user()->toArray();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function balance(Request $request): array
    {
        return $this->repository->getPlayerBalance($request->user()->id);
    }



}
