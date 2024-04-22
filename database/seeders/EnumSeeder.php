<?php

namespace Database\Seeders;

use App\Enums\TypeEnum;
use App\Models\Enum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Enum::query()->create([
            'name' => 'Dihuni',
            'key' => 1,
            'value' => 'DIHUNI',
            'type' => TypeEnum::HOUSE_STATUS,
            'description' => 'Unit tersebut dihuni.'
        ]);

        Enum::query()->create([
            'name' => 'Tidak Dihuni',
            'key' => 2,
            'value' => 'TIDAK_DIHUNI',
            'type' => TypeEnum::HOUSE_STATUS,
            'description' => 'Unit tersebut tidak dihuni.'
        ]);

        Enum::query()->create([
            'name' => 'Tetap',
            'key' => 1,
            'value' => 'TETAP',
            'type' => TypeEnum::HOUSEHOLDER_STATUS,
            'description' => 'Status unit adalah tetap.'
        ]);

        Enum::query()->create([
            'name' => 'Kontrak',
            'key' => 2,
            'value' => 'KONTRAK',
            'type' => TypeEnum::HOUSEHOLDER_STATUS,
            'description' => 'Unit tersebut dalam status kontrak.'
        ]);

        Enum::query()->create([
            'name' => 'Lunas',
            'key' => 1,
            'value' => 'LUNAS',
            'type' => TypeEnum::TRANSACTION_STATUS,
            'description' => 'Pembayaran telah lunas.'
        ]);

        Enum::query()->create([
            'name' => 'Belum Lunas',
            'key' => 2,
            'value' => 'BELUM_LUNAS',
            'type' => TypeEnum::TRANSACTION_STATUS,
            'description' => 'Pembayaran belum lunas.'
        ]);

        Enum::query()->create([
            'name' => 'Satpam',
            'key' => 1,
            'value' => 'SATPAM',
            'type' => TypeEnum::BILLING_STATUS,
            'description' => 'Departemen Satpam.'
        ]);

        Enum::query()->create([
            'name' => 'Kebersihan',
            'key' => 2,
            'value' => 'KEBERSIHAN',
            'type' => TypeEnum::BILLING_STATUS,
            'description' => 'Departemen Kebersihan.'
        ]);

        Enum::query()->create([
            'name' => 'Lain-lain',
            'key' => 3,
            'value' => 'LAIN_LAIN',
            'type' => TypeEnum::BILLING_STATUS,
            'description' => 'Kategori lainnya.'
        ]);

        Enum::query()->create([
            'name' => 'Bulanan',
            'key' => 1,
            'value' => 'BULANAN',
            'type' => TypeEnum::TYPE_TRANSACTION,
            'description' => 'Pembayaran bulanan.'
        ]);

        Enum::query()->create([
            'name' => 'Tahunan',
            'key' => 2,
            'value' => 'TAHUNAN',
            'type' => TypeEnum::TYPE_TRANSACTION,
            'description' => 'Pembayaran tahunan.'
        ]);

        Enum::query()->create([
            'name' => 'Pengeluaran',
            'key' => 1,
            'value' => 'PENGELUARAN',
            'type' => TypeEnum::EXPENSE_TYPE,
            'description' => 'Transaksi pengeluaran.'
        ]);
    }
}
