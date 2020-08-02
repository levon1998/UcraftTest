<?php

namespace App\Repositories\Transaction;


use App\Models\Wallet;
use Illuminate\Support\Collection;

interface TransactionRepositoryInterface
{
    /**
     * @param $perPageCount
     * @return Collection
     */
    public function all($perPageCount);

    /**
     * @param array $wheres
     */
    public function findWhere(array $wheres);

    /**
     * @param Wallet $wallet
     * @param array $data
     * @return mixed
     */
    public function store(Wallet $wallet, array $data);

}