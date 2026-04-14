<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ATM\MesinATM;
use App\Models\ATM\Accounts\RekeningTabungan;
//use App\Models\ATM\Accounts\RekeningGiro;
//use App\Models\ATM\Accounts\RekeningDeposito;
class ATMController extends Controller
{
    public function demo()
    {
        $atm = new MesinATM('Mall Batam Center Lt. 1');
        $tabungan = new RekeningTabungan(1001, 'Budi', 500000);
        //$giro = new RekeningGiro (2002002, 'PT Maju Jaya', 2000000, 5000000);
        //$deposito = new RekeningDeposito(3003003, 'Dewi Rahayu', 10000000, 12, 5.5);
        // === Transaksi Tabungan ===
        $atm->prosesSetor($tabungan, 300000);
        $atm->prosesTarik($tabungan, 200000);
        $atm->prosesTarik($tabungan, 600000); // Gagal — saldo minimum
        // === Transaksi Giro ===
        //$atm->prosesSetor($giro, 1000000);
        //$atm->prosesTarik($giro, 4000000); // Boleh — pakai overdraft
        //$atm->prosesTarik($giro, 5000000); // Gagal — melebihi limit overdraft
        // === Transaksi Deposito ===
        //$atm->prosesSetor($deposito, 5000000);
        //$atm->prosesTarik($deposito, 1000000); // Gagal — belum jatuh tempo
        // === Riwayat ===
        $atm->tampilkanRiwayat($tabungan);
        //$atm->tampilkanRiwayat($giro);
        //$atm->tampilkanRiwayat($deposito);
        // === Struk (Interface Printable) ===
        echo "\n" . $tabungan->cetakStruk() . "\n";
        //echo "\n" . $giro->cetakStruk() . "\n";
        // === Info Deposito ===
        //echo "\n Estimasi bunga deposito Dewi/tahun: Rp " . number_format($deposito->hitungBunga(), 0, ',', '.') . "\n";
    }
}
