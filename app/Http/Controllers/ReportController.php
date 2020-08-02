<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\SearchTransactionRequest;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Repositories\Wallet\WalletRepositoryInterface;

class ReportController extends Controller
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;
    private $walletRepository;

    /**
     * ReportController constructor.
     * @param TransactionRepositoryInterface $transactionRepository
     * @param WalletRepositoryInterface $walletRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository, WalletRepositoryInterface $walletRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->walletRepository = $walletRepository;
    }

    public function index(SearchTransactionRequest $transactionRequest)
    {
        $transactions = $this->transactionRepository->findWhere($transactionRequest->validated());
        $wallets = $this->walletRepository->all();

        return view('userPages.reports.index', compact('transactions', 'wallets'));
    }
}
