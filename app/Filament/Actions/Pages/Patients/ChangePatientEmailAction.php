<?php

namespace App\Filament\Actions\Pages\Patients;

use App\Models\Patient;
use App\Jobs\ChangePatientEmailJob;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\TextInput;
use App\Filament\Admin\Resources\PatientResource;
use App\Filament\Actions\Pages\BasePageAction;

class ChangePatientEmailAction extends BasePageAction
{
    private ?Patient $subject = null;

    public static function getDefaultName(): ?string
    {
        return 'Action';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->form([
            TextInput::make('email')
                ->label('email')
                ->email()
                ->unique('patients')
                ->default($this->subject?->email)
                ->required(),
        ])
            ->action(function (array $data): void {
            $this->runAction($data) ? $this->success() : $this->failure();
        })
            ->icon('heroicon-s-at-symbol')
            ->modalSubheading(HelpTextMessageHelper::CHANGE_EMAIL_ACTION_MODAL_SUBHEADING);
    }

    public function subject(Patient $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            ChangePatientEmailJob::dispatch($this->subject->id, $data['email']);
            $this->successNotificationMessage('The email will be changed!');
            $this->successRedirectUrl(PatientResource::getUrl('view', ['record' => $this->subject->id]));
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
