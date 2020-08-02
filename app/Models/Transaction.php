<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * @var
     */
    const TYPE_CREDIT = 1;
    const TYPE_DEBIT = 2;

    /**
     * @var array
     */
    const TYPES = [
        self::TYPE_CREDIT => 'Credit',
        self::TYPE_DEBIT => 'Debit'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_id',
        'user_id',
        'type',
        'amount',
        'is_add'
    ];

    /**
     * Relate with wallet
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
