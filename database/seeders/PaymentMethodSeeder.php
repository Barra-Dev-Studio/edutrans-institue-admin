<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'OVO',
                'logo' => 'ovo.svg',
                'type' => 'EWALLET',
                'code' => 'ID_OVO',
            ],
            [
                'name' => 'DANA',
                'logo' => 'dana.svg',
                'type' => 'EWALLET',
                'code' => 'ID_DANA',
            ],
            [
                'name' => 'LinkAja',
                'logo' => 'linkaja.svg',
                'type' => 'EWALLET',
                'code' => 'ID_LINKAJA',
            ],
            [
                'name' => 'ShopeePay',
                'logo' => 'shopeepay.svg',
                'type' => 'EWALLET',
                'code' => 'ID_SHOPEEPAY',
            ],
            [
                'name' => 'QRIS',
                'logo' => 'qris.svg',
                'type' => 'QRIS',
                'code' => 'QRIS',
            ],
        ];

        foreach ($data as $item) {
            PaymentMethod::create($item);
        }
    }
}
