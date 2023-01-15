<?php

namespace App\Actions\TestResults;



use App\Models\TestResult;

class ChangeTestResultEmailAction
{

    public function run(TestResult|int $testResult, string $email): TestResult
    {
        $testResult = $testResult instanceof TestResult ? $testResult : TestResult::findOrFail($testResult);
        $testResult->update(['customer_email' => $email]);
        return $testResult;
    }
}
