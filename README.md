# Dokumentasi Project

Program ini adalah test case untuk backend engineer di Surplus Indonesia, dibuat dengan framework laravel versi 7

# Instalasi
Silahkan mengikuti beberapa arahan berikut dengan ketik di terminal/command prompt anda :

1. `git clone https://github.com/zhafariirsyad/surplusBackendTest.git`
2. `composer install`
3. `cp .env.example .env`
4. `sebelum lanjut ke terminal, buat database baru dengan nama sesuai yang tertera dalam file .env`
5. `php artisan key:generate`
6. `php artisan migrate`
7. `jalankan seeder untuk memasukkan data kedalam database, dengan ketik php artisan db:seed --class=AllTableSeeder`
8. `php artisan serve`

# API Endpoint
Setalah semua langkah tadi selesai project sudah bisa dijalankan, dan berikut beberapa endpoint yang ada:

1. Categories

- GET `api/categories`, untuk mendapatkan semua data kategori

- POST `api/categories`, untuk menambah data kategori

  Key yang dibutuhkan di Body : `name, enable (optional)`

  Catatan : kolom enable dijadikan optional untuk diisi, karena default value nya adalah 0 atau false.
- GET `api/categories/:id`, untuk mendapatkan data kategori berdasarkan id yang ditentukan.
- PATCH `api/categories/:id`, untuk memperbarui/mengubah data kategori berdasarkan id yang ditentukan.

  Key yang dibutuhkan di Body : `name, enable (optional)`

  Catatan : kolom enable dijadikan optional untuk diisi, karena default value nya adalah 0 atau false
- DELETE `api/categories/:id`, untuk menghapus data kategori berdasarkan id yang ditentukan

2. Products

- GET `api/products`, untuk mendapatkan semua data produk

- POST `api/products`, untuk menambah data produk

  Key yang dibutuhkan di Body : `name, description, enable (optional)`

  Catatan : kolom enable dijadikan optional untuk diisi, karena default value nya adalah 0 atau false.
- GET `api/products/:id`, untuk mendapatkan data produk berdasarkan id yang ditentukan.
- PATCH `api/products/:id`, untuk memperbarui/mengubah data produk berdasarkan id yang ditentukan.

  Key yang dibutuhkan di Body : `name, description, enable (optional)`

  Catatan : kolom enable dijadikan optional untuk diisi, karena default value nya adalah 0 atau false
- DELETE `api/products/:id`, untuk menghapus data produk berdasarkan id yang ditentukan

3. Category Products

- GET `api/categoryproducts`, untuk mendapatkan semua data kategori produk

- POST `api/categoryproducts`, untuk menambah data kategori produk

  Key yang dibutuhkan di Body : `category_id, product_id`

- GET `api/categoryproducts/:id`, untuk mendapatkan data kategori produk berdasarkan id yang ditentukan.
- PATCH `api/categoryproducts/:id`, untuk memperbarui/mengubah data kategori produk berdasarkan id yang ditentukan.

  Key yang dibutuhkan di Body : `category_id, product_id`

- DELETE `api/categoryproducts/:id`, untuk menghapus data kategori produk berdasarkan id yang ditentukan

4. Images

- GET `api/images`, untuk mendapatkan semua data gambar

- POST `api/images`, untuk menambah data gambar

  Key yang dibutuhkan di Body : `name, file, enable (optional)`

  Catatan : kolom enable dijadikan optional untuk diisi, karena default value nya adalah 0 atau false.
- GET `api/images/:id`, untuk mendapatkan data gambar berdasarkan id yang ditentukan.
- PATCH `api/images/:id`, untuk memperbarui/mengubah data gambar berdasarkan id yang ditentukan.

  Key yang dibutuhkan di Body : `name, file, enable (optional)`

  Catatan : kolom enable dijadikan optional untuk diisi, karena default value nya adalah 0 atau false
- DELETE `api/images/:id`, untuk menghapus data gambar berdasarkan id yang ditentukan

5. Product Images

- GET `api/productimages`, untuk mendapatkan semua data gambar produk

- POST `api/productimages`, untuk menambah data gambar produk

  Key yang dibutuhkan di Body : `image_id, product_id`

- GET `api/productimages/:id`, untuk mendapatkan data gambar produk berdasarkan id yang ditentukan.
- PATCH `api/productimages/:id`, untuk memperbarui/mengubah data gambar produk berdasarkan id yang ditentukan.

  Key yang dibutuhkan di Body : `image_id, product_id`

- DELETE `api/productimages/:id`, untuk menghapus data gambar produk berdasarkan id yang ditentukan
