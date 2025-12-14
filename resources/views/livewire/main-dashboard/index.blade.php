<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in!") }}
            </div>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Menu Utama</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('warga.dashboard') }}" class="block p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <h4 class="font-semibold">Dashboard Warga</h4>
                        <p>Akses dashboard untuk warga</p>
                    </a>
                    <a href="{{ route('petugas.dashboard') }}" class="block p-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        <h4 class="font-semibold">Dashboard Petugas</h4>
                        <p>Akses dashboard untuk petugas</p>
                    </a>
                    <a href="{{ route('warga.laporan') }}" class="block p-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                        <h4 class="font-semibold">Buat Laporan</h4>
                        <p>Laporkan masalah sampah</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>