<div class="grid gap-6">
    <!-- Nickname Field -->
    <div>
        <flux:input
            wire:model.defer="form.nickname"
            :label="__('Nickname')"
            type="text"
            required
            autofocus
            placeholder="Nickname"
        />
        @error('form.nickname') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Avatar Image Select Field -->
    <div>
        <flux:input
            wire:model.defer="form.avatar"
            :label="__('Avatar Image')"
            type="file"
        />
        @error('form.avatar') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Newsletter Checkbox -->
    <div>
        <flux:input
            wire:model.defer="form.newsletter"
            :label="__('Subscribe to Newsletter')"
            type="checkbox"
        />
    </div>

    <!-- Terms Checkbox -->
    <div>
        <flux:input
            wire:model.defer="form.terms"
            :label="__('I agree to the Terms and Conditions')"
            type="checkbox"
            required
        />
        @error('form.terms') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>