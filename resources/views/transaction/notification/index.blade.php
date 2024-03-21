<x-index-layout>
    <div class="space-y-4 items-center">
        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none  focus:outline focus:outline-2 focus:outline-red-500">
            <h2 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white mb-4">
                New Notifications
            </h2>


            <ul class="space-y-8 from-gray-700/50 via-transparent rounded-lg shadow ">
                @foreach($transactionNotifications as $transactionNotification)
                    <li class="px-6 py-4 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl rounded-lg ">
                        <div class="flex justify-between items-center   ">
                            <span class=" text-lg font-semibold text-gray-900 dark:text-white">
                                {{$transactionNotification->book->transaction_type}}
                            </span>
                            <span class="text-gray-500  ">1 day ago*</span>
                        </div>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                            <strong>{{$transactionNotification->requester->name}}</strong> is requesting your book <strong>{{$transactionNotification->book->title}}</strong>
                        </p>
                        <div class="flex mt-4 gap-2 space-x-2">

                            <x-green-button>
                                ACCEPT
                            </x-green-button>

                            <x-danger-button>
                                RECUSE
                            </x-danger-button>
                        </div>
                    </li>

                @endforeach()
            </ul>
        </div>
    </div>
</x-index-layout>
