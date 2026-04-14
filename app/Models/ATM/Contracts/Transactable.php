<?php

namespace App\Models\ATM\Contracts;

interface Transactable
{
    public function setor(float $jumlah): bool;
    public function tarik(float $jumlah): bool;
    public function getSaldo(): float;
}
