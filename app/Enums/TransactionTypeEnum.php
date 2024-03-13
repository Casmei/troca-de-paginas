<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    const Donation = 'donation';
    const Borrow = 'borrow';
    const Exchange = 'exchange';
}
