<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // return Brand::all();
        return Result::select("title","result_date","reference_number","prize1","prize2","prize3","special1","special2","special3","special4","special5","special6","special7","special8","special9","special10","consolation1","consolation2","consolation3","consolation4","consolation5","consolation6","consolation7","consolation8","consolation9","consolation10")->get();
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Title","Result date","Reference number","Prize1","Prize2","Prize3","Special1","Special2","Special3","Special4","Special5","Special6","Special7","Special8","Special9","Special10","Consolation1","Consolation2","Consolation3","Consolation4","Consolation5","Consolation6","Consolation7","Consolation8","Consolation9","Consolation10"];
    }
}