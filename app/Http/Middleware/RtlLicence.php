<?php

namespace App\Http\Middleware;

use App\Helper\Helper;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class RtlLicence
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        return $next($request);
    }

    private function checkLicence()
    {
        $apiKey = 'rtl74a06167bcb94bfb8bbf60f82cacaf4d';
        $userName = Setting::get('rtl_username');
        $idOrder = Setting::get('id_order');
        $domain = request()->getHttpHost();
        $pid = '257306';
        $sandbox = defined('App\Helper\Helper::RTLSANDBOX') && Helper::RTLSANDBOX;

        $params = [
            'api' => $sandbox ? 'SandBox-API' : $apiKey,
            'username' => $sandbox ? 'SandBox-User' : $userName,
            'order_id' => $sandbox ? 'SandBox-Order' : $idOrder,
            'domain' => $domain,
            'pid' => $pid
        ];
        $url = 'https://www.rtl-theme.com/oauth/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=" . $params['api'] . "&username=" . $params['username'] . "&order_id=".$params['order_id']."&domain=$domain&pid=$pid");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response != '1') {
            $error = $this->getError($response);
            return $error;
        }
        return null;
    }

    private function getError($response)
    {
        switch ($response) {
            case '1':
                $error = NULL;
                break;
            case '-1':
                $error = 'API اشتباه است';
                break;
            case '-2':
                $error = 'نام کاربری اشتباه است';
                break;
            case '-3':
                $error = 'کد سفارش اشتباه است';
                break;
            case '-4':
                $error = 'کد سفارش قبلا ثبت شده است';
                break;
            case '-8':
            case '-5':
                $error = 'کد سفارش مربوطه به اين نام کاربری نميباشد';
                break;
            case '-6':
                $error = '!اطلاعات وارد شده در فرمت صحيح نميباشند';
                break;
            case '-7':
                $error = 'کد سفارش مربوط به اين محصول نيست';
                break;
            default:
                $error = 'خطای غيرمنتظره رخ داده است';
                break;
        }
        return $error;
    }
}
