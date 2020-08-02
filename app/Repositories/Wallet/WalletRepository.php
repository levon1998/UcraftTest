<?php
/**
 * Created by PhpStorm.
 * User: levon
 * Date: 8/2/2020
 * Time: 11:19 AM
 */

namespace App\Repositories\Wallet;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WalletRepository implements WalletRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all()
    {
        return Auth::user()->wallets;
    }

    public function paginated($perPageCount = 25)
    {
        return Auth::user()->wallets()->paginate($perPageCount);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Wallet
    {
        return Auth::user()->wallets()->where('id', $id)->with('transactions')->firstOrFail();
    }

    /**
     * @param array $where
     * @return Model
     */
    public function findWhere(array $where): Model
    {
        // TODO: Implement findWhere() method.
    }

    /**
     * @return Model
     */
    public function destroy()
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @param int $id
     * @return Model
     */
    public function deleteById(int $id)
    {
        Auth::user()->wallets()->where('id', $id)->delete();
    }

    /**
     * @param array $where
     * @return Model
     */
    public function deleteWhere(array $where)
    {
        // TODO: Implement deleteWhere() method.
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data)
    {
        Auth::user()->wallets()->where('id', $id)->update($data);
    }

    /**
     * @param array $where
     * @return Model
     */
    public function updateWhere(array $where)
    {
        // TODO: Implement updateWhere() method.
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Auth::user()->wallets()->create($data);
    }
}