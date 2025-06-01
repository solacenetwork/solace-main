<div class="flex flex-col gap-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- First Name -->
        <div>
            <x-label for="first_name" value="{{ __('First Name') }}" />
            <x-input
                id="first_name"
                wire:model.live="form.first_name"
                class="block mt-1 w-full"
                type="text"
                required
                autofocus
                autocomplete="given-name"
                placeholder="First Name"
            />
            @error('form.first_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Last Name -->
        <div>
            <x-label for="last_name" value="{{ __('Last Name') }}" />
            <x-input
                id="last_name"
                wire:model.live="form.last_name"
                class="block mt-1 w-full"
                type="text"
                required
                autocomplete="family-name"
                placeholder="Last Name"
            />
            @error('form.last_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Address Line 1 -->
        <div class="col-span-2">
            <x-label for="address1" value="{{ __('Address Line 1') }}" />
            <x-input
                id="address1"
                wire:model.live="form.address1"
                class="block mt-1 w-full"
                type="text"
                required
                autocomplete="address-line1"
                placeholder="Address Line 1"
            />
            @error('form.address1') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Address Line 2 -->
        <div class="col-span-2 md:col-span-1">
            <x-label for="address2" value="{{ __('Address Line 2 (optional)') }}" />
            <x-input
                id="address2"
                wire:model.live="form.address2"
                class="block mt-1 w-full"
                type="text"
                autocomplete="address-line2"
                placeholder="Address Line 2"
            />
            @error('form.address2') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- City -->
        <div>
            <x-label for="city" value="{{ __('City') }}" />
            <x-input
                id="city"
                wire:model.live="form.city"
                class="block mt-1 w-full"
                type="text"
                required
                autocomplete="address-level2"
                placeholder="City"
            />
            @error('form.city') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- State -->
        <div>
            <x-label for="state" value="{{ __('State') }}" />
            <select
                id="state"
                wire:model.live="form.state"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required
            >
                <option value="">{{ __('Select a state') }}</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
            @error('form.state') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- ZIP -->
        <div>
            <x-label for="zip" value="{{ __('ZIP') }}" />
            <x-input
                id="zip"
                wire:model.live="form.zip"
                class="block mt-1 w-full"
                type="text"
                maxlength="10"
                required
                autocomplete="postal-code"
                placeholder="ZIP"
            />
            @error('form.zip') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Phone -->
        <div class="col-span-2">
            <x-label for="phone" value="{{ __('Phone (optional)') }}" />
            <x-input
                id="phone"
                wire:model.live="form.phone"
                class="block mt-1 w-full"
                type="text"
                autocomplete="tel"
                placeholder=""
            />
            @error('form.phone') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Date of Birth -->
        <div class="col-span-2">
            <x-label for="dob" value="{{ __('Date of Birth') }}" />
            <x-input
                id="dob"
                wire:model.live="form.dob"
                class="block mt-1 w-full"
                type="date"
                required
                autocomplete="bday"
            />
            @error('form.dob') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>