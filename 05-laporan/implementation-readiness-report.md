# IMPLEMENTATION READINESS REPORT
## Sistem Informasi Perpustakaan

### 1. Kriteria Go/No-Go

Kriteria Go/No-Go digunakan untuk menentukan apakah Sistem Informasi Perpustakaan sudah siap diterapkan atau masih membutuhkan perbaikan. Penilaian dilakukan berdasarkan hasil pengujian sistem, performa, keamanan, dan kesiapan pengguna.

| No. | Kriteria | Target Keberhasilan | Bukti Pengujian |
|---|---|---|---|
| 1 | Pengujian fungsional | Seluruh fungsi utama berjalan sesuai kebutuhan | Hasil System Testing |
| 2 | Pengujian integrasi | Minimal 90% skenario integrasi berhasil | Hasil Integration Testing |
| 3 | Performa sistem | Rata-rata waktu respons dan p95 kurang dari 3 detik | Hasil Performance Testing |
| 4 | Keamanan sistem | Seluruh skenario akses tanpa izin berhasil ditolak | Hasil Security Testing |
| 5 | Kemudahan penggunaan | Minimal 90% tugas pengguna berhasil diselesaikan | Hasil Usability Testing |
| 6 | Penerimaan pengguna | Minimal 90% kriteria penerimaan terpenuhi | Hasil User Acceptance Testing |

### 2. Dasar Penilaian

Setiap kriteria akan dibandingkan dengan hasil pengujian yang telah dilakukan. Jika seluruh kriteria penting terpenuhi dan tidak terdapat masalah kritis, sistem dapat dipertimbangkan untuk diterapkan.

Apabila masih terdapat kekurangan yang tidak bersifat kritis, penerapan dapat dipertimbangkan dengan status Conditional Go. Namun, jika ditemukan masalah kritis yang dapat mengganggu fungsi utama atau keamanan sistem, penerapan harus ditunda.

### 3. Keputusan Implementasi

Berdasarkan hasil pengujian sementara, keputusan implementasi Sistem Informasi Perpustakaan adalah **Conditional Go**.

Keputusan ini diambil karena sebagian pengujian masih perlu dievaluasi, khususnya pada aspek performa sistem. Hasil pengujian menunjukkan rata-rata waktu respons sebesar 4,306 detik dan p95 sebesar 6,73 detik, sedangkan target yang ditetapkan adalah kurang dari 3 detik.

Sebelum sistem diterapkan secara penuh, perlu dilakukan beberapa tindakan perbaikan, yaitu:

1. Melakukan evaluasi terhadap penyebab lambatnya waktu respons sistem.
2. Mengoptimalkan proses dan fungsi yang membutuhkan waktu pemrosesan lama.
3. Melakukan pengujian ulang terhadap performa sistem setelah perbaikan.
4. Memastikan seluruh fungsi utama dan aspek keamanan berjalan dengan baik.

**Alasan Pemilihan Conditional Go:**

Sistem dapat dilanjutkan ke tahap persiapan implementasi, tetapi peluncuran secara penuh harus menunggu sampai masalah performa diperbaiki dan kriteria penting lainnya dinyatakan memenuhi target.

### 4. Strategi Peralihan Sistem

Strategi peralihan sistem yang digunakan dalam penerapan Sistem Informasi Perpustakaan adalah metode **Parallel**.

Metode Parallel merupakan strategi penerapan dengan menjalankan sistem lama dan sistem baru secara bersamaan dalam periode tertentu. Strategi ini dipilih untuk mengurangi risiko gangguan pelayanan apabila sistem baru mengalami masalah.

**Tahapan Pelaksanaan:**

1. Mempersiapkan Sistem Informasi Perpustakaan yang akan diterapkan.
2. Memasukkan dan memeriksa data yang dibutuhkan ke dalam sistem baru.
3. Menjalankan sistem lama dan sistem baru secara bersamaan.
4. Membandingkan hasil pencatatan dan transaksi dari kedua sistem.
5. Memastikan fungsi utama sistem baru berjalan dengan baik.
6. Menghentikan penggunaan sistem lama setelah sistem baru dinyatakan stabil dan siap digunakan.

**Alasan Pemilihan Strategi:**

Metode Parallel dipilih karena dapat mengurangi risiko kehilangan data dan gangguan pelayanan perpustakaan. Selain itu, petugas dapat membandingkan hasil kerja kedua sistem sebelum sepenuhnya beralih menggunakan sistem baru.

### 5. Rencana Konversi Data dan Pelatihan Pengguna

#### 5.1 Rencana Konversi Data

Konversi data merupakan proses pemindahan data dari sistem lama atau pencatatan manual ke dalam Sistem Informasi Perpustakaan yang baru.

Tahapan konversi data yang direncanakan adalah:

