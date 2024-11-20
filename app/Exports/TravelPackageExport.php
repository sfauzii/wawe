<?php

namespace App\Exports;

use App\Models\TravelPackage;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TravelPackageExport implements FromView, ShouldAutoSize
{




    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        $packages = TravelPackage::with(['galleries'])
            ->withCount(['transactions as sales' => function ($query) {
                $query->where('transaction_status', 'SUCCESS');
            }])
            ->withSum(['transactions as total_sales_rupiah' => function ($query) {
                $query->where('transaction_status', 'SUCCESS');
            }], 'grand_total')
            ->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
            ->get();

        return view('pages.admin.report.travel-package.excel', [
            'packages' => $packages,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
    }
}
