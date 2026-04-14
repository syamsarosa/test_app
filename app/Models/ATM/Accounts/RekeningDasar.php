<?php

namespace App\Models\ATM\Accounts;

use App\Models\ATM\Contracts\Transactable;
use App\Models\ATM\Contracts\Loggable;

abstract class RekeningDasar implements Transactable, Loggable
{
    protected int $nomorRekening;
    protected string $namaNasabah;
    protected float $saldo;
    protected array $riwayat = [];
    public function __construct(
        int $nomorRekening,
        string $namaNasabah,
        float $saldoAwal = 0
    ) {
        $this->nomorRekening = $nomorRekening;
        $this->namaNasabah = $namaNasabah;
        $this->saldo = $saldoAwal;
        $this->tambahLog("Rekening dibuka. Saldo awal Rp " . number_format($saldoAwal));
    }
    public function getNama(): string
    {
        return $this->namaNasabah;
    }
    public function getNomorRekening(): int
    {
        return $this->nomorRekening;
    }
    public function getSaldo(): float
    {
        return $this->saldo;
    }
    public function getRiwayat(): array
    {
        return $this->riwayat;
    }
    public function tambahLog(string $pesan): void
    {
        $this->riwayat[] = "<br>[" . now()->setTimezone('Asia/Jakarta')->format('H:i:s') . "] " .
            $pesan . "<br>";
    }
    public function setor(float $jumlah): bool
    {
        if ($jumlah <= 0) {
            $this->tambahLog("Gagal setor: jumlah tidak valid");
            return false;
        }
        $this->saldo += $jumlah;
        $this->tambahLog("Setor Rp " . number_format($jumlah));
        return true;
    }
    abstract public function tarik(float $jumlah): bool;
    abstract public function getJenisRekening(): string;
}
