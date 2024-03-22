<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch the product data from the database with eager loading of departments, groups, and sub-groups
        return Product::with('department', 'subGroup')->get()->map(function ($product) {
            return [
                'department_title' => optional($product->department)->department_title,
                'si_upc' => $product->si_upc,
                'barcode_sku' => $product->barcode_sku,
                'product_name' => $product->product_name,
                'product_description' => $product->product_description,
                'packsize' => $product->packsize,
                'unit_price' => $product->unit_price,
                'case_price' => $product->case_price,
                'rsp' => $product->rsp,
                'vat' => $product->vat,
                'por' => $product->por,
                'bcqty_1' => $product->bcqty_1,
                'bcp_1' => $product->bcp_1,
                'por_1' => $product->por_1,
                'bcqty_2' => $product->bcqty_2,
                'bcp_2' => $product->bcp_2,
                'por_2' => $product->por_2,
                'bcqty_3' => $product->bcqty_3,
                'bcp_3' => $product->bcp_3,
                'por_3' => $product->por_3,
            ];
        });
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the column headings for the Excel file
        return [
            'department_title',
            'si_upc',
            'barcode_sku',
            'product_name',
            'product_description',
            'packsize',
            'unit_price',
            'case_price',
            'rsp',
            'vat',
            'por',
            'bcqty_1',
            'bcp_1',
            'por_1',
            'bcqty_2',
            'bcp_2',
            'por_2',
            'bcqty_3',
            'bcp_3',
            'por_3',
        ];
    }
}
