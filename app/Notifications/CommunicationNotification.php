<?php

namespace App\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use App\Mail\CommunicationEmail;
use App\Contracts\CommunicableContract;
use App\Exceptions\NoMergeDataException;
use Illuminate\Notifications\Notification;
use App\Models\Communication\Communication;
use App\Contracts\GeneratesCommunicationContract;
use App\Exceptions\InvalidCommunicationObjectException;

class CommunicationNotification extends Notification
{
    use Queueable;

    public $tries = 1; // Only try once because retries are handled in the FailedCommunicationListener

    public Communication $communication;

    public CommunicableContract $notifiable;

    public array $templateMergeData;


    /**
     * @throws InvalidCommunicationObjectException
     * @throws NoMergeDataException
     */
    public function __construct(Communication|GeneratesCommunicationContract $communicationObject, CommunicableContract $notifiable, array $templateMergeData = [])
    {
        $this->templateMergeData = $templateMergeData;
        $this->notifiable = $notifiable;
        $this->communication = $communicationObject instanceof Communication
            ? $communicationObject
            : $this->getCommunication($communicationObject, $notifiable);
    }

    public function via($notifiable): array
    {
        return [$this->communication->channel];
    }

    /**
     * @throws Exception
     */
    public function toMail($notifiable): CommunicationEmail
    {
        return (new CommunicationEmail($this->communication))->to($notifiable->routeNotificationForMail());
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param  mixed  $notifiable
     * @param  string  $channel
     *
     * @return bool
     */
    public function shouldSend(CommunicableContract $notifiable, string $channel): bool
    {
        return $notifiable->hasValidRoute($channel);
    }


    /**
     * @throws NoMergeDataException
     *
     */
    private function getCommunication(GeneratesCommunicationContract $communicationObject, CommunicableContract $notifiable): Communication
    {
        if (empty($this->templateMergeData)) {
            throw new NoMergeDataException();
        }

        return $communicationObject->getCommunication($notifiable, $this->templateMergeData);
    }
}

