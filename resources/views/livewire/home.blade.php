<div>
    {{-- Be like water. --}}
    @if (session()->has('message'))
        <div class="flex-col">
            <div class='text-2xl'>
                {{ session('message') }}
            </div>
            <button type='button' wire:click="delSession" class="mt-4 bg-gray-500 w-40 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                New Register
            </button>
        </div>

    @else
        <form method="post" wire:submit="save">
            {{ $this->form }}
            <button type='submit' class="mt-4 bg-green-500 w-40 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Save
            </button>
        </form>
    @endif

</div>
