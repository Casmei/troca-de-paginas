<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 focus:outline-none focus:ring-1 focus:ring-white focus:ring-offset-1 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
