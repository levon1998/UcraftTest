<?php

namespace App\Http\Requests\Transaction;

use App\Models\Transaction;
use App\Repositories\Wallet\WalletRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * @var WalletRepositoryInterface
     */
    private $walletRepository;


    /**
     * StoreTransactionRequest constructor.
     * @param WalletRepositoryInterface $walletRepository
     */
    public function __construct(WalletRepositoryInterface $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $maxAmount = $this->walletRepository->findById($this->input('wallet_id'))->transactions()->sum('amount');
        $maxAmount = ($this->input('is_add')) ? '99999999.99' : $maxAmount;

        return [
            'wallet_id' => 'required|exists:App\Models\Wallet,id',
            'amount'    => "required|numeric|between:0,{$maxAmount}",
            'type'      => 'required|in:'.implode(',', array_keys(Transaction::TYPES)),
            'is_add'    => 'required'
        ];
    }
}
