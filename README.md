# Sistem Informasi Akademik Sederhana (Siakad)

Tugas Besar Mata Kuliah Web II (IF53413)

## a. Deskripsi Aplikasi
Aplikasi Siakad ini dirancang untuk mengelola data akademik secara efisien. Fitur utama aplikasi meliputi manajemen data Dosen, Mahasiswa, Mata Kuliah, Jadwal Perkuliahan, dan Kartu Rencana Studi (KRS). Sistem ini memungkinkan mahasiswa untuk memilih mata kuliah sesuai KRS dan melihat jadwal perkuliahan yang relevan secara dinamis.

## b. Fungsi Halaman

* **Halaman Login:** Akses masuk ke sistem menggunakan email dan password terdaftar.

* **Manajemen Data (Admin):**
  * **Data Dosen:** Mengelola (Tambah, Edit, Hapus) data dosen termasuk NIDN dan Nama.
  * **Data Mahasiswa:** Mengelola data mahasiswa termasuk NPM dan keterikatan dengan Dosen Pembimbing.
  * **Data Mata Kuliah:** Mengelola daftar mata kuliah, kode, dan SKS.
  * **Data Jadwal:** Mengatur jadwal perkuliahan, kelas, hari, dan jam mengajar.

* **Kartu Rencana Studi (Mahasiswa):**
  * Memilih dan menambah mata kuliah untuk semester berjalan.
  * Melihat total SKS yang diambil.
  * Menghapus (drop) mata kuliah yang salah input.
  * Mencetak KRS dalam format PDF.

* **Jadwal Perkuliahan (Mahasiswa):**
  * Menampilkan jadwal kuliah harian yang difilter otomatis berdasarkan mata kuliah yang telah diambil pada KRS.

## c. Folder Screenshot
Struktur direktori untuk gambar screenshot halaman aplikasi:

```text
📁 screenshots/
 ├── 📄 login.png
 ├── 📄 krs.png
 ├── 📄 jadwal.png
 └── 📄 dll
```
 

## d. Link Hosting
Aplikasi dapat diakses dengan URL berikut:
* **URL Aplikasi:** 

## e. Akun Untuk Tes
Role admin:
admin@gmail.com
sandi : password

Role mahasiswa:
mahasiswa@gmail.com
sandi : password