<?php

namespace App\Models;

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
     * Get the books that are available for transactions.
     */
    public function getBooksAvailableForTransactions(): Collection
    {
        // Obtenha os IDs de todos os livros que estão em transações com status 'pending'
        $booksInPendingTransactionsIds = Transaction::where('status', 'pending')
            ->pluck('book_id');

        // Obtenha todos os livros que não estão em transações com status 'pending'
        return Book::whereNotIn('id', $booksInPendingTransactionsIds)->get();
    }

    public function isAvaliableBookToTransaction(string $id): bool
    {
        return Book::find($id)->first() ? true : false;
    }

    // public function createTransactionNotificationToOwner(string $owner): TransactionNotification
    // {

    // }

    public function createTransaction(string $id): void
    {
        //todo: verificar se o livro está disponivel para uma transacao
        if (!$this->isAvaliableBookToTransaction($id)) {
            throw ValidationException::withMessages(['Livro já está em uma outra transacao']);
        }
        $this->isAvaliableBookToTransaction($id);
        //todo: criar uma notificao para o usuario de livro requisitado
        //todo: bloquear o livro para novas transacoes
    }
}
