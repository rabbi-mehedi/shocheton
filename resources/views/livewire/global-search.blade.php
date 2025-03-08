<div class="flex items-center justify-center w-full max-w-lg mx-auto mb-8">
    <div class="relative w-full">
        <div class="shadow-md rounded-full overflow-hidden">
            <!-- Debounce for 300ms -->
            <input
                type="text"
                placeholder="Search by Name, Location, Details..."
                wire:model.debounce.300ms="searchTerm"
                class="w-full py-3 px-5 pr-16 text-gray-700 bg-white border-none focus:outline-none focus:ring-2 focus:ring-red-400 rounded-full"
            >
            <button
                wire:click="goToSearchPage"
                class="absolute inset-y-0 right-0 flex items-center justify-center bg-red-600 text-white px-4 m-1 rounded-full hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400"
            >
                Search
            </button>
        </div>
    </div>
</div>
