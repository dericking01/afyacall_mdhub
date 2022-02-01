<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Helpers\SmsHelper;

class ProcessSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $gateway = null;
    private $cellNo = null;
    private $textMessage = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($gateway, $cellNo, $textMessage)
    {
        $this->gateway = $gateway;
        $this->cellNo = $cellNo;
        $this->textMessage = $textMessage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $smsHelper = new SmsHelper($this->gateway);
        $res = $smsHelper->sendSms($this->cellNo, $this->textMessage);
    }
}
