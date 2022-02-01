<?php

namespace App\Helpers;

use App\Model\Smslog;
use Exception;
use Illuminate\Support\Facades\Log;



class SmsHelper
{


    function __construct()
    {
    }

    public function sendSms($number, $message)
    {

        //clean message for GSM extended character
        // ~^{}[]\|
        $message = str_replace('{', '(', $message);
        $message = str_replace('}', ')', $message);
        $message = str_replace('[', '(', $message);
        $message = str_replace(']', ')', $message);
        $message = preg_replace("/[^a-zA-Z0-9\s(),\/]/mi", "", $message);
        $message = preg_replace("/\s{2,}/mi", " ", $message);


        try {
            return $this->sendviavodacom($number, $message);
        } catch (Exception $e) {
            //write error log
            Log::channel('smsLog')->error($e->getMessage());
        }


        return true;
    }


    private function sendviavodacom($number, $message)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $client->request('GET', 'http://192.168.1.10:6013/cgi-bin/sendsms', [
                'query' => [
                    'username' => 'afya',
                    'password' => 'Afya4017',
                    'from' => '15723',
                    'to' => $number,
                    'text' => $message,
                ]
            ]);

            $log = $this->logSmsToDB($number, $message, "200");
            return true;
        } catch (\Throwable $th) {
            $log = $this->logSmsToDB($number, $message, "201");
            Log::error($th->getMessage());
        }
    }


    private function logSmsToDB($to, $message, $status)
    {
        return Smslog::create([
            'to' => $to,
            'message' => $message,
            'status' => $status,
        ]);
    }
}
