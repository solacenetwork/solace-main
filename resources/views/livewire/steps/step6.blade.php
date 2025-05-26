<div class="grid gap-6">
    
    <!-- Nickname Field -->
    <div>
        <x-label for="nickname" value="{{ __('Nickname') }}" />
        <x-input
            id="nickname"
            wire:model.live="form.nickname"
            class="block mt-1 w-full"
            type="text"
            placeholder="{{ __('Nickname') }}"
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
            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('form.avatar') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Newsletter Checkbox -->
    <div class="flex items-center">
        <x-checkbox
            id="newsletter"
            wire:model.live="form.newsletter"
        />
        <label for="newsletter" class="ms-2 text-sm text-gray-600">{{ __('Subscribe to Newsletter') }}</label>
    </div>

    <!-- Terms Checkbox -->
    <div class="flex items-center">
        <x-checkbox
            id="terms"
            wire:model.live="form.terms"
            required
        />
        <label for="terms" class="ms-2 text-sm text-gray-600">{{ __('I agree to the Terms and Conditions') }}</label>
        @error('form.terms') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

</div>