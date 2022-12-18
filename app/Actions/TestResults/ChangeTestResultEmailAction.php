<?php

namespace App\Actions\TestResults;



use App\Models\TestResult;

class ChangeTestResultEmailAction
{

    public function run(TestResult|int $invoice, string $email): TestResult
    {
        $invoice = $invoice instanceof TestResult ? $invoice : TestResult::findOrFail($invoice);
        $invoice->update(['customer_email' => $email]);
        return $invoice;
    }
}
