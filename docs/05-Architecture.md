## Flow Sederhana
USER

 |
 | Request
 v

ROUTE
(web.php)

 |
 v

CONTROLLER

 |
 | Mengolah logic
 v

MODEL
(Eloquent)

 |
 v

DATABASE
(MySQL)

 |
 | Data kembali
 v

CONTROLLER

 |
 v

VIEW
(Blade)

 |
 v

USER

## Contoh kasus: Admin melihat daftar barang
Admin klik menu Barang

        |
        v

Route:
GET /products

        |
        v

ProductController@index()

        |
        v

Product Model

        |
        v

Query Database

SELECT * FROM products

        |
        v

Database mengembalikan data

        |
        v

Controller mengirim data

        |
        v

products/index.blade.php

        |
        v

Admin melihat daftar barang

## Contoh kasus: Staff melakukan Stock Out
Staff mengisi form

        |
        v

POST /stock-out

        |
        v

StockTransactionController@store()

        |
        v

Validasi input

        |
        v

Cek stock product

        |
        |
        +------ Stock tidak cukup
        |              |
        |              v
        |          Return Error
        |
        |
        +------ Stock cukup
                       |
                       v

Create Transaction OUT

                       |
                       v

Update Product Stock

                       |
                       v

Save Database

                       |
                       v

Redirect Dashboard

# Stuktur Teknis
Inventory Management System

Frontend
|
|-- Blade
|-- Tailwind CSS


Backend
|
|-- Laravel
|   |
|   |-- Route
|   |-- Controller
|   |-- Model
|   |-- Middleware
|   |-- Validation


Database

|
|-- MySQL


Deployment

|
|-- Fly.io

# Rencana Fitur Import Product dari Excel

Fitur ini dikerjakan setelah sistem utama versi 1.0 selesai. Tujuannya adalah
memindahkan data product lama dari Excel ke database aplikasi tanpa input satu
per satu melalui form.

## Sumber Data Import

Format yang direkomendasikan:

```text
products.xlsx
images/
|-- MOU-01.jpg
|-- KBD-01.png
|-- LPT-01.jpg
```

Kolom Excel minimal:

| Kolom Excel | Kolom Database |
|--|--|
| name | products.name |
| category | products.category_id |
| sku | products.sku |
| price | products.price |
| stock | products.stock |
| condition | products.condition |
| location | products.location |
| description | products.description |
| image | products.image |

SKU digunakan sebagai identitas penghubung antara baris product dan nama file
gambar. Gambar disarankan berada di folder terpisah, bukan hanya ditempel
langsung di dalam worksheet Excel, agar hubungan data lebih mudah dipastikan.

## Alur Import

```text
Admin upload Excel dan folder gambar
                    |
                    v
Controller menerima file
                    |
                    v
Baca baris Excel
                    |
                    v
Validasi kolom, kategori, SKU, harga, stok, dan gambar
                    |
         +--------+--------+
         |                 |
   Data invalid       Data valid
         |                 |
         v                 v
 Tampilkan error    Tampilkan preview
                                 |
                                 v
                         Admin konfirmasi
                                 |
                                 v
                    Simpan product ke database
                                 |
                                 v
                     Simpan gambar ke storage
                                 |
                                 v
                        Tampilkan hasil import
```

## Aturan Import

- SKU wajib diisi dan harus unik.
- SKU product yang sudah ada tidak boleh ditimpa secara otomatis.
- Kategori harus sudah tersedia atau dipetakan terlebih dahulu.
- Harga dan stok harus berupa angka yang valid.
- Kondisi harus sesuai nilai yang diterima sistem.
- File gambar harus memiliki format dan ukuran yang diperbolehkan.
- Import menggunakan database transaction agar data tidak tersimpan sebagian
  ketika terjadi error.
- Sistem menampilkan nomor baris Excel yang berhasil dan yang gagal.

## Penyimpanan Gambar

Gambar hasil import disimpan pada public storage Laravel:

```text
storage/app/public/products
```

Database hanya menyimpan path file gambar pada kolom `products.image`. Excel
digunakan sebagai sumber migrasi data, sedangkan database aplikasi menjadi
penyimpanan utama setelah proses import selesai.

## Catatan Implementasi

Gambar yang ditempel langsung di dalam Excel tetap mungkin diproses, tetapi
memerlukan ekstraksi drawing dan pencocokan posisi gambar dengan baris Excel.
Format Excel dengan kolom nama file gambar dan folder gambar terpisah lebih
aman serta lebih mudah divalidasi.