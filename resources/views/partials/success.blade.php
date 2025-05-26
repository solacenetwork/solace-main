<div class="text-center">
    <h2 class="text-2xl font-bold mb-4">Thank you for registering!</h2>
    <p class="text-gray-700 mb-6">Your registration was successful! You'll be redirected to your dashboard shortly.</p>
    <x-button
        type="button"
        wire:click="$emit('redirectToDashboard')"
        class="bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    >
        Go to Dashboard
    </x-button>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('redirectToDashboard', () => {
            window.location.href = '{{ route('dashboard') }}';
        });
    });
</script>
@endpush