# KPI DASHBOARD
## Sistem Informasi Perpustakaan

### 1. Pendahuluan

KPI Dashboard merupakan alat untuk memantau dan mengevaluasi kualitas serta kinerja Sistem Informasi Perpustakaan berdasarkan indikator yang telah ditentukan. Pengukuran dilakukan berdasarkan hasil pengujian sistem, sehingga dapat diketahui bagian yang sudah memenuhi target dan bagian yang masih membutuhkan perbaikan.

### 2. Indikator Pengukuran Kinerja

Berikut adalah indikator yang digunakan untuk mengevaluasi Sistem Informasi Perpustakaan.

| No. | Indikator | Keterangan |
|---|---|---|
| 1 | Test Pass Rate | Persentase test case yang berhasil dibandingkan seluruh test case yang dijalankan. |
| 2 | Defect Removal Efficiency (DRE) | Persentase defect yang berhasil ditemukan dan diselesaikan sebelum sistem diterapkan. |
| 3 | Defect Density | Jumlah defect dibandingkan dengan ukuran kode program. |
| 4 | Code Coverage | Persentase kode program yang tercakup dalam pengujian. |
| 5 | Requirement Coverage | Persentase kebutuhan sistem yang sudah diuji. |
| 6 | Average Response Time | Rata-rata waktu respons aplikasi berdasarkan pengujian. |
| 7 | P95 Response Time | Nilai waktu respons persentil ke-95 sesuai metode pengukuran yang digunakan. |
| 8 | Availability / Reliability | Tingkat ketersediaan dan keberhasilan sistem ketika digunakan. |

### 3. Tujuan Pengukuran KPI

Pengukuran KPI bertujuan untuk:

1. Mengetahui tingkat keberhasilan pengujian sistem.
2. Mengidentifikasi jumlah dan tingkat permasalahan pada aplikasi.
3. Mengukur performa aplikasi ketika digunakan.
4. Mengetahui cakupan pengujian terhadap kode dan kebutuhan sistem.
5. Menjadi dasar dalam menentukan prioritas perbaikan aplikasi.

### 4. Tabel Hasil Pengukuran KPI

Tabel berikut digunakan untuk mencatat hasil pengukuran kinerja Sistem Informasi Perpustakaan berdasarkan indikator KPI yang telah ditentukan.

| No. | Indikator | Hasil Pengukuran | Keterangan |
|---|---|---|---|
| 1 | Test Pass Rate | 100% (11 dari 11 test case yang telah dijalankan) | Sementara, 2 test case SYS belum diuji |
| 2 | Defect Removal Efficiency (DRE) | 100% (3 dari 3 defect berhasil diperbaiki) | Seluruh defect berhasil diperbaiki dan lolos retest V2 |
| 3 | Defect Density | 0,386 defect/KLOC (3 defect / 7,782 KLOC) | Dihitung berdasarkan 3 defect yang ditemukan dan 7.782 baris kode PHP |
| 4 | Code Coverage | Belum diukur | Terdapat 21 pengujian otomatis yang PASS, tetapi ekstensi Xdebug/PCOV belum tersedia sehingga persentase Code Coverage belum dapat dihitung |
| 5 | Requirement Coverage | Belum dihitung | Terdapat 6 fitur utama yang telah diidentifikasi. Pemetaan seluruh kebutuhan terhadap test case masih perlu diverifikasi |
| 6 | Average Response Time | 4,306 detik | Tidak memenuhi target kurang dari 2 detik |
| 7 | P95 Response Time | 6,73 detik (nilai terbesar dari 10 sampel) | Tidak memenuhi target kurang dari 3 detik |
| 8 | Availability / Reliability | Belum tersedia data pengukuran | Belum diukur |

### 5. Evaluasi Hasil KPI

Berdasarkan hasil pengukuran sementara, aspek performa Sistem Informasi Perpustakaan belum mencapai target yang telah ditentukan.

Rata-rata waktu respons aplikasi sebesar 4,306 detik, sedangkan targetnya kurang dari 2 detik. Nilai terbesar dari 10 sampel sebesar 6,73 detik, sedangkan targetnya kurang dari 3 detik.

Sementara itu, indikator lainnya masih memerlukan data tambahan dari hasil pengujian dan pencatatan defect agar dapat dihitung secara akurat.

