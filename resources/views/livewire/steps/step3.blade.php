<div class="w-full flex flex-col gap-4">
    @if ($form['account_type'] === 'single')
        @include('partials.single')
    @elseif ($form['account_type'] === 'family')
        @include('partials.family')
    @else
        <p class="text-red-600">Please select an account type in Step 2.</p>
    @endif
</div>