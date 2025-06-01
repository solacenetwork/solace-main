<div class="grid gap-6">
    
    <!-- Nickname Field -->
    <div>
        <x-label for="nickname" value="{{ __('Nickname') }}" />
        <x-input
            id="nickname"
            wire:model.live="form.nickname"
            class="block mt-1 w-full"
            type="text"
            placeholder="{{ __('Public Username') }}"
            required
            autofocus
        />
        @error('form.nickname') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Avatar Image Select Field -->
    <div>
        <x-label for="avatar" value="{{ __('Avatar Image') }}" />
        <input
            id="avatar"
            wire:model="form.avatar"
            type="file"
            class="block mt-1 w-full border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('form.avatar') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Newsletter Checkbox -->
    <div class="flex items-center">
        <x-checkbox
            id="newsletter"
            wire:model.live="form.newsletter"
        />
        <label for="newsletter" class="ms-2 text-sm text-gray-600">{{ __('Subscribe to the Newsletter') }}</label>
    </div>

    <!-- Terms Checkbox -->
    <div class="flex items-center">
        <x-checkbox
            id="terms"
            wire:model.live="form.terms"
            required
        />
        <label for="terms" class="ms-2 text-sm text-gray-600">
                {!! __('I agree to the <a href="/terms" target="_blank" class="text-indigo-600 hover:underline">Terms & Conditions</a>') !!}
        </label>
        <div class="pl-3">
            {{-- &#10229; is unicode long left arrow --}}
            @error('form.terms') <p class="text-sm text-red-600">&#10229; {{ $message }}</p> @enderror
        </div>    
    </div>

</div>