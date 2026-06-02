@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h2 class="text-3xl font-bold mb-2 text-gray-900">Ajukan Peminjaman</h2>
            <p class="text-gray-600 mb-6">Lengkapi form di bawah untuk mengajukan peminjaman barang</p>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <ul class="text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Barang -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Pilih Barang <span class="text-red-500">*</span></label>
                    <select name="id_barang" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($peralatans as $barang)
                            <option value="{{ $barang->id }}" {{ old('id_barang') == $barang->id ? 'selected' : '' }}>
                                {{ $barang->nama_peralatan }} (Kondisi: {{ $barang->kondisi }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Pinjam -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Pinjam <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>

                <!-- Tanggal Kembali -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Estimasi Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Opsional - Anda bisa update tanggal kembali nanti</p>
                </div>

                <!-- Evidence/Bukti Pinjam -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Upload Bukti Peminjaman <span class="text-red-500">*</span></label>
                    <p class="text-sm text-gray-600 mb-3">Upload foto KTM, Surat Izin, atau dokumen resmi sebagai bukti peminjaman</p>

                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer group"
                        onclick="document.getElementById('evidence_foto').click()">
                        <input type="file" id="evidence_foto" name="evidence_foto" accept="image/*" class="hidden" required
                            onchange="updateFileName(this)">

                        <div class="group-hover:text-blue-600 transition">
                            <div class="text-4xl mb-2">📸</div>
                            <p class="font-medium text-gray-700">Klik atau seret file di sini</p>
                            <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, JPEG | Max 2MB</p>
                        </div>

                        <p class="text-sm text-gray-600 mt-3" id="fileName">Belum ada file dipilih</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('user.dashboard') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="font-semibold text-blue-900 mb-2">ℹ️ Informasi Penting</h3>
            <ul class="text-sm text-blue-900 space-y-1">
                <li>✓ Peminjaman akan diverifikasi oleh Admin terlebih dahulu</li>
                <li>✓ Silakan upload dokumen pendukung untuk mempercepat persetujuan</li>
                <li>✓ Pastikan data yang Anda masukkan sudah benar</li>
                <li>✓ Hubungi Admin jika ada pertanyaan</li>
            </ul>
        </div>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = input.files[0]?.name || 'Belum ada file dipilih';
    document.getElementById('fileName').textContent = fileName;
}
</script>
@endsection
