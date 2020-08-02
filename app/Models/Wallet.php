<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    /**
     * @var
     */
    const TYPE_CREDIT_CARD = 1;
    const TYPE_CASH = 2;

    /**
     * @var array
     */
    const TYPES = [
        self::TYPE_CREDIT_CARD => 'Credit Card',
        self::TYPE_CASH => 'Cash'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'type'
    ];

    /**
     * Relate to Transactions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
