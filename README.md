# Aplikasi Pembuatan Work Order dengan Fitur RBAC

Aplikasi ini adalah sistem manajemen Work Order yang memungkinkan pengguna untuk membuat, mengelola, dan memantau status Work Order. Aplikasi ini dilengkapi dengan fitur **Role-Based Access Control (RBAC)**, yang memungkinkan pembagian akses berdasarkan peran pengguna.

## Teknologi yang Digunakan

-   **Backend**: Laravel 11
-   **Frontend**: Bootstrap 4, jQuery
-   **Database**: MySQL
-   **Template**: Stisla
-   **Autentikasi**: Laravel Breeze untuk autentikasi pengguna
-   **RBAC**: Spatie Laravel Permission untuk pengelolaan hak akses berdasarkan peran

## Fitur Utama

-   **Autentikasi Pengguna**: Pengguna dapat mendaftar, login, dan logout.
-   **Manajemen Work Order**: Pengguna dapat membuat, mengedit, dan menghapus Work Order.
-   **Role-Based Access Control (RBAC)**: Pengguna dengan peran tertentu (misalnya Admin, Supervisor, User) memiliki akses yang berbeda.
-   **Pengelolaan Pengguna**: Admin dapat menambah, mengedit, dan menghapus pengguna serta menetapkan peran.

## Persyaratan Sistem

Sebelum menjalankan aplikasi ini, pastikan Anda telah menginstal perangkat lunak berikut:

-   **PHP** >= 8.1
-   **Composer**
-   **MySQL**

## Instalasi

1. **Clone repository**:

    Sebelum melakukan instalasi, clone project terlebih dahulu

    ```bash
    git clone https://github.com/ekasatriaap/work-order.git
    cd work-order
    ```

2. **Konfigurasi file environment**:

    Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

### Pilih Metode Instalasi

<details>

<summary>Instalasi Menggunakan Docker</summary>

1. **Pastikan Docker dan Docker Compose terinstal**:

    Sebelum melanjutkan, pastikan Docker dan Docker Compose telah terinstal pada sistem Anda. Jika belum, ikuti instruksi [di sini](https://docs.docker.com/get-docker/) untuk menginstalnya.

2. **Membangun container Docker**:

    Jalankan perintah berikut untuk membangun aplikasi menggunakan Docker Compose:

    ```bash
    docker compose create
    ```

    Perintah ini akan membangun image Docker, dan mengatur database.

3. **Menjalankan container Docker**:

    Jalankan perintah berikut untuk menjalankan aplikasi menggunakan Docker Compose:

    ```bash
    docker compose start
    ```

    Perintah ini akan menjalankan aplikasi dalam container.

4. **Generate aplikasi key**:

    Jalankan perintah berikut untuk menghasilkan aplikasi key:

    ```bash
    docker exec work-order-app php artisan key:generate
    ```

5. **Membuat database**:

    Koneksikan database client dengan database dengan username root dan password root. Buat database dengan nama work-order di dalam container.

6. **Migrasi data**:

    Anda bisa menggunakan data yang sudah di sediakan di /public/database.sql, atau menjalankan perintah migrasi dan seeder.

    ```bash
    docker exec work-order-app php artisan migrate --seed
    ```

7. **Jalankan ulang container**:

    Jalankan ulang container untuk merefresh file .env di container.

    ```bash
    docker compose restart
    ```

8. **Jalankan aplikasi**:

    Setelah proses selesai, Anda dapat mengakses aplikasi di `http://localhost:8080`.

</details>

<details>
<summary>Instalasi Konvensional</summary>

1. **Instal dependensi backend**:

    Pastikan Anda sudah menginstal Composer. Kemudian jalankan perintah berikut untuk menginstal dependensi Laravel:

    ```bash
    composer install
    ```

2. **Generate aplikasi key**:

    Jalankan perintah berikut untuk menghasilkan aplikasi key:

    ```bash
    php artisan key:generate
    ```

3. **Membuat database**:

    Buat database dengan nama work-order.

4. **Migrasi data**:

    Anda bisa menggunakan data yang sudah di sediakan di /public/database.sql, atau menjalankan perintah migrasi dan seeder.

    ```bash
    php artisan migrate --seed
    ```

5. **Jalankan aplikasi**:

    Sekarang Anda dapat menjalankan aplikasi menggunakan perintah berikut:

    ```bash
    php artisan serve
    ```

    Aplikasi akan tersedia di `http://localhost:8000`.

</details>

## Users Default

Setelah instalasi selesai, pengguna default sudah disediakan di dalam **Seeder** aplikasi ini.

-   **Pengguna Default yang Ditambahkan**:

    Seeder sudah menambahkan tiga pengguna default dengan peran berikut:

    -   **Username**: `root`  
        **Password**: `root`  
        **Role**: `Root` (Admin penuh)
    -   **Username**: `project_manager`  
        **Password**: `password`  
        **Role**: `Project Manager`
    -   **Username**: `Operator`  
        **Password**: `password`  
        **Role**: `Operator`

### Menggunakan Seeder

Jika Anda ingin menambahkan lebih banyak pengguna atau melakukan perubahan pada data pengguna default, Anda dapat memodifikasi file `database/seeders/UserSeeder.php` sesuai kebutuhan. Setelah itu, jalankan kembali perintah `php artisan db:seed` untuk menambahkan data baru.
