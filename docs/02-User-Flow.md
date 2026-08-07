# User Flow
# Inventory Management System

# 1. Authentication Flow
User membuka aplikasi

↓

Halaman Login

↓

User memasukkan:
- Email
- Password

↓

System melakukan validasi

↓

Apakah login berhasil?

    |
    +---- Tidak
    |
    ↓
Tampilkan pesan error


    |
    +---- Ya
    |
    ↓

System mengecek role user


    |
    +----------------+
    |                |
    ↓                ↓

 Admin           Staff Gudang

Dashboard       Dashboard

# 2. Admin flow
Admin Login

↓

Admin Dashboard

↓

Memilih Menu


        |
        |
        +----------------+
        |                |
        ↓                ↓


Manage Barang      Manage Kategori


        |                |
        ↓                ↓


CRUD Barang        CRUD Kategori


        |
        |
        ↓


Database Update



        |
        |
        ↓


Riwayat Transaksi


        |
        |
        ↓


Melihat Aktivitas Inventory



        |
        |
        ↓


Laporan Inventory


        |
        |
        ↓


Melihat Statistik Inventory

# 3. Staff Gudang flow
Staff Login

↓

Staff Dashboard

↓

Memilih Menu


        |
        |
        +----------------+
        |                |
        ↓                ↓


Barang            Transaksi


        |
        ↓


Melihat Data Barang



        |
        |
        +----------------+
                         |
                         |
                         ↓


                 Stock In / Stock Out



                         |
                         ↓


                 Input Data Transaksi



                         |
                         ↓


                 System Validasi



                         |
                         ↓


                 Update Stock



                         |
                         ↓


                 Simpan History Transaction


# 04. Stock In Flow
START

Staff memilih Stock In

↓

Memilih barang

↓

Menginput jumlah barang

↓

System cek data

↓

Buat transaksi IN

↓

Tambah stock barang

↓

Simpan transaksi

↓

END

# 05. Stock Out Flow
START

Staff memilih Stock Out

↓

Memilih barang

↓

Menginput jumlah keluar

↓

System mengecek stok


        |
        |
        +-------------+
        |             |
        ↓             ↓

Stock cukup       Stock tidak cukup


        |             |
        ↓             ↓

Buat transaksi     Tampilkan error

OUT


        |

        ↓

Kurangi stock


        |

        ↓

Simpan transaksi


        |

        ↓

END


# 06. Overview Flow
                    USER

                     |
                     v

                  LOGIN

                     |
                     v

              CHECK USER ROLE

                     |
          +----------+----------+
          |                     |
          v                     v

       ADMIN                STAFF


          |                     |

          v                     v


 Manage Master Data       Inventory Operation

          |                     |

          |                     |

          v                     v


 Product               Stock In / Stock Out

 Category                     |

          |                   |

          +--------+----------+

                   |

                   v

          Stock Transaction

                   |

                   v

              Database

                   |

                   v

              Report / History
