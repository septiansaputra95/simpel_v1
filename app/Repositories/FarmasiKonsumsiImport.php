<?php
namespace App\Repositories;
namespace App\Imports;

use App\FarmasiKonsumsi; // Sesuaikan dengan model yang digunakan
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FarmasiKonsumsiImport implements ToModel, WithHeadingRow
{
    protected $dataId; // Variabel untuk menyimpan data_id

    public function __construct($dataId)
    {
        $this->dataId = $dataId;
    }

    public function model(array $row)
    {
        // Transformasi data dari array Excel ke dalam format yang sesuai
        return new FarmasiKonsumsi([
            'data_id' => $this->dataId, // Menggunakan nilai data_id dari variabel
            'document_no' => $row['Document No'],
            'consumed_date' => $row['Consumed Date'],
            'department' => $row['Department'],
            'store_name' => $row['Store Name'],
            'mrn' => $row['MRN'],
            'visit_no' => $row['Visit No'],
            'patient_name' => $row['Patient Name'],
            'gender' => $row['Gender'],
            'age' => $row['Age'],
            // 'admitting_doctor' => $row['Age'],
            // 'treating_doctor' => $row['Age'],
            'document_type' => $row['Document Type'],
            'item_type' => $row['Item Type'],
            'item_category' => $row['Item Category'],
            'item_code' => $row['Item Code'],
            'item_name' => $row['Item Name'],
            'batch_no' => $row['Batch No.'],
            'qty' => $row['Qty'],
            'uom' => $row['UOM'],
            'cost_rate' => $row['Cost Rate'],
            'cost_value' => $row['Cost Value'],
            'sales_rate' => $row['Sales Rate'],
            'discount_amount' => $row['Discount Amount'],
            //'net_sale_value' => $row['Tax Amount'],
            'tax_amount' => $row['Tax Amount'],
            'sales_value' => $row['Sales Value'],
            // 'vendor' => $row['Age'],
            // 'consumed_time' => $row['Age'],
            // 'visit_type' => $row['Age'],
            'tanggalinput' => date('Y-m-d h:s:i')       

        ]);
    }
}
