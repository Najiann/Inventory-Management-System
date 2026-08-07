# Product Requirement Document (PRD)

# Inventory Management System
Version: 1.0 (MVP)
Target Release: 31 August 2026

---

# 1. Product Overview
## Product Name
Inventory Management System

## Description
Inventory Management System adalah aplikasi berbasis web yang digunakan untuk membantu perusahaan dalam mengelola data barang, kategori barang, transaksi barang masuk, transaksi barang keluar, serta memantau ketersediaan stok secara terstruktur.

## Background
Banyak perusahaan masih melakukan pencatatan inventory secara manual menggunakan spreadsheet atau pencatatan fisik.

Hal tersebut dapat menyebabkan beberapa masalah:
- Kesalahan pencatatan jumlah stok.
- Sulit mengetahui riwayat keluar masuk barang.
- Tidak adanya informasi siapa yang melakukan perubahan stok.
- Risiko kehilangan barang karena tidak adanya audit trail.

## Problem Statement
Perusahaan membutuhkan sistem yang dapat mencatat seluruh aktivitas inventory agar data barang lebih akurat, transparan, dan mudah dipantau.

## Goal
Membangun sistem inventory berbasis Laravel yang mampu:
- Mengelola data barang.
- Mengelola kategori barang.
- Mencatat transaksi barang masuk dan keluar.
- Menyediakan riwayat transaksi.
- Menyediakan laporan inventory.
- Membatasi akses pengguna berdasarkan role.

---

# 2. Target User
Sistem memiliki dua jenis pengguna.

## 2.1 Admin
Admin bertanggung jawab dalam pengelolaan sistem dan data inventory.

### Responsibilities
- Mengelola data barang.
- Mengelola kategori barang.
- Melihat seluruh transaksi.
- Melihat laporan inventory.

### Permission

## Product Management
Create:
- Menambahkan barang baru.

Read:
- Melihat daftar barang.

Update:
- Mengubah informasi barang.

Delete:
- Menghapus barang.


## Category Management
Create:
- Membuat kategori baru.

Read:
- Melihat kategori.

Update:
- Mengubah kategori.

Delete:
- Menghapus kategori.


## Transaction
Read Only:
- Melihat riwayat barang masuk.
- Melihat riwayat barang keluar.

## Report
Read Only:
- Melihat laporan inventory.

---

# 2.2 Staff Gudang
Staff Gudang bertanggung jawab terhadap aktivitas operasional barang.

### Responsibilities
- Melakukan pencatatan barang masuk.
- Melakukan pencatatan barang keluar.
- Memastikan transaksi inventory tercatat.

### Permission

## Product
Read Only:
- Melihat daftar barang.

## Stock In
Create:
- Membuat transaksi barang masuk.

## Stock Out
Create:
- Membuat transaksi barang keluar.

## Transaction History
Read:
- Melihat transaksi yang dilakukan.

---

# 3. Product Scope

## Inventory Type
Sistem digunakan untuk mengelola inventory perusahaan IT / Office Equipment.

Contoh barang:

### Laptop
- Lenovo ThinkPad
- MacBook

### Monitor
- Dell Monitor
- LG Monitor

### Peripheral
- Mouse
- Keyboard
- Headset

### Network Equipment
- Router
- Switch

---

# 4. Core Features

# 4.1 Authentication
User dapat:
- Register.
- Login.
- Logout.

Sistem akan mengarahkan user ke dashboard sesuai role.

Flow:

User Login

↓

System Check Role

↓

Admin Dashboard / Staff Dashboard

---

# 4.2 Dashboard

## Admin Dashboard
Menampilkan:
- Total barang.
- Total kategori.
- Jumlah transaksi.
- Barang dengan stok rendah.
- Transaksi terbaru.

## Staff Dashboard
Menampilkan:
- Daftar barang.
- Barang masuk terbaru.
- Barang keluar terbaru.

---

# 4.3 Product Management
Admin dapat mengelola data barang.

Data barang:
- Nama barang.
- SKU / kode barang.
- Kategori.
- Harga.
- Stok.
- Kondisi barang.
- Lokasi penyimpanan.
- Deskripsi.
- Foto barang.

---

# 4.4 Category Management
Admin dapat mengelola kategori barang.

Contoh kategori:
- Laptop.
- Monitor.
- Peripheral.
- Network Equipment.

---

# 4.5 Stock In
Digunakan ketika barang masuk ke perusahaan.

Flow:

Staff memilih barang.

↓

Input jumlah barang.

↓

System membuat transaksi IN.

↓

Stock barang bertambah.


Contoh:

Sebelum:
Laptop Lenovo
Stock: 10

Transaksi:
IN +5

Setelah:
Laptop Lenovo
Stock: 15

---

# 4.6 Stock Out
Digunakan ketika barang keluar.

Flow:

Staff memilih barang.

↓

Input jumlah barang.

↓

System melakukan validasi stok.

↓

Jika stok cukup:

Create transaksi OUT.

↓

Stock berkurang.


Contoh:

Sebelum:
Laptop Lenovo
Stock: 15

Transaksi:
OUT -2

Setelah:
Laptop Lenovo
Stock: 13

---

# 4.7 Transaction History
Sistem menyimpan seluruh aktivitas perubahan stok.

Data transaksi:
- Barang.
- User yang melakukan transaksi.
- Jenis transaksi (IN/OUT).
- Jumlah.
- Tanggal.
- Keterangan.

Tujuan:
- Audit trail.
- Monitoring aktivitas pengguna.
- Mengurangi risiko kehilangan barang.

---

# 4.8 Report
Admin dapat melihat laporan inventory.

Informasi:
- Total barang.
- Riwayat transaksi.
- Barang masuk.
- Barang keluar.
- Pergerakan stok.

Report bersifat:
Read Only.

---

# 5. Business Rules

## Rule 1
Setiap perubahan stok harus melalui transaksi.

## Rule 2
Staff tidak dapat mengubah stok secara langsung.

## Rule 3
Stock In akan menambah jumlah stok.

## Rule 4
Stock Out akan mengurangi jumlah stok.

## Rule 5
Setiap transaksi harus memiliki informasi user yang melakukan aksi.

## Rule 6
Admin memiliki akses penuh terhadap pengelolaan master data.

---

# 6. Non Functional Requirements

## Security
- Authentication diperlukan untuk mengakses sistem.
- User hanya dapat mengakses fitur sesuai role.

## Performance
- Sistem mampu menangani proses CRUD inventory.
- Database memiliki struktur yang terorganisir.

## Maintainability
- Menggunakan struktur Laravel MVC.
- Code mengikuti standar Laravel.

## Deployment
Application akan dideploy menggunakan Fly.io.

---

# 7. Future Development

## Version 1.1
Improvement:
- Export PDF.
- Export Excel.
- Advanced search.
- Better dashboard.

## Version 1.2
Inventory Enhancement:
- Supplier Management.
- Purchase Order.
- Barcode Generator.

## Version 2.0
Advanced Inventory:
- Multi Warehouse.
- Stock Transfer.
- Approval System.

## Version 3.0
Integration:
- REST API.
- Mobile Application.
- AI Stock Prediction.

---

# 8. Success Criteria
MVP dianggap selesai apabila:
- User dapat login sesuai role.
- Admin dapat mengelola barang dan kategori.
- Staff dapat melakukan transaksi inventory.
- Sistem dapat menghitung perubahan stok.
- Riwayat transaksi tersimpan.
- Dashboard dapat menampilkan informasi inventory.
- Aplikasi berhasil dideploy ke Fly.io.
- Dokumentasi project lengkap.