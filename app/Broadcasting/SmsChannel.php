<?php

namespace App\Broadcasting;

use App\Models\User;
use webazin\KaveNegar\SMS;

class SmsChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param \App\Models\User $user
     * @return array|bool
     */
    public function join(User $user)
    {
        //
    }

    public function send($notifiable, $notification)
    {
        $message = $notification->toSms($notifiable);
        $template = $message['templateSms'];
        $sms = new SMS;
        $mobile = $notifiable->mobile;
        $code = $message['code'];
        str_replace(' ', $code, '_');
        try {
            $result = $sms->VerifyLookup($mobile, $code, $template);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
