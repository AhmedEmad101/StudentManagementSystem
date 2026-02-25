<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use function Laravel\Prompts\info;

class SendStudentWelcomeEmail implements ShouldQueue
{
    use Queueable;

   protected User $student;
    public function __construct(User $student)
    {
        $this->student = $student;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       info('Welcome email sent to student ' . $this->student->name);
    }
}
