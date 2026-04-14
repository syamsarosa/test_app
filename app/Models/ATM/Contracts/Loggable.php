<?php

namespace App\Models\ATM\Contracts;

interface Loggable
{
    public function getRiwayat(): array;
    public function tambahLog(string $pesan): void;
}
