<?php

namespace App\Filament\Actions\Pages\Visits;

use App\Models\Visit;
use App\Models\TestBooking;
use App\Models\VitalSignsRecord;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\VisitResource;
use App\Filament\Actions\Pages\BasePageAction;

class RecordVItalSignsAction extends BasePageAction
{

    private ?Visit $visit = null;

    public static function getDefaultName(): ?string
    {
        return 'record vital signs';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-clipboard-document-check')
            ->form([
				Fieldset::make('Vital signs')->schema([
						TextInput::make('height')->numeric(),
						TextInput::make('weight')->numeric(),
						TextInput::make('bmi')->numeric(),
						TextInput::make('body_temperature')->numeric(),
						TextInput::make('heart_rate')->numeric(),
						TextInput::make('respiratory_rate')->numeric(),
						TextInput::make('blood_pressure_systolic')->numeric(),
						TextInput::make('blood_pressure_diastolic')->numeric(),
					])->columns(3),
        ])->action(function (array $data): void {
            $this->runAction($data) ? $this->success() : $this->failure();
        });
    }

    public function forVisit(Visit $visit): self
    {
        $this->visit = $visit;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
			$data['visit_id'] = $this->visit->id;
			$data['patient_id'] = $this->visit->patient_id;
            $this->result = VitalSignsRecord::create($data);
            $this->successRedirectUrl(VisitResource::getUrl('view', ['record' => $this->visit->id]));
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
