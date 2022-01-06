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
            ->select("purchases.p_date","vehicles.registration_plate","users.name","users.lastname","purchases.km","purchases.litre","purchases.price","purchases.payment_type")
            ->orderByDesc("purchases.id")
            ->get();
        return $expenses;
    }

    public function headings(): array
    {
        return ["Tarih","Plaka","Ad","Soyad","Kilometre","Yakıt(Litre)","Tutar","Ödeme"];
    }
}
