<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionNotification extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_notifications';

    /**
     * Get the transacation notification of the book.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Get the transacation notification of the book.
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function hasTransactionNotification(string $logged_user): bool
    {
        $books = Book::all()->where('owner_id', $logged_user);

        foreach ($books as $book) {
            return !!$book->transactionNotifications->where('status', "not_viewed")->isNotEmpty();
        }

        return false;
    }
}
