<?php

namespace App\Models\ATM\Accounts;

use App\Models\ATM\Contracts\Printable;

class RekeningTabungan extends RekeningDasar implements Printable
{
    protected float $saldoMinimum = 50000;
    public function tarik(float $jumlah): bool
    {
        if (($this->saldo - $jumlah) < $this->saldoMinimum) {
            $this->tambahLog("Gagal tarik: saldo minimum");
            return false;
        }
        $this->saldo -= $jumlah;
        $this->tambahLog("Tarik Rp " . number_format($jumlah));
        return true;
    }
    public function getJenisRekening(): string
    {
        return 'Tabungan';
    }
    public function cetakStruk(): string
    {
        return "<br>--- STRUK TABUNGAN ---<br>"
            . "Saldo : Rp " . number_format($this->saldo, 0, ',', '.') . "<br>"
            . "---------------------<br>";
    }
}
