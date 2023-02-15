<?php

namespace App\Filament\Actions\Pages\Communications;

use App\Models\Patient;
use Filament\Facades\Filament;
use App\Jobs\ChangePatientEmailJob;
use Filament\Forms\Components\Select;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Fieldset;
use App\Contracts\CommunicableContract;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\PatientResource;
use App\Filament\Actions\Pages\BasePageAction;
use App\Enums\Communication\CommunicationChannelEnum;
use App\Actions\Communications\GenerateCommunicationAction;

class SendCommunicationAction extends BasePageAction
{
    private ?CommunicableContract $communicable = null;

    public static function getDefaultName(): ?string
    {
        return 'Send Communication';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->form([
            Select::make('channel')
                ->label('Type')
                ->options(CommunicationChannelEnum::optionsAsSelectArray())
                ->default(CommunicationChannelEnum::EMAIL->value)
                ->disabled()
                ->required(),
            TextInput::make('subject')->required(),
            TextInput::make('replyTo')->email(),
            RichEditor::make('content')
                ->label('Content')
                ->required(),
        ])
            ->action(function (array $data): void {
            $this->runAction($data) ? $this->success() : $this->failure();
        })
            ->icon('heroicon-s-at-symbol')
            ->modalSubheading(HelpTextMessageHelper::CHANGE_EMAIL_ACTION_MODAL_SUBHEADING);
    }

    public function communicable(CommunicableContract $communicable): self
    {
        $this->communicable = $communicable;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            $emailData['subject'] = $data['subject'];
            $emailData['replyTo'] = $data['replyTo'];
            $emailData['content'] = $data['content'];
            (new GenerateCommunicationAction)->run($data['channel'], $this->communicable, $emailData);
            $this->successNotificationMessage('The email will be sent!');
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
