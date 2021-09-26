<?php

namespace App\Services\Integration;

use App\Imports\RowsImport;
use App\Models\Integration;
use App\Services\Integration\Dto\IntegrationCreateDto;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class IntegrationService
{
    /**
     * @param IntegrationCreateDto $dto
     * @throws Exception
     */
    public function import(
        IntegrationCreateDto $dto
    ) {
        try {
            DB::transaction(function () use ($dto) {
                $integration = Integration::create([
                    'path' => $dto->getFile()->getClientOriginalName()
                ]);

                Excel::queueImport(new RowsImport,$dto->getFile())->delay(20);

                $integration->update([
                    'done_at' => Carbon::now()
                ]);
            });
        } catch (Exception $e) {
            throw new Exception("Import Failed: {$e->getMessage()}");
        }
    }
}