1. Mengidentifikasi data yang dibutuhkan, seperti data buku, anggota, peminjaman, dan pengembalian.
2. Memeriksa kelengkapan dan keakuratan data sebelum dipindahkan.
3. Memasukkan data ke dalam database Sistem Informasi Perpustakaan.
4. Memeriksa kembali data yang telah dimasukkan untuk memastikan tidak terjadi kesalahan.
5. Melakukan pencadangan data sebagai langkah antisipasi apabila terjadi masalah.

#### 5.2 Rencana Pelatihan Pengguna

Pelatihan dilakukan agar petugas perpustakaan dapat memahami dan menggunakan sistem dengan baik.

Kegiatan pelatihan meliputi:

1. Pengenalan fitur dan fungsi utama aplikasi.
2. Pelatihan pengelolaan data buku dan anggota.
3. Pelatihan proses peminjaman dan pengembalian buku.
4. Pelatihan penggunaan fitur pencarian dan pengelolaan laporan.
5. Simulasi penggunaan sistem untuk memastikan pengguna memahami alur kerja aplikasi.

**Tujuan Pelatihan:**

Meningkatkan kemampuan pengguna dalam mengoperasikan Sistem Informasi Perpustakaan sehingga proses pengelolaan data dan pelayanan perpustakaan dapat berjalan dengan lebih efektif dan teratur.

### 6. Rencana Rollback

Rencana rollback merupakan langkah untuk mengembalikan proses operasional ke sistem sebelumnya apabila Sistem Informasi Perpustakaan yang baru mengalami gangguan atau tidak dapat digunakan dengan baik.

**Kondisi yang Memerlukan Rollback:**

1. Sistem mengalami gangguan yang menyebabkan aplikasi tidak dapat diakses.
2. Terjadi kesalahan pada data buku, anggota, peminjaman, atau pengembalian.
3. Fitur utama sistem tidak dapat berjalan sesuai kebutuhan.
4. Terjadi masalah keamanan yang membahayakan data perpustakaan.

**Langkah-Langkah Rollback:**

1. Menghentikan sementara penggunaan sistem baru.
2. Mengidentifikasi masalah yang menyebabkan gangguan.
3. Mengaktifkan kembali sistem lama atau pencatatan manual.
4. Memeriksa dan memulihkan data menggunakan cadangan yang tersedia.
5. Memastikan data dan transaksi yang telah dilakukan tetap tercatat dengan benar.
6. Melakukan pengujian dan perbaikan sebelum sistem baru digunakan kembali.

**Tujuan Rollback:**

Rollback bertujuan menjaga kelangsungan pelayanan perpustakaan, mengurangi risiko kehilangan data, dan memastikan aktivitas peminjaman serta pengembalian buku tetap dapat berjalan ketika sistem baru mengalami masalah.

### 7. Go-Live Checklist

Go-Live Checklist digunakan untuk memeriksa kesiapan Sistem Informasi Perpustakaan sebelum diterapkan.

| No. | Daftar Pemeriksaan | Status |
|---|---|---|
| 1 | Sistem dapat diakses melalui browser | Sudah |
| 2 | Login dan logout berjalan dengan baik | Sudah |
| 3 | Pengelolaan data buku berjalan dengan baik | Sudah |
| 4 | Pengelolaan data anggota berjalan dengan baik | Sudah |
| 5 | Proses peminjaman dan pengembalian berjalan dengan baik | Sudah |
| 6 | Database telah diperiksa dan dicadangkan | Sudah |
| 7 | Pengujian keamanan telah dilakukan | Sudah |
| 8 | Pengujian performa memenuhi target rata-rata kurang dari 2 detik dan P95 kurang dari 3 detik | Belum Terpenuhi |
| 9 | Panduan penggunaan sistem telah disiapkan | Sudah |
| 10 | Rencana rollback telah disiapkan | Sudah |

**Catatan:** Status Sudah pada nomor 1–5 berlaku jika fungsi-fungsi tersebut memang sudah diuji dan berhasil.

### 8. Kesimpulan Kesiapan Implementasi

Berdasarkan hasil pengujian dan pemeriksaan kesiapan implementasi, Sistem Informasi Perpustakaan memperoleh keputusan sementara **Conditional Go**.

Keputusan tersebut diambil karena sebagian besar persiapan telah dilakukan, tetapi pengujian performa belum memenuhi target yang ditentukan.

Hasil pengujian menunjukkan rata-rata waktu respons sebesar 4,306 detik dan nilai maksimum dari 10 sampel sebesar 6,73 detik. Sementara itu, target yang ditetapkan adalah rata-rata kurang dari 2 detik dan nilai maksimum kurang dari 3 detik.

Oleh karena itu, diperlukan perbaikan performa dan pengujian ulang sebelum sistem diterapkan secara penuh.