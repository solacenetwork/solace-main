<div class="w-full flex flex-col gap-4">
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Single Card -->
        <x-button
            wire:click="setAccountType('single')"
            class="group block w-full md:w-auto flex-1 bg-white border rounded-lg shadow-md hover:bg-gray-700 focus:outline-none normal-case {{ $form['account_type'] === 'single' ? 'border-indigo-600 ring-2 ring-indigo-400' : 'border-gray-300' }}"
        >
            <div class="p-6 text-center flex flex-col items-center">
                <x-svg name="user-single" class="w-16 h-16 mb-2 {{ $form['account_type'] === 'single' ? 'text-indigo-600' : 'text-gray-600' }} group-hover:text-white group-hover:fill-white" />
                <h2 class="text-lg font-bold {{ $form['account_type'] === 'single' ? 'text-indigo-600' : 'text-gray-900' }} group-hover:text-white">Single</h2>
                <p class="text-sm text-gray-600 group-hover:text-white">Select this option for individual accounts.</p>
                <span wire:loading wire:target="setAccountType('single')" class="inline-block w-5 h-5 border-2 border-t-indigo-600 border-r-indigo-600 border-b-transparent border-l-transparent rounded-full animate-spin"></span>
            </div>
        </x-button>

        <!-- Family Card -->
        <button
            type="button"
            disabled
            class="group block w-full md:w-auto flex-1 bg-gray-50 border border-gray-300 rounded-lg shadow-sm opacity-60 cursor-not-allowed"
        >
            <div class="p-6 text-center flex flex-col items-center">
                <x-svg name="user-family" class="w-16 h-16 mb-2 text-gray-500" />
                <h2 class="text-lg font-semibold text-gray-600">Family</h2>
                <p class="text-sm text-gray-500">Family accounts are coming soon.</p>
            </div>
        </button>
    </div>
    @error('form.account_type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
</div>