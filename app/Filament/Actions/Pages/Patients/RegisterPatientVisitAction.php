<?php

namespace App\Filament\Actions\Pages\Patients;

use App\Models\Patient;
use App\Models\TestCenter;
use Filament\Forms\Components\Select;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\VisitResource;
use App\Actions\Visits\CreateVisitAction;
use App\Filament\Actions\Pages\BasePageAction;

class RegisterPatientVisitAction extends BasePageAction
{
    private ?Patient $subject = null;

    public static function getDefaultName(): ?string
    {
        return 'Register Visit';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->form([
            TextInput::make('reference')
                ->unique('visits')
                ->maxLength(255)
                ->helperText(HelpTextMessageHelper::DEFAULT_REFERENCE_SUFFIX),
            Select::make('testCenterId')->label('Location')
                ->options(TestCenter::all()->toSelectArray())->searchable()->required(),
        ])
            ->action(function (array $data): void {
            $this->runAction($data) ? $this->success() : $this->failure();
        })
            ->icon('heroicon-m-clipboard-document-check');
    }

    public function subject(Patient $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            $testCenter = TestCenter::findOrFail($data['testCenterId']);
            $visit = (new CreateVisitAction)->withReference($data['reference'])->run($this->subject, $testCenter);
            $this->successRedirectUrl(VisitResource::getUrl('view', ['record' => $visit->id]));
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
