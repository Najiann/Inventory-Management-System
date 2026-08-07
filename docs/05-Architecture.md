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