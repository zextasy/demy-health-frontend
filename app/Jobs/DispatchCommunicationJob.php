<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use App\Contracts\CommunicableContract;
use App\Models\Communication\Communication;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\CommunicationNotification;
use App\Jobs\Middleware\SendCommunicationRateLimit;

class DispatchCommunicationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $maxExceptions;

    private Communication $communication;
    private CommunicableContract $notifiable;
    private array $models;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct(CommunicableContract $customer, Communication $communication, array $models = [])
    {
        $this->notifiable = $customer;
        $this->communication = $communication;
        $this->models = $models;
    }

    public function middleware(): array
    {
        return [new SendCommunicationRateLimit()];
    }

    public function retryUntil(): Carbon
    {
        return now()->addHours(3);
    }

    public function uniqueId(): string
    {

        return "communication_id_{$this->communication->id}_notifiable_id_{$this->notifiable->id}";
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
//        $mergeModel = array_merge([$this->notifiable], $this->models);
//
//        $templateMergeData = TemplateHelper::getMergeDataFromModels($mergeModel, true);
        try {
            $communicationNotification = new CommunicationNotification($this->communication, $this->notifiable);
            $this->notifiable->notify($communicationNotification);
        } catch (\Exception $e) {
            report($e);
        }
    }
}
