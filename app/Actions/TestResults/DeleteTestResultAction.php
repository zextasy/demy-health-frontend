<?php

namespace App\Actions\TestResults;

use Exception;
use App\Models\TestResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteTestResultAction
{

    public function run(TestResult|int|null $testResult): bool
    {
        if (empty($testResult)) {
            return true;
        }
        $testResult = $testResult instanceof TestResult ? $testResult : TestResult::findOrFail($testResult);
        $testResult->loadMissing(['media']);
        try {
            DB::transaction(function () use ($testResult) {
                $testResult->media()->delete();
                $testResult->delete();
            });

            return true;
        }
        catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
