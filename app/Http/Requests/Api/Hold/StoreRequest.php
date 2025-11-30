<?php

namespace App\Http\Requests\Api\Hold;

use App\Exceptions\HoldException;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * @throws HoldException
     */
    public function customValidate()
    {
        $idempotencyKey = $this->header('Idempotency-Key');
        if (!isset($idempotencyKey)) {
            HoldException::throwConflict();
        }

        $validated = $this->validated();
        $validated['idempotency_key'] = $idempotencyKey;

        return $validated;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
