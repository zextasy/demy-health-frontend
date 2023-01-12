<?php

namespace App\Filament\Actions\Pages\TestResults;

use App\Models\TestResult;
use App\Models\TestBooking;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Actions\Pages\BasePageAction;
use App\Filament\Resources\TestResultResource;
use App\Actions\TestResults\GenerateTestResultAction;

class UploadTestResultImageAction extends BasePageAction
{

    private ?TestResult $result = null;
    private ?TestBooking $subject = null;

    public static function getDefaultName(): ?string
    {
        return 'upload result';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-cloud-upload')
            ->form([
            Fieldset::make('General Info')->schema([
                TextInput::make('reference')
                    ->maxLength(255)
                    ->unique(table: TestResult::class)
                    ->helperText('Leave this blank and the system will generate one for you'),
            ])->columns(1),
            Fieldset::make('Result')->schema([
                FileUpload::make('result_file')
                    ->acceptedFileTypes(['application/pdf','image/*'])
                    ->multiple()
                    ->enableReordering(),
            ])->columns(1),
            Fieldset::make('Customer Details')->schema([
                TextInput::make('customer_email')
                    ->email()
                    ->maxLength(255)
                    ->helperText(HelpTextMessageHelper::TEST_RESULT_CUSTOMER_EMAIL_MSG),
            ]),
        ])->action(function (array $data): void {
            $this->runAction($data) ? $this->success() : $this->failure();
        });
    }

    public function subject(TestBooking $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            $this->result = (new GenerateTestResultAction)->withMediaUrls($data['result_file'])
                ->withCustomerEmail($data['customer_email'])->run($this->subject);
            $this->successRedirectUrl(TestResultResource::getUrl('view', ['record' => $this->result->id]));
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
