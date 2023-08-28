<x-filament-panels::page>
    <form method="post" wire:submit="save">
        {{ $this->form }}
        <button type='submit' class="mt-4 bg-green-500 w-40 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Save
        </button>
    </form>

</x-filament-panels::page>

