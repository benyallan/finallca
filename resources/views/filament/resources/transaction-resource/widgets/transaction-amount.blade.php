<x-filament::widget :amount="$amount">
    <x-filament::card>
        <b>Total: </b><span style="color: {{ $amount >= 0 ? 'green' : 'red' }}">{{ $amount }}</span>
    </x-filament::card>
</x-filament::widget>
