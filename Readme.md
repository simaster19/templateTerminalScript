#Template Script Nuyul 


[✓] Cara Penggunaan dbAdmin.php
1. Import dahulu file Sql ke Database mysql yang anda punya.
2. Jalankan Script dbAdmin.php di terminal yang telah terinstall php, jika di android silahkan gunakan termux.
Nanti akan muncul menu seperti Di bawah jika berhasil terkoneksi ke database.

 ==============================\n
               MANAGE YOUR DATA
 ==============================\n
1. Data User
2. Data User Premium
3. Data Versi
4. Data Shortlink
5. Data Sourcecode
6. Data User Agent

Keterangan : 
1. Data User berisi data user yang telah menjalankan Script Template.php (RUD)
2. Data User Premium berisi data user yang telah menjalankan script Template.php tetapi script ini bersifat Premium (CRUD)
3. Data Versi berisi data versi App yang siap publish, data ini wajib diisi dahulu tentukan namaSc dan versi di awal, setelah di tentukan maka nilai Variabel yang ada di Template.php ($versiApp) wajib di ganti serta nama file sesuaikan dengan yang anda isi di Data Versi contoh: Template.php  (CRUD)
4. Data Shortlink berisi data shortlink dan password/token untuk akses FREE script, dalam hal ini pass/token wajib sama dengan isi shortlink, contoh : jika anda upload token di pastebin.com trus di perpendek link nya , maka link yang di perpendek taruh di field link dan field pass diisi dengan token yang sama dengan yang ada di pastebin.  (CRUD)
5. Data Sourcecode berisi data Script anda sendiri, sebenarnya ini hanya untuk backup saja, semisal anda ingin menambah menu maka bisa di tampilin data ini (CRUD)
6. Data UserAgent berisi data Useragent dari user FREE yang menggunakan script Template.php



[✓] Cara penggunaan Template.php
1. Import dahulu file Sql ke Database mysql yang anda punya.
2. Jalankan Script Template.php di terminal yang telah terinstall php, jika di android silahkan gunakan termux.
3. Ganti Nilai variabel $typeSource= FREE untuk user FREE dan PREMIUM untuk User Premium 
4. Ganti Nilai Variabel $versiApp Sesuai dengan keinginan Anda.
5. Ganti Nilai Variabel $countToken Sesuai dengan Keinginan Anda.

Silahkan untuk Encryptsi anda bisa menggunakan penyedia encryptsi..

