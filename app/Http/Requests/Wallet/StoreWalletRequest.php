<?php

namespace App\Http\Requests\Wallet;

use App\Models\Wallet;
use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
{
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
        return [
            'type' => 'required|in:'.implode(',', array_keys(Wallet::TYPES)),
            'name' => 'required|string|min:1|max:255'
        ];
    }
}
