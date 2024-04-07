<x-index-layout>
    <div class="flex justify-center">
        <h1 class="mt-6 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            My books
        </h1>
    </div>

    <div class="mt-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8">
            @foreach ($books as $book)
                <a href="{{route('book.detail', ['id' => $book->id])}}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="justify-center">
                        <div role="status" class=" mb-4 md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
                            <div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded    dark:bg-gray-700">
                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                {{$book->transaction_type}}
                            </span>

                            <h2 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">
                                {{$book->title}}
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                {{$book->description}}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-index-layout>


