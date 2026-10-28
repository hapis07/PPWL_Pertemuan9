<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $status = ['Menunggu', 'Diterima', 'Ditolak'];
        $metode = ['Transfer Bank', 'Tunai', 'QRIS'];

        for ($i = 1; $i <= 20; $i++) {
            $tanggalBayar = fake()->dateTimeBetween('-30 days', 'now');
            $statusPembayaran = $status[($i - 1) % 3];

            Pembayaran::create([
                'id_iuran' => $i,
                'tanggal_bayar' => $tanggalBayar,
                'nominal' => fake()->numberBetween(10000, 100000),
                'metode' => $metode[($i - 1) % 3],
                'bukti_bayar' => null,
                'status_verifikasi' => $statusPembayaran,
                'diverifikasi_oleh' => $statusPembayaran === 'Menunggu' ? null : 1,
                'tanggal_verifikasi' => $statusPembayaran === 'Menunggu'
                    ? null
                    : fake()->dateTimeBetween($tanggalBayar, 'now'),
            ]);
        }
    }
}