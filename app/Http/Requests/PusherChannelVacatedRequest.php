<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class PusherChannelVacatedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $signature = $this->header('X-Pusher-Signature');

        Log::info('Pusher channel vacated', [
            'signature' => $signature,
            'myHash' => hash_hmac(
                'sha256',
                $this->getContent(),
                config('broadcasting.connections.pusher.secret')
            ),
        ]);

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
