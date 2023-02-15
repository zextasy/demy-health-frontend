<?php

namespace App\Actions\Communications;

use App\Contracts\CommunicableContract;
use App\Events\CommunicationCreatedEvent;
use App\Models\Communication\Communication;
use App\Models\Communication\SmsCommunication;
use App\Models\Communication\EmailCommunication;
use App\Exceptions\UnexpectedMatchValueException;
use App\Enums\Communication\CommunicationChannelEnum;

class GenerateCommunicationAction
{
    private bool $shouldRaiseEvents = true;
    private ?Communication $communication = null;

    public function run(string|CommunicationChannelEnum $type, CommunicableContract $communicable, array $communicationContent): Communication
    {
        $typeEnum = $type instanceof CommunicationChannelEnum ? $type : CommunicationChannelEnum::from($type);
        switch ($typeEnum->value) {
            case CommunicationChannelEnum::EMAIL():
                $communicationType = new EmailCommunication();
                $communicationType->to = $communicable->routeNotificationForMail();
                $communicationType->subject = $communicationContent['subject'];
                $communicationType->reply_to = $communicationContent['replyTo'] ?? null;
                $communicationType->content = $communicationContent['content'];
                break;
            case CommunicationChannelEnum::SMS():
                $communicationType = new SmsCommunication();
                $communicationType->phone_number = $communicable->routeNotificationForSMS();
                $communicationType->content = $communicationContent['content'];
                break;
            default:
                throw new UnexpectedMatchValueException();
        }
        $communicationType->save();

        $this->communication = new Communication();
        $this->communication->communicable()->associate($communicable);
        $this->communication->communication()->associate($communicationType);
        $this->communication->save();

        if ($this->shouldRaiseEvents) {
            $this->raiseEvents();
        }

        return $this->communication;

    }

    public function withEvents(bool $shouldRaise = true): self
    {
        $this->shouldRaiseEvents = $shouldRaise;
        return $this;
    }

    private function raiseEvents()
    {
        CommunicationCreatedEvent::dispatch($this->communication);
    }

}
