<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PusherChannelVacatedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $signature = $this->header('x-pusher-signature');

        return hash_equals(
            $signature,
            hash_hmac(
                'sha256',
                $this->getContent(),
                config('broadcasting.connections.pusher.secret')
            )
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
