<?php

namespace App\Exports;

use App\Expenditure;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpenditureExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Expenditure::query()->with('type');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'TITLE',
            'FOR',
            'PAID TO',
            'DATE',
            'AMOUNT',

        ];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->title,
            $row->type->name,
            $row->paid_to,
            $row->created_at,
            $row->amount,
        ];
    }
}
