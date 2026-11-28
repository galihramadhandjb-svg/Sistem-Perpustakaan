# QUALITY CHECKLIST ISO/IEC 25010
## Sistem Informasi Perpustakaan

### 1. Pendahuluan

Quality Checklist merupakan daftar pemeriksaan yang digunakan untuk mengevaluasi kualitas aplikasi Sistem Informasi Perpustakaan berdasarkan standar ISO/IEC 25010. Evaluasi ini dilakukan untuk mengetahui sejauh mana aplikasi memenuhi kebutuhan pengguna dari segi fungsi, kinerja, kemudahan penggunaan, keandalan, dan keamanan.

### 2. Tujuan

Tujuan pembuatan Quality Checklist adalah:
1. Mengidentifikasi karakteristik kualitas aplikasi berdasarkan ISO/IEC 25010.
2. Menentukan indikator yang dapat digunakan untuk mengukur kualitas aplikasi.
3. Menetapkan target kualitas yang ingin dicapai.
4. Menjadi dasar evaluasi kualitas aplikasi sebelum implementasi atau Go-Live.

### 3. Quality Checklist Product Quality

| No. | Karakteristik | Indikator Pengukuran | Target SMART |
|---|---|---|---|
| 1 | Functional Suitability | Persentase fungsi aplikasi yang berjalan sesuai kebutuhan | 100% fungsi utama yang diuji berjalan sesuai test case. |
| 2 | Performance Efficiency | Rata-rata waktu respons dan persentil ke-95 (p95) | Rata-rata waktu respons dan p95 kurang dari 3 detik pada pengujian kinerja. |
| 3 | Usability | Persentase keberhasilan pengguna dalam menyelesaikan tugas | Minimal 90% tugas pengujian berhasil diselesaikan pengguna. |
| 4 | Reliability | Persentase transaksi yang berhasil diproses tanpa kegagalan | Minimal 99% dari 100 percobaan transaksi berhasil tanpa error. |
| 5 | Security | Persentase skenario akses tidak sah yang berhasil ditolak | 100% skenario akses tidak sah yang diuji berhasil ditolak sistem. |

### 4. Quality Checklist Quality in Use

| No. | Karakteristik | Indikator Pengukuran | Target SMART |
|---|---|---|---|
| 1 | Effectiveness | Persentase keberhasilan pengguna dalam menyelesaikan tugas perpustakaan dengan benar | Minimal 90% tugas yang diberikan kepada pengguna berhasil diselesaikan dengan benar selama pengujian UAT. |

### 5. Metode Pengukuran

Metode pengukuran yang digunakan dalam evaluasi kualitas aplikasi adalah sebagai berikut:

**A. Functional Suitability**

Persentase fungsi berhasil = (Jumlah fungsi yang berhasil / Jumlah seluruh fungsi yang diuji) × 100%.

**B. **Performance Efficiency (Efisiensi Kinerja)**

- Indikator 1: Rata-rata waktu respons aplikasi.
- Target SMART: Rata-rata waktu respons kurang dari 2 detik berdasarkan 10 kali pengujian menggunakan Chrome DevTools Network.

- Indikator 2: P95 waktu respons aplikasi.
- Target SMART: Nilai P95 kurang dari 3 detik berdasarkan 10 kali pengujian, dengan menggunakan nilai terbesar dari 10 sampel sesuai instruksi SYS-03.

**C. Usability**

Persentase keberhasilan tugas = (Jumlah tugas yang berhasil diselesaikan / Jumlah seluruh tugas) × 100%.

**D. Reliability**

Persentase keberhasilan transaksi = (Jumlah transaksi berhasil / Jumlah seluruh percobaan transaksi) × 100%.

**E. Security**

Persentase penolakan akses tidak