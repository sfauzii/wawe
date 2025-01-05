<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class TransactionDetailsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $transaction;
    protected $package;
    protected $user;
    protected $transactionData;

    public function __construct($transaction, $package, $user, $transactionData)
    {
        $this->transaction = $transaction;
        $this->package = $package;
        $this->user = $user;
        $this->transactionData = $transactionData;
    }

    public function collection()
    {
        return $this->transaction->details;
    }

    public function headings(): array
    {
        return [
            'Transaction Information',
            '',
            '',
            '',
            '',
        ];
    }

    public function map($detail): array
    {
        return [
            $detail->username,
            $detail->phone,
            // Add other fields as needed
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);

        // Add transaction information
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Transaction Details Report');

        $sheet->setCellValue('A2', 'Transaction ID:');
        $sheet->setCellValue('B2', $this->transactionData['transaction_id']);

        $sheet->setCellValue('A3', 'Transaction Date:');
        $sheet->setCellValue('B3', $this->transactionData['transaction_date']);

        $sheet->setCellValue('A4', 'Customer Name:');
        $sheet->setCellValue('B4', $this->transactionData['customer_name']);

        $sheet->setCellValue('A5', 'Payment Method:');
        $sheet->setCellValue('B5', $this->transactionData['payment_method']);

        $sheet->setCellValue('A6', 'Grand Total:');
        $sheet->setCellValue('B6', $this->transactionData['grand_total']);

        $sheet->setCellValue('A7', 'Cost:');
        $sheet->setCellValue('B7', $this->transactionData['cost']);

        $sheet->setCellValue('A8', 'Profit/Loss:');
        $sheet->setCellValue('B8', $this->transactionData['profit_or_loss']);

        if ($this->transactionData['remainingFullPayment']) {
            $sheet->setCellValue('A9', 'Remaining Payment:');
            $sheet->setCellValue('B9', $this->transactionData['remainingFullPayment']);
        }

        // Style the header
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Style the information section
        $sheet->getStyle('A2:A9')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
