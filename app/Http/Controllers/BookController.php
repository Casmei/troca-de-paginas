<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booksAvailableForTransaction = (new Book())->getBooksAvailableForTransactions();

        return view('welcome', ['books' => $booksAvailableForTransaction]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        return view('book.detail', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function request(string $id)
    {
        try {
            if (!Auth::check()) {
                toastr()->warning('Necessário estar logado para está operação!');
                return redirect()->route('login');
            }

            $this->book->createTransaction($id);
            $user_id = Auth::id();
            Log::info("Solicitação de transação do livro '$id' pelo usuário '$user_id' realizada com sucesso!");
            toastr()->success('Empréstimo solicitado com sucesso!.');
            return redirect()->back();
        } catch (\Exception $e) {
            report($e);
            Log::error($e->getMessage());
            toastr()->error('Ocorreu um erro ao processar sua solicitação.');
            return redirect()->back();
        }
    }
}
