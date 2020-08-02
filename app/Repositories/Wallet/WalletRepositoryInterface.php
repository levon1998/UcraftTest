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

interface WalletRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all();
    /**
     * @param $perPageCount
     * @return Collection
     */
    public function paginated($perPageCount);

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id) :Wallet;

    /**
     * @param array $where
     * @return Model
     */
    public function findWhere(array $where) :Model;

    /**
     * @return Model
     */
    public function destroy();

    /**
     * @param int $id
     * @return Model
     */
    public function deleteById(int $id);

    /**
     * @param array $where
     * @return Model
     */
    public function deleteWhere(array $where);

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data);

    /**
     * @param array $where
     * @return Model
     */
    public function updateWhere(array $where);

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);
}