Oleh karena itu, diperlukan pengumpulan data pengujian secara lengkap sebelum evaluasi KPI akhir dilakukan.

### 6. Analisis Pareto

#### 6.1 Tujuan Analisis

Analisis Pareto dilakukan untuk mengetahui kategori defect yang ditemukan selama pengujian Sistem Informasi Perpustakaan. Analisis ini menggunakan tiga defect yang tercatat pada Defect Log, yaitu DEF-001, DEF-002, dan DEF-003.

#### 6.2 Data Defect

| No. | ID Defect | Kategori Masalah | Severity | Jumlah |
|---|---|---|---|---:|
| 1 | DEF-001 | Kategori dan ketersediaan data buku | Medium | 1 |
| 2 | DEF-002 | Pembatalan pengajuan peminjaman | Medium | 1 |
| 3 | DEF-003 | Tampilan gambar sampul buku | Low | 1 |
| | **Total** | | | **3** |

#### 6.3 Perhitungan Pareto

Persentase defect dihitung menggunakan rumus:

Persentase = (Jumlah defect kategori / Total defect) × 100%

| Kategori Masalah | Jumlah Defect | Persentase | Persentase Kumulatif |
|---|---:|---:|---:|
| Kategori dan ketersediaan data buku | 1 | 33,33% | 33,33% |
| Pembatalan pengajuan peminjaman | 1 | 33,33% | 66,67% |
| Tampilan gambar sampul buku | 1 | 33,33% | 100% |
| **Total** | **3** | **100%** | **100%** |

#### 6.4 Hasil Analisis

Berdasarkan hasil perhitungan, terdapat tiga kategori masalah dengan jumlah defect yang sama, yaitu masing-masing satu defect atau 33,33%.

Tidak terdapat satu kategori masalah yang lebih dominan dibandingkan kategori lainnya. Oleh karena itu, ketiga kategori defect perlu mendapatkan perhatian dalam proses evaluasi sistem.

Seluruh defect telah diperbaiki pada aplikasi Web V2 dan berhasil melalui pengujian ulang.

#### 6.5 Kesimpulan

Hasil Analisis Pareto menunjukkan bahwa defect pada Sistem Informasi Perpustakaan tersebar secara merata pada tiga kategori masalah. Oleh karena itu, perbaikan dilakukan terhadap seluruh defect, bukan hanya satu kategori tertentu.

### 7. Analisis 5 Whys

#### 7.1 Tujuan

Analisis 5 Whys digunakan untuk mencari akar penyebab dari masalah yang ditemukan selama pengujian Sistem Informasi Perpustakaan. Analisis dilakukan terhadap tiga defect yang ditemukan pada aplikasi Web V1.

#### 7.2 Analisis DEF-001

**Masalah:** Kategori religi dan biografi tidak memiliki data buku.

1. Mengapa kategori religi dan biografi tidak memiliki data buku?  
   Karena data buku pada kedua kategori tersebut tidak tersedia.
2. Mengapa data buku tidak tersedia?  
   Karena data buku belum dimasukkan atau belum terhubung dengan kategori tersebut.
3. Mengapa data buku belum terhubung?  
   Karena pengelolaan data kategori dan buku belum berjalan sesuai kebutuhan.
4. Mengapa pengelolaan data belum berjalan sesuai kebutuhan?  
   Karena proses pemeriksaan kelengkapan data belum optimal.
5. Mengapa pemeriksaan kelengkapan data belum optimal?  
   Karena belum ada pemeriksaan menyeluruh terhadap data setiap kategori sebelum sistem diuji.

**Akar penyebab sementara:** Pemeriksaan kelengkapan dan keterhubungan data buku dengan kategori belum dilakukan secara menyeluruh.

#### 7.3 Analisis DEF-002

**Masalah:** Pengajuan peminjaman yang sudah dilakukan tidak dapat dibatalkan.

1. Mengapa pengajuan peminjaman tidak dapat dibatalkan?  
   Karena fungsi pembatalan pengajuan belum berjalan.
2. Mengapa fungsi pembatalan belum berjalan?  
   Karena proses pembatalan belum ditangani dengan benar oleh sistem.
3. Mengapa proses pembatalan belum ditangani dengan benar?  
   Karena alur pembatalan belum berjalan sesuai kebutuhan pengguna.
