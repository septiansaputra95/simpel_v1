<?php
namespace App\Repositories;
namespace App\Imports;

use App\Models\farmasi_konsumsi; // Sesuaikan dengan model yang digunakan
use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FarmasiKonsumsiImport implements ToModel
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
            // 'data_id' => $this->dataId, // Menggunakan nilai data_id dari variabel
            // 'document_no' => $row['Document No'],
            // 'consumed_date' => $row['Consumed Date'],
            // 'department' => $row['Department'],
            // 'store_name' => $row['Store Name'],
            // 'mrn' => $row['MRN'],
            // 'visit_no' => $row['Visit No'],
            // 'patient_name' => $row['Patient Name'],
            // 'gender' => $row['Gender'],
            // 'age' => $row['Age'],
            // // 'admitting_doctor' => $row['Age'],
            // // 'treating_doctor' => $row['Age'],
            // 'document_type' => $row['Document Type'],
            // 'item_type' => $row['Item Type'],
            // 'item_category' => $row['Item Category'],
            // 'item_code' => $row['Item Code'],
            // 'item_name' => $row['Item Name'],
            // 'batch_no' => $row['Batch No.'],
            // 'qty' => $row['Qty'],
            // 'uom' => $row['UOM'],
            // 'cost_rate' => $row['Cost Rate'],
            // 'cost_value' => $row['Cost Value'],
            // 'sales_rate' => $row['Sales Rate'],
            // 'discount_amount' => $row['Discount Amount'],
            // //'net_sale_value' => $row['Tax Amount'],
            // 'tax_amount' => $row['Tax Amount'],
            // 'sales_value' => $row['Sales Value'],
            // // 'vendor' => $row['Age'],
            // // 'consumed_time' => $row['Age'],
            // // 'visit_type' => $row['Age'],
            // 'tanggalinput' => date('Y-m-d h:s:i')       

            'document_no' => $row['0'],
            'consumed_date' => $row['1'],
            'department' => $row['2'],
            'store_name' => $row['3'],
            'mrn' => $row['4'],
            'visit_no' => $row['5'],
            'patient_name' => $row['6'],
            'gender' => $row['7'],
            'age' => $row['8'],
            'admitting_doctor' => $row['9'],
            'treating_doctor' => $row['10'],
            'document_type' => $row['11'],
            'item_type' => $row['12'],
            'item_category' => $row['13'],
            'item_code' => $row['14'],
            'item_name' => $row['15'],
            'batch_no' => $row['    16'],
            'qty' => $row['17'],
            'uom' => $row['18'],
            'tanggalinput' => date('Y-m-d h:s:i') 

        ]);
    }
}
