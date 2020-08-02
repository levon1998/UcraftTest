<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Repositories\Wallet\WalletRepositoryInterface;

class TransactionController extends Controller
{

    /**
     * @var
     */
    private $transactionRepository;
    private $walletRepository;

    /**
     * WalletController constructor.
     * @param TransactionRepositoryInterface $transactionRepository
     * @param WalletRepositoryInterface $walletRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository, WalletRepositoryInterface $walletRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->walletRepository = $walletRepository;
    }

    /**
     * Function to store wallet
     *
     * @param StoreTransactionRequest $transactionRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTransactionRequest $transactionRequest)
    {
        $data = $transactionRequest->validated();
        $wallet = $this->walletRepository->findById($data['wallet_id']);

        $this->transactionRepository->store($wallet, $data);

        return redirect()->back();
    }
}
