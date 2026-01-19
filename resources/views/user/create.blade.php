<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beli Tiket Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Periksa kembali inputan Anda:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pesan.store') }}" method="POST">
                    @csrf <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Pilih Wisata</label>
                        <select name="wisata_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Pilih Acara Wisata --</option>
                            @foreach($acaras as $acara)
                                <option value="{{ $acara->id_event }}">
                                    {{ $acara->nama }} (Harga: Rp {{ number_format($acara->harga ?? 50000) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Jumlah Tiket</label>
                        <input type="number" name="jumlah_tiket" min="1" value="1" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 ease-in-out shadow-md">
                            Bayar Sekarang 💳
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>