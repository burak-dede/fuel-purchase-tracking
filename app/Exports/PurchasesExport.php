<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchasesExport implements FromCollection, WithHeadings
{

    /**
     * @inheritDoc
     */
    public function collection()
    {
        $expenses = DB::table("purchases")
            ->join("users","purchases.user_id","=","users.id")
            ->join("vehicles","purchases.vehicle_id","=","vehicles.id")
            ->select("purchases.p_date","vehicles.registration_plate","users.name","users.lastname","purchases.km","purchases.liter","purchases.price","purchases.payment_type")
            ->orderByDesc("purchases.id")
            ->get();
        return $expenses;
    }

    public function headings(): array
    {
        return [__("dash.date"),__("dash.license"),__("auth.name"),__("auth.lastname"),__("dash.kilometer"),__("dash.liter"),__("dash.amount"),__("dash.payment")];
    }
}
