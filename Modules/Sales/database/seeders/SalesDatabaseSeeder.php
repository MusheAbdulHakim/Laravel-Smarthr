<?php

namespace Modules\Sales\Database\Seeders;

use Modules\Sales\Models\Tax;
use Illuminate\Database\Seeder;

class SalesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tax::insert([
            [
                'name' => 'VAT',
                'percentage' => 14,
                'active' => true
            ],
            [
                'name' => 'GST',
                'percentage' => 30,
                'active' => true
            ],
        ]);
        // $this->call([]);
    }
}
