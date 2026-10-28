<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'status' => [
                'nullable',
                Rule::in(['Menunggu', 'Diterima', 'Ditolak']),
            ],
            'cari' => ['nullable', 'string', 'max:50'],
        ]);

        $status = $request->query('status', '');
        $kata_kunci = trim($request->query('cari', ''));

        if ($status !== '') {
            $query = Pembayaran::where('status_verifikasi', $status);
        } else {
            $query = Pembayaran::query();
        }

        if ($kata_kunci !== '') {
            $query->where('metode', 'like', '%' . $kata_kunci . '%');
        }

        $data_pembayaran = $query
            ->orderByDesc('tanggal_bayar')
            ->orderByDesc('id_pembayaran')
            ->take(5)
            ->get();

        $total_pembayaran = Pembayaran::count();
        $total_nominal = Pembayaran::sum('nominal');
        $nominal_tertinggi = Pembayaran::max('nominal');
        $nominal_terendah = Pembayaran::min('nominal');

        return view('pembayaran.index', compact(
            'data_pembayaran',
            'status',
            'kata_kunci',
            'total_pembayaran',
            'total_nominal',
            'nominal_tertinggi',
            'nominal_terendah'
        ));
    }
}