<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Bank Mandiri',
                'logo' => 'mandiri.svg',
                'type' => 'Virtual Account (VA)',
                'code' => 'MANDIRI',
            ],
            [
                'name' => 'CIMB Niaga',
                'logo' => 'cimb.svg',
                'type' => 'Virtual Account (VA)',
                'code' => 'CIMB',
            ],
            [
                'name' => 'Bank Syariah Indonesia',
                'logo' => 'bsi.svg',
                'type' => 'Virtual Account (VA)',
                'code' => 'BSI',
            ],
            [
                'name' => 'Bank Rakyat Indonesia',
                'logo' => 'bri.svg',
                'type' => 'Virtual Account (VA)',
                'code' => 'BRI',
            ],
            [
                'name' => 'Bank Negara Indonesia',
                'logo' => 'bni.svg',
                'type' => 'Virtual Account (VA)',
                'code' => 'BNI',
            ],
            [
                'name' => 'Bank Central Asia',
                'logo' => 'bca.svg',
                'type' => 'Virtual Account (VA)',
                'code' => 'BCA',
            ],
        ];

        foreach ($data as $item) {
            PaymentMethod::create($item);
        }
    }
}
