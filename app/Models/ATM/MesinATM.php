<?php

namespace App\Models\ATM;

use App\Models\ATM\Accounts\RekeningDasar;

class MesinATM
{
    private string $lokasiATM;
    private array $logTransaksi = [];
    public function __construct(string $lokasi)
    {
        $this->lokasiATM = $lokasi;
    }
    // POLYMORPHISME: method ini bekerja untuk Tabungan, Giro, maupun Deposito
    public function prosesSetor(RekeningDasar $rekening, float $jumlah): void
    {
        echo "<br> ATM {$this->lokasiATM} — SETORAN\n";
        $berhasil = $rekening->setor($jumlah);
        $status = $berhasil ? "BERHASIL" : "GAGAL";
        echo " {$status} setor Rp " . number_format($jumlah, 0, ',', '.') . " ke rekening {$rekening->getNama()} ({$rekening->getJenisRekening()})<br>";
        echo " Saldo kini: Rp " . number_format($rekening->getSaldo(), 0, ',', '.') . "<br>";
    }
    // POLYMORPHISME: tarik() dipanggil secara polimorfik — tiap rekening punya aturan sendiri
    public function prosesTarik(RekeningDasar $rekening, float $jumlah): void
    {
        echo "<br> ATM {$this->lokasiATM} — PENARIKAN\n";
        $berhasil = $rekening->tarik($jumlah);
        $status = $berhasil ? "BERHASIL" : "GAGAL";
        echo " {$status} tarik Rp " . number_format($jumlah, 0, ',', '.') . " dari rekening {$rekening->getNama()} ({$rekening->getJenisRekening()})<br>";
        echo " Saldo kini: Rp " . number_format($rekening->getSaldo(), 0, ',', '.') . "<br>";
    }
    public function tampilkanRiwayat(RekeningDasar $rekening): void
    {
        echo "<br>Riwayat Transaksi — {$rekening->getNama()} (No. {$rekening->getNomorRekening()})\n";
        foreach ($rekening->getRiwayat() as $log) {
            echo " {$log}<br>";
        }
    }
}
