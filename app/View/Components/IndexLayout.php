<?php

namespace App\View\Components;

use App\Models\TransactionNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class IndexLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $hasTransactionNotification = false;

        if (Auth::check()) {
            $hasTransactionNotification = (new TransactionNotification())->hasTransactionNotification(Auth::id());
        }

        return view('layouts.index', [
            'hasTransactionNotification' => $hasTransactionNotification
        ]);
    }
}
