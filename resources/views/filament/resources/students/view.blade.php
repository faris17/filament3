<x-filament-panels::page>
    {{-- <x-filament::card>
        <div class="flex">
            <div class="w-1/2 bg-white p-6 rounded shadow">
                <h1 class="text-xl font-semibold mb-4">Profil Siswa</h1>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">NIS:</p>
                        <p class="font-semibold">{{ $this->data->nis }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nama:</p>
                        <p class="font-semibold">John Doe</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Jenis Kelamin:</p>
                        <p class="font-semibold">Laki-laki</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Tanggal Lahir:</p>
                        <p class="font-semibold">10 Januari 2005</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-600">Alamat:</p>
                        <p class="font-semibold">Jl. Jalan Raya No. 123</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Kontak:</p>
                        <p class="font-semibold">081234567890</p>
                    </div>
                </div>
            </div>
            <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
                <h1 class="text-xl font-semibold mb-4">Profil Orang Tua</h1>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Nama Ayah:</p>
                        <p class="font-semibold">John Doe Sr.</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Nama Ibu:</p>
                        <p class="font-semibold">Jane Doe</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-600">Alamat:</p>
                        <p class="font-semibold">Jl. Jalan Raya No. 123</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Kontak Ayah:</p>
                        <p class="font-semibold">081234567891</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Kontak Ibu:</p>
                        <p class="font-semibold">081234567892</p>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::card> --}}


    @if ($this->hasInfolist())
        {{ $this->infolist }}
    @else
        {{ $this->form }}
    @endif

    {{-- @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers
            :active-manager="$activeRelationManager"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        />
    @endif --}}
</x-filament-panels::page>