4. Mengapa alur pembatalan belum sesuai kebutuhan?  
   Karena pengujian terhadap proses pembatalan belum mencakup seluruh kondisi yang diperlukan.
5. Mengapa pengujian belum mencakup seluruh kondisi?  
   Karena skenario pengujian pembatalan belum dirancang secara menyeluruh.

**Akar penyebab sementara:** Skenario pengujian dan pemeriksaan alur pembatalan peminjaman belum menyeluruh.

#### 7.4 Analisis DEF-003

**Masalah:** Gambar sampul buku tidak tampil pada daftar buku dan katalog.

1. Mengapa gambar sampul buku tidak tampil?  
   Karena gambar tidak berhasil ditampilkan pada halaman daftar buku dan katalog.
2. Mengapa gambar tidak berhasil ditampilkan?  
   Karena pemanggilan atau lokasi gambar belum sesuai.
3. Mengapa pemanggilan atau lokasi gambar belum sesuai?  
   Karena pengelolaan file gambar belum berjalan dengan benar.
4. Mengapa pengelolaan file gambar belum berjalan dengan benar?  
   Karena pemeriksaan tampilan gambar belum dilakukan secara menyeluruh.
5. Mengapa pemeriksaan belum dilakukan secara menyeluruh?  
   Karena skenario pengujian tampilan gambar belum mencakup seluruh halaman yang menggunakan gambar sampul.

**Akar penyebab sementara:** Pemeriksaan lokasi file dan pengujian tampilan gambar pada setiap halaman belum menyeluruh.

#### 7.5 Kesimpulan Analisis 5 Whys

Berdasarkan analisis terhadap tiga defect, ditemukan beberapa kemungkinan akar penyebab, yaitu pemeriksaan kelengkapan data yang belum menyeluruh, pengujian alur pembatalan peminjaman yang belum lengkap, serta pemeriksaan tampilan gambar yang belum mencakup seluruh halaman.

Analisis ini menjadi bahan evaluasi untuk meningkatkan kualitas Sistem Informasi Perpustakaan. Ketiga defect telah diperbaiki pada V2 dan berhasil melalui pengujian ulang.

**Catatan:** Akar penyebab di atas merupakan analisis sementara berdasarkan gejala defect. Sesuaikan dengan penyebab teknis sebenarnya jika sudah diketahui dari kode atau proses perbaikannya.

### 8. Rekomendasi Perbaikan

Berdasarkan hasil pengujian, Analisis Pareto, dan Analisis 5 Whys, terdapat beberapa rekomendasi untuk meningkatkan kualitas Sistem Informasi Perpustakaan.

| No. | Permasalahan | Rekomendasi Perbaikan | Prioritas | Status |
|---|---|---|---|---|
| 1 | Kategori religi dan biografi tidak memiliki data buku | Memastikan setiap kategori memiliki data buku yang sesuai dan melakukan pemeriksaan kelengkapan data. | Tinggi | Selesai pada V2 |
| 2 | Pengajuan peminjaman tidak dapat dibatalkan | Memastikan fungsi pembatalan pengajuan berjalan sesuai kebutuhan pengguna dan melakukan pengujian ulang. | Tinggi | Selesai pada V2 |
| 3 | Gambar sampul buku tidak tampil pada daftar buku dan katalog | Memeriksa lokasi file gambar dan memastikan gambar dapat ditampilkan pada seluruh halaman terkait. | Sedang | Selesai pada V2 |
| 4 | Waktu respons sistem belum memenuhi target | Melakukan evaluasi performa dan optimasi sistem agar rata-rata waktu respons kurang dari 2 detik dan p95 kurang dari 3 detik. | Tinggi | Perlu Perbaikan |

#### 8.1 Kesimpulan Rekomendasi

Berdasarkan hasil evaluasi, tiga defect yang ditemukan pada aplikasi Web V1 telah berhasil diperbaiki pada aplikasi Web V2 dan dinyatakan lolos pengujian ulang.

Namun, hasil pengujian performa masih belum memenuhi target yang ditetapkan. Rata-rata waktu respons sebesar 4,306 detik dan p95 sebesar 6,73 detik masih berada di atas target. Oleh karena itu, optimasi performa menjadi prioritas perbaikan berikutnya.

Rekomendasi ini diharapkan dapat meningkatkan kualitas, keandalan, dan kenyamanan penggunaan Sistem Informasi Perpustakaan.