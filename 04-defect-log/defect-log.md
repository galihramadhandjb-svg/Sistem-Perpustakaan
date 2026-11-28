# DEFECT LOG
## Sistem Informasi Perpustakaan

### 1. Pendahuluan

Defect Log merupakan dokumentasi masalah atau kesalahan yang ditemukan selama proses pengujian Sistem Informasi Perpustakaan. Pengujian awal dilakukan menggunakan aplikasi Web V1 untuk memperoleh evidence INT, SYS, dan UAT. Defect yang ditemukan kemudian diperbaiki pada aplikasi Web V2.

Dokumen ini digunakan untuk mencatat defect, proses perbaikan, dan hasil pengujian ulang pada V2.

### 2. Daftar Defect

| ID Defect | Modul/Kategori | Deskripsi Defect | Terkait TC | Severity | Penanggung Jawab | Versi Ditemukan | Versi Perbaikan | Status |
|---|---|---|---|---|---|---|---|---|
| DEF-001 | Kategori Buku | Kategori religi dan biografi tidak memiliki data buku. | TC-12 | Medium | Galih | V1 | V2 | Fixed |
| DEF-002 | Peminjaman | Pengajuan peminjaman yang sudah dilakukan tidak dapat dibatalkan. | TC-13 | Medium | Galih | V1 | V2 | Fixed |
| DEF-003 | Katalog Buku | Gambar sampul buku tidak tampil pada daftar buku dan katalog. | TC-14 | Low | Galih | V1 | V2 | Fixed |

### 3. Detail Perbaikan Defect

**DEF-001 – Kategori religi dan biografi tidak memiliki data buku**
- Versi ditemukan: V1
- Severity: Medium
- Penanggung jawab: Galih
- Terkait: TC-12
- Perbaikan: Dilakukan pada V2.
- Status: Fixed.

**DEF-002 – Pengajuan peminjaman tidak dapat dibatalkan**
- Versi ditemukan: V1
- Severity: Medium
- Penanggung jawab: Galih
- Terkait: TC-13
- Perbaikan: Dilakukan pada V2.
- Status: Fixed.

**DEF-003 – Gambar sampul buku tidak tampil**
- Versi ditemukan: V1
- Severity: Low
- Penanggung jawab: Galih
- Terkait: TC-14
- Perbaikan: Dilakukan pada V2.
- Status: Fixed.

### 4. Ringkasan Defect

| Keterangan | Jumlah |
|---|---:|
| Total defect ditemukan | 3 |
| Defect severity Medium | 2 |
| Defect severity Low | 1 |
| Defect severity High | 0 |
| Defect yang sudah diperbaiki | 3 |

### 5. Keterangan Status

- Open: Defect ditemukan dan belum diperbaiki.
- In Progress: Defect sedang diperbaiki.
- Fixed: Perbaikan defect sudah dilakukan.
- Retest: Defect sedang diuji ulang.
- Closed: Perbaikan telah berhasil diverifikasi melalui pengujian ulang.

### 6. Kesimpulan

Berdasarkan hasil pengujian aplikasi Web V1, ditemukan tiga defect yang terdiri dari dua defect dengan severity Medium dan satu defect dengan severity Low. Ketiga defect tersebut telah diperbaiki pada aplikasi Web V2.

Pengujian ulang perlu dilakukan untuk memastikan bahwa seluruh perbaikan berjalan sesuai harapan dan tidak menimbulkan masalah baru.

### 7. Hasil Pengujian Ulang (Retest)

Pengujian ulang dilakukan pada aplikasi Web V2 untuk memastikan bahwa perbaikan terhadap defect yang ditemukan pada V1 telah berhasil.

| ID Defect | Hasil Retest V2 | Status Akhir |
|---|---|---|
| DEF-001 | Berhasil, kategori religi dan biografi sudah memiliki data buku. | CLOSED |
| DEF-002 | Berhasil, pengajuan peminjaman sudah dapat dibatalkan. | CLOSED |
| DEF-003 | Berhasil, gambar sampul buku sudah tampil pada daftar buku dan katalog. | CLOSED |

**Kesimpulan Retest:**

Seluruh tiga defect yang ditemukan pada aplikasi Web V1 telah berhasil diperbaiki pada aplikasi Web V2. Hasil pengujian ulang menunjukkan bahwa ketiga perbaikan berjalan sesuai harapan sehingga seluruh defect dinyatakan CLOSED.