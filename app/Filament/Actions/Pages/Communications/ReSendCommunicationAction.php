<?php

namespace App\Filament\Actions\Pages\Communications;

use App\Models\Patient;
use Filament\Facades\Filament;
use App\Jobs\ChangePatientEmailJob;
use Filament\Forms\Components\Select;
use App\Helpers\HelpTextMessageHelper;
use App\Jobs\DispatchCommunicationJob;
use Filament\Forms\Components\Fieldset;
use App\Contracts\CommunicableContract;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\PatientResource;
use App\Models\Communication\Communication;
use App\Filament\Actions\Pages\BasePageAction;
use App\Enums\Communication\CommunicationChannelEnum;
use App\Actions\Communications\GenerateCommunicationAction;

class ReSendCommunicationAction extends BasePageAction
{
    private ?Communication $communication = null;

    public static function getDefaultName(): ?string
    {
        return 'Resend Communication';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function (array $data): void {
            $this->runAction($data) ? $this->success() : $this->failure();
        })
            ->requiresConfirmation()
            ->icon('heroicon-s-at-symbol')
            ->modalSubheading(HelpTextMessageHelper::RESEND_COMMUNICATION_MODAL_SUBHEADING);
    }

    public function communication(Communication $communication): self
    {
        $this->communication = $communication;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            DispatchCommunicationJob::dispatch($this->communication->communicable, $this->communication);
            $this->successNotificationMessage('The email will be sent!');
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
