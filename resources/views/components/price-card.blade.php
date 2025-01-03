<div x-data
    {{ $attributes->merge(['class' => 'w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8']) }}>
    <h5 class="mb-4 text-xl font-medium text-gray-500">{{ $title }}</h5>

    @if ($originalPrice !== $discountPrice)
        <div class="flex items-baseline text-gray-400">
            <span class="text-lg font-semibold">Rp.</span>
            <span
                class="text-2xl font-extrabold tracking-tight line-through">{{ number_format($originalPrice, 0, ',', '.') }}</span>
        </div>
    @endif

    <div class="flex items-baseline text-gray-900">
        <span class="text-3xl font-semibold">Rp.</span>
        <span class="text-5xl font-extrabold tracking-tight">{{ number_format($discountPrice, 0, ',', '.') }}</span>
    </div>

    <ul role="list" class="space-y-5 my-7">
        @foreach ($includedFeatures as $feature)
            <li class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 text-blue-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="text-base font-normal leading-tight text-gray-500 ms-3">{{ $feature }}</span>
            </li>
        @endforeach

        @foreach ($excludedFeatures as $feature)
            <li class="flex items-center opacity-50">
                <svg class="flex-shrink-0 w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span
                    class="text-base font-normal leading-tight text-gray-400 line-through ms-3">{{ $feature }}</span>
            </li>
        @endforeach
    </ul>

    <button type="button" data-modal-target="{{ $modalTarget }}" data-modal-toggle="{{ $modalTarget }}"
        @click="handleClickPaket"
        class="text-white {{ $buttonClass }} focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center ">
        {{ $buttonText }}
    </button>
</div>

@pushOnce('scripts')
    <script>
        function handleClickPaket(e) {
            console.log(document.getElementById('{{ $modalTarget }}').querySelector('input[name=paket]').value);
            
            document.getElementById('{{ $modalTarget }}').querySelector('input[name=paket]').value = e.target.parentElement.querySelector('h5').innerText;
            
            const custom = e.target.parentElement.getAttribute('data-custom');
            const nama_paket = e.target.parentElement.getAttribute('data-nama-paket');
            const form = document.getElementById('{{ $modalTarget }}').querySelector('form');
            if(custom) {
                document.getElementById('nama-dinamis').innerText = custom;
            }

            if (nama_paket) {
                let input = form.querySelector('input[name=nama_paket]');

                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'nama_paket';
                    form.appendChild(input);
                }

                input.value = nama_paket;   
            }
        }
    </script>
@endPushOnce
