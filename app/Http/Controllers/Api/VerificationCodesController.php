<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\VerificationCodeRequest;


class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $captchaDate = \Cache::get($request->captcha_key);

        if (!$captchaDate) {
            return $this->response->error('captcha expired', 422);
        }

        if (!hash_equals($captchaDate['code'], $request->captcha_code)) {
            \Cache::forget($request->captcha_key);
            return $this->response->errorUnauthorized('captcha error');
        }

        $phone = $captchaDate['phone'];

        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
            try {
                $result = $easySms->send($phone, [
                    'content' => "【lara社区】您的验证码是{$code}。如非本人操作，请忽略本短信"
                ]);
            } catch (\GuzzleHttp\Exception\ClientException $exception) {
                $response = $exception->getResponse();
                $result = json_decode($response->getBody()->getContents(), true);
                return $this->response->errorInternal($result['msg'] ?? 'sms send error');
            }
        }

        $key = 'verificationCode_' . str_random(15);
        $expiredAt = now()->addMinutes(10);

        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
