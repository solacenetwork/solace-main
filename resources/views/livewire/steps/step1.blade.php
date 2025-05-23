<div class="w-full flex flex-col gap-4">
    <!-- Email -->
    <div>
        <flux:input
            wire:model.live="form.email"
            label="{{ __('Email') }}"
            type="email"
            autofocus
            required
            autocomplete="email"
            placeholder="username@example.com"
            class="w-full"
        />
        @error('form.email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Password -->
    <div>
        <label for="password-input" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Password') }}</label>
        <div class="relative flex items-center">
            <flux:input
                wire:model.live="form.password"
                id="password-input"
                type="{{ $showPassword ? 'text' : 'password' }}"
                autocomplete="new-password"
                required
                placeholder="********"
                class="w-full rounded-r-none"
            />
            <flux:button
                type="button"
                wire:click="$toggle('showPassword')"
                aria-label="Show/Hide Password"
                color="gray"
                size="base"
                class="rounded-l-none h-[42px]"
            >
                @if($showPassword)
                    <x-svg name="eye-slash" class="w-5 h-5" />
                @else
                    <x-svg name="eye" class="w-5 h-5" />
                @endif
            </flux:button>
        </div>
        @error('form.password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password-confirm-input" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Confirm Password') }}</label>
        <div class="relative flex items-center">
            <flux:input
                wire:model.live="form.password_confirmation"
                id="password-confirm-input"
                type="{{ $showPasswordConfirm ? 'text' : 'password' }}"
                required
                autocomplete="new-password"
                placeholder="********"
                class="w-full rounded-r-none"
            />
            <flux:button
                type="button"
                wire:click="$toggle('showPasswordConfirm')"
                aria-label="Show/Hide Password"
                color="gray"
                size="base"
                class="rounded-l-none h-[42px]"
            >
                @if($showPasswordConfirm)
                    <x-svg name="eye-slash" class="w-5 h-5" />
                @else
                    <x-svg name="eye" class="w-5 h-5" />
                @endif
            </flux:button>
        </div>
        @error('form.password_confirmation') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>