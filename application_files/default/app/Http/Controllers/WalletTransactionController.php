<?php

namespace App\Http\Controllers;

use App\Repositories\WalletTransactionsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class WalletTransactionController extends Controller
{

    private WalletTransactionsRepository $repository;

    public function __construct(WalletTransactionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function process(Request $request, string $process): JsonResponse
    {
        if (method_exists(__CLASS__,$process)){
            return $this->$process($request);
        }
        return response()->json(['status' => false, 'message' => $process . ' Action Not Found']);
    }

    /**
     * @throws Throwable
     */
    public function debit(Request $request): JsonResponse
    {
        $playerId = $request->user()->id;
        $transaction_id = $request->post('transaction_id');
        $amount = $request->post('amount');
        $balance = $request->user()->wallet->balance;
        if ($balance < $amount){
            return response()->json([
                'status' => false,
                'message' => 'Insufficiend Funds'
            ]);
        }
        $game_cycle = $request->post('game_cycle');
        $create = $this->repository->createDebit($playerId,$transaction_id,$amount,$game_cycle, 'EUR');
        return response()->json($create);
    }

    /**
     * @throws Throwable
     */
    public function credit(Request $request): JsonResponse
    {
        $playerId = $request->user()->id;
        $transaction_id = $request->post('transaction_id');
        $amount = $request->post('winAmount');
        $game_cycle = $request->post('game_cycle');
        $create = $this->repository->createCredit($playerId,$transaction_id,$amount,$game_cycle, 'EUR');
        return response()->json($create);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function balance(Request $request): JsonResponse
    {
        $user = $request->user();
        $wallet = $user->wallet;
        return  response()->json([
            'balance' => $wallet->balance,
            'currency' => $wallet->currency
        ]);
    }
}
