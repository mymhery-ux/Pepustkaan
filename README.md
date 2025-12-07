SIS-SURAT - Sample PHP Project
==============================
Struktur sederhana Sistem Informasi Administrasi Surat (PHP + MySQL).

Catatan:
- Sesuaikan koneksi database di lib/koneksi.php
- Install composer libs jika ingin fitur export (TCPDF / PhpSpreadsheet)
  contoh:
    composer require tecnickcom/tcpdf
    composer require phpoffice/phpspreadsheet
- Folder `upload/` harus dapat ditulis oleh webserver.

Cara pakai:
1. Import file database.sql ke MySQL.
2. Sesuaikan credentials di lib/koneksi.php
3. Letakkan project di webroot (xampp/htdocs atau /var/www/html)
4. Buka browser ke index.php
