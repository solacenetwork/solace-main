<div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">{{ $stepMessage }}</h2>

    @if ($showFormData)
        @include('partials.form-data')
    @else
        @include('partials.success')
    @endif
</div>