<?php

namespace App\Jobs;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\Patients\ChangePatientEmailAction;

class ChangePatientEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $patientId;
    private string $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Patient|int $patient, string $email)
    {
        $this->patientId = $patient instanceof Patient ? $patient->id : $patient;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new ChangePatientEmailAction)->run($this->patientId, $this->email);
    }
}
