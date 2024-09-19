<?php
namespace App\Exports;

use App\Models\ClientAccount;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccountsExport implements FromCollection, WithHeadings
{
    protected $selectedIds;

    public function collection()
    {
        // Replace this with your data retrieval logic
        return ClientAccount::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Client ID',
            'Account Number',
            'Account Type',
            'Balance',
        ];
    }
}
