<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\IsActiveNoficationUser;

class JobIsActiveUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $isActive;
    public function __construct($user, $isActive)
    {
        
        $this->user = $user;
        $this->isActive = $isActive;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {         
        $this->user
                ->notify(new IsActiveNoficationUser($this->isActive)
        );
    }
}
