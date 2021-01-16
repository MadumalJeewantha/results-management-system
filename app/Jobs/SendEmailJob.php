<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
//For Sending mail
use Illuminate\Support\Facades\Mail;
//Mailable file
use App\Mail\sendMailMailable;

// This is for sending default password to AR & Exam Branch & Lectures

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    //used to store construct values 
    protected  $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->request['email'])->queue(new sendMailMailable($this->request));        
    }

    public function failed(Exception $exception)
    {
        // toastr.error('Validation error.', 'Whoops! Something went wrong,', {timeOut: 5000});

    }
}
