<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Row;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class RowsImport implements ToModel, WithChunkReading ,WithHeadingRow, WithBatchInserts, WithValidation, WithCalculatedFormulas, WithUpserts, ShouldQueue
{
    use RemembersRowNumber, RemembersChunkOffset;

    private $rows = 0;

    /**
     * @param array $row
     */
    public function model(array $row)
    {

        $currentRowNumber = $this->getRowNumber();
        $chunkOffset = $this->getChunkOffset();

        Log::info("Row id {$row['id']}", [$row, $currentRowNumber, $chunkOffset]);
        ++$this->rows;
        return new Row([
            'id'     => $row['id'],
            'name'    => (string) $row['name'],
            'date' => Carbon::parse($row['date']),
        ]);
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
            ],
            'name' => [
                'required',
                'string',
            ],
            'date' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function chunkSize(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 1;
    }

    public function uniqueBy()
    {
        return 'id';
    }
}
