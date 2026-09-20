# Campus Facility Booking System

Sistem Pengurusan Tempahan Fasiliti Kampus yang dibangunkan menggunakan PHP, MySQL (Prepared Statements), HTML/CSS, dan pengurusan sesi serta cookie.

## 👥 Ahli Kumpulan
1. MUHAMMAD FAWWAZ TAQIYUDDIN BIN ZAHARIN - 25DIT24F2018
2. MUHAMMAD FIRDAUS BIN ZAINAL ABIDIN - 25DIT24F2008
3. NUR ARIF AIMAN BIN NOR HAZAM - 25DIT24F2043
4. KHAIRUL ASHIDIQ FIKRI BIN IRWAN - 25DIT24F2009

---

## 🛠️ Konfigurasi Pangkalan Data (Database Setup)
* **Nama Pangkalan Data (Database Name):** `facility_booking`
* **Pelayan (Server):** `localhost`
* **Nama Pengguna (Username):** `root`
* **Kata Laluan (Password):** *(kosongkan)*

---

## 🚀 Panduan Pemasangan & Menjalankan Sistem (Setup Instructions)
1. Muat turun dan pasang perisian **XAMPP** atau **WAMP** pada komputer anda.
2. Buka kawalan XAMPP dan aktifkan modul **Apache** dan **MySQL**.
3. Buka pelayar web dan pergi ke **`http://localhost/phpmyadmin`**.
4. Cipta pangkalan data baharu dengan nama **`facility_booking`**.
5. Pilih pangkalan data tersebut, klik pada tab **Import**, dan muat naik fail `.sql` yang disediakan (`facility_booking.sql`)[cite: 1].
6. Salin keseluruhan folder projek anda dan letakkan di dalam direktori pelayan web (contohnya folder `htdocs` dalam XAMPP).
7. Akses sistem melalui pelayar web dengan pautan:  
   `http://localhost/nama_folder_projek/login.php`

---

## 🔐 Kredential Log Masuk Admin
* **Username:** `admin`[cite: 1]
* **Password:** *(Bebas / Mengikut kod log masuk yang ditetapkan)*

---

## 📌 Modul Utama Sistem
* **Modul Pengesahan (Authentication):** Log masuk menggunakan sesi (`$_SESSION`) dan sekatan laluan halaman[cite: 1].
* **Modul Pengurusan Fasiliti (CRUD):** Tambah, papar, kemaskini, dan padam maklumat fasiliti[cite: 1].
* **Modul Tempahan (Booking):** Borang tempahan dinamik dengan integrasi **Cookie** (menyimpan pilihan fasiliti terakhir selama 1 hari)[cite: 1].
* **Modul Laporan (Advanced Features):** Paparan rekod menggunakan SQL `JOIN` dan fungsi `COUNT()`[cite: 1].
