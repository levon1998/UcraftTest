<?php

namespace App\Repositories\Transaction;


use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * @param $perPageCount
     * @return Collection
     */
    public function all($perPageCount = 25)
    {
        return Auth::user()->wallets()->paginate($perPageCount);
    }

    /**
     * @param array $wheres
     * @return mixed
     */
    public function findWhere(array $wheres)
    {
        return Auth::user()->transactions()
            ->when(isset($wheres['wallet_id']), function ($q) use ($wheres) {
                $q->where('wallet_id', $wheres['wallet_id']);
            })
            ->when(isset($wheres['min_amount']), function ($q) use ($wheres) {
                $q->where('amount', '>=', $wheres['min_amount']);
            })
            ->when(isset($wheres['max_amount']), function ($q) use ($wheres) {
                $q->where('amount', '<=', $wheres['max_amount']);
            })
            ->when(isset($wheres['start_date']), function ($q) use ($wheres) {
                $q->whereDate('created_at', '>=', $wheres['start_date']);
            })
            ->when(isset($wheres['end_date']), function ($q) use ($wheres) {
                $q->whereDate('created_at', '<=', $wheres['end_date']);
            })->with('wallet')
            ->paginate(50);
    }

    /**
     * @param Wallet $wallet
     * @param array $data
     * @return mixed
     */
    public function store(Wallet $wallet, array $data)
    {
        $data['user_id'] = Auth::id();
        $data['amount']  = (!$data['is_add']) ? "-{$data['amount']}" : $data['amount'];

        return $wallet->transactions()->create($data);
    }
}