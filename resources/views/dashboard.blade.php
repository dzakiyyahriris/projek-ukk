<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard User Tiket Asyik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-indigo-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292m0 0v5.526m0 0H7.5M16.5 12H12m0 0H7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            
                            <div>
                                <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                                    Total Pengguna Terdaftar
                                </div>
                                
                                <div class="text-3xl font-bold text-gray-900">
                                    {{ $totalPenggunaTerdaftar ?? 0 }} 
                                </div>
                                <p class="text-xs text-gray-400 mt-1">
                                    Pengguna dengan peran 'user'
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Total Acara Aktif
                        </div>
                        <div class="text-3xl font-bold text-gray-300">
                            0
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            Perlu ditambahkan kodingan di Controller
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Pesanan Baru
                        </div>
                        <div class="text-3xl font-bold text-gray-300">
                            0
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            Perlu ditambahkan kodingan di Controller
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>