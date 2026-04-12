<?php
include('../controllers/authCheck.php');
include('../config/koneksi.php');

$id_res = $_GET['id'];
// Mengambil data tagihan dari tbl_pembayaran
$query = $conn->query("SELECT r.kode_reservasi, p.* FROM tbl_reservasi r 
                       JOIN tbl_pembayaran p ON r.id = p.id_reservasi 
                       WHERE r.id = '$id_res'");
$data = $query->fetch_assoc();

$sisa_tagihan = $data['total'] - $data['bayar']; // Menghitung sisa yang belum dibayar

$title = 'Input Pelunasan';
include('../layout/index.php');
?>

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-yellow-400">
            Pelunasan: <?php echo $data['kode_reservasi']; ?>
        </h2>

        <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 border-t-4 border-blue-500">
            <form action="../controllers/proses_pelunasan.php" method="POST">
                <input type="hidden" name="id_reservasi" value="<?php echo $id_res; ?>">
                <input type="hidden" id="sisa_tagihan_val" name="sisa_tagihan" value="<?php echo $sisa_tagihan; ?>">
                <input type="hidden" name="total_awal" value="<?php echo $data['total']; ?>">

                <div class="grid gap-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Tagihan: <strong>Rp <?php echo number_format($data['total']); ?></strong></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">DP (Sudah Masuk): <strong class="text-green-600">Rp <?php echo number_format($data['bayar']); ?></strong></p>
                        <p class="text-lg font-bold text-red-600 mt-2">Sisa Harus Bayar: Rp <?php echo number_format($sisa_tagihan); ?></p>
                    </div>

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Uang Tunai dari Pelanggan</span>
                        <input type="number" id="input_bayar" name="jumlah_bayar" min="<?php echo $sisa_tagihan; ?>" required
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 form-input border p-2 rounded-lg"
                            placeholder="Masukkan nominal uang...">
                    </label>

                    <div id="info_kembalian" class="hidden p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                        <p class="text-sm font-semibold text-yellow-700 dark:text-yellow-200">
                            Kembalian: <span id="text_kembalian">Rp 0</span>
                        </p>
                    </div>

                    <button type="submit" name="simpan_pelunasan" 
                        class="w-full mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                        Proses & Simpan Pelunasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    const inputBayar = document.getElementById('input_bayar');
    const sisaTagihan = parseInt(document.getElementById('sisa_tagihan_val').value);
    const infoKembalian = document.getElementById('info_kembalian');
    const textKembalian = document.getElementById('text_kembalian');

    inputBayar.addEventListener('input', function() {
        const nominalMasuk = parseInt(this.value) || 0;
        
        if (nominalMasuk > sisaTagihan) {
            const hitungKembalian = nominalMasuk - sisaTagihan;
            infoKembalian.classList.remove('hidden');
            textKembalian.innerText = 'Rp ' + hitungKembalian.toLocaleString('id-ID');
        } else {
            infoKembalian.classList.add('hidden');
        }
    });
</script>