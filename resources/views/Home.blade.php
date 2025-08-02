<x-layout :title="$title">

    <P>WELCOME TO MY HOME PAGE</P>
    <div class="flex mt-3">
        {{-- fungsi untuk perulangan --}}
        @for ($i = 1; $i <= 10; $i++)
            {{-- fungsi untuk kondisi --}}
            @if ($i % 2 === 0)
                <div class="w-8 h-8 bg-teal-500 text-white p-0 me-1 text-xs grid place-items-center">
                    {{ $i }}</div>
            @endif
        @endfor
    </div>
</x-layout>
