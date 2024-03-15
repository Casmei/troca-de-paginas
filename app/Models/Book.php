<?php

namespace App\Models;

use App\Events\TransactionRequested;
use App\Events\TransactionRequestedEvent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\ValidationException;

class Book extends Model
{
    use HasFactory;

    /**
     * Get the user of the book.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get all transactions of the book.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'book_id');
    }

    /**
     * Get all transaction notifications of the book.
     */
    public function transactionNotifications(): HasMany
    {
        return $this->hasMany(TransactionNotification::class, 'book_id');
    }

    /**
     * Get the books that are avaliable for transactions.
     */
    public function getBooksAvaliableForTransactions(): Collection
    {
        // Obtenha os IDs de todos os livros que estão em transações com status 'pending'
        $booksInPendingTransactionsIds = Transaction::where('status', 'pending')
            ->pluck('book_id');

        // Obtenha todos os livros que não estão em transações com status 'pending'
        return Book::whereNotIn('id', $booksInPendingTransactionsIds)->get();
    }

    public function userHasAlreadyRequestedTransaction(string $requester_id, string $book_id): bool
    {
        $transactionNotifications = Book::find($book_id)->transactionNotifications()->where('requester_id', $requester_id)->get();
        return $transactionNotifications->isNotEmpty();
    }

    public function isSameOwnerRequester(string $requesterId, string $bookId): bool
    {
        $book = Book::find($bookId);
        return $book->owner->id == $requesterId;
    }

    public function createTransactionNotificationToOwner(string $requesterId, string $bookId): void
    {
        if ($this->userHasAlreadyRequestedTransaction($requesterId, $bookId)) {
            throw ValidationException::withMessages(['Livro já solicitado para transacao']);
        }

        if ($this->isSameOwnerRequester($requesterId, $bookId)) {
            throw ValidationException::withMessages(['O dono nao pode solicitar o mesmo livro']);
        }

        $transactionNotification = new TransactionNotification();
        $transactionNotification->requester_id = $requesterId;
        $transactionNotification->book_id = $bookId;
        $transactionNotification->status = 'not_viewed';
        $transactionNotification->save();
    }
}
