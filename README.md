## 🍗 Aplikasi Reservasi Restoran - Ayam Bolo Bebek
Aplikasi berbasis web ini dirancang untuk memudahkan pelanggan dalam melakukan reservasi meja dan pemesanan menu secara daring, serta membantu manajemen restoran (admin dan kasir) dalam mengelola data operasional secara terstruktur.

## 👥 Informasi Kelompok
Sesuai dengan penugasan, berikut adalah detail pengembang aplikasi:

- Kukuh Wisanggeni : 24082010014(backend)

- Jonathan Steward : 24082010041(frontend)

## 🛠️ Tech Stack yang Digunakan
Aplikasi ini dibangun menggunakan kombinasi teknologi modern untuk performa dan kemudahan pengembangan:

- Bahasa Pemrograman: PHP

- Database: MySQL (dikelola melalui phpMyAdmin)

- Frontend Framework: Tailwind CSS

- Web Server: Apache (XAMPP)

## ✨ Fitur Utama Aplikasi
Aplikasi ini mendukung tiga hak akses utama dengan fitur-fitur berikut:

1. Fitur Pelanggan
Reservasi Meja Online: Memilih meja berdasarkan kapasitas dan jadwal waktu kunjung.

Pemesanan Menu Terintegrasi: Memilih hidangan favorit (seperti Bebek Goreng dan Ayam Goreng) langsung saat reservasi.

Sistem Pembayaran DP: Mengunggah bukti transfer sebagai syarat konfirmasi reservasi.

Riwayat Reservasi: Memantau status dan detail pesanan pribadi.

2. Fitur Kasir
Manajemen Kedatangan: Melihat daftar seluruh reservasi pelanggan.

Proses Pelunasan: Menangani pembayaran sisa tagihan di tempat dengan kalkulator kembalian otomatis.

Verifikasi Kasir: Setiap transaksi pelunasan dicatat atas nama kasir yang bertugas.

3. Fitur Admin
Manajemen Data Master: Mengelola data meja (kapasitas) dan data menu (harga/gambar).

Laporan Keuangan: Memantau total pendapatan dan riwayat transaksi yang sudah lunas secara descending.

# Windmill Dashboard

A multi theme, completely accessible, with components and pages examples, ready for production dashboard.

🧪 [See it live](https://windmillui.com/dashboard-html)

- 🦮 Thoroughly accessible
- 🌗 Light and dark themes
- 💅 Styled with Tailwind CSS
- 🧩 Various components
- ❄ [React version](https://windmillui.com/dashboard-react)

## 🚀 Usage

Clone or download this repo and everything you need is inside the `public` folder.

## 🦮 Accessibility

This dashboard was developed with a11y in mind since the beginning.

1. Every text passes the WCAG Level AA (at least)
2. It is completely keyboard navigable
3. I actually used [NVDA](https://www.nvaccess.org/) to read my screen during development

Everybody can benefit with good accessibility practices, like the modal, for example ([test it live](https://windmill-dashboard.vercel.app/modals.html)). It uses focus trap techniques to not loose focus when navigating via keyboard and thinking of mobile users with large screen devices, it is placed in the bottom of the screen.

## 🌗 Multi theme

It uses Tailwind CSS for styling, and some may say it is totally biased, but it uses the most simple theming plugin there is for it, [Tailwind Multi Theme plugin](https://github.com/estevanmaito/tailwindcss-multi-theme#tailwind-css-multi-theme) (made by me). The result is that, as with regular Tailwind, you have control over every style in your pages.

You can see that by navigating through the examples, changing theme and going visiting pages like login or create account, to see different images served for different themes.

Theme auto detection based on user's OS preferences and local settings storage are enabled by default.

## 🔮 Future

TODO

- [ ] Make charts accessible through hidden data
- [ ] Refactor and split `shadow-outline-<color>` plugin
- [ ] Paginate tables with Alpine
- [ ] Focus first element when dropdowns are opened

## OSS used

- [Tailwind CSS](https://tailwindcss.com/)
- [Tailwind Multi Theme](https://github.com/estevanmaito/tailwindcss-multi-theme)
- [Tailwind Custom Forms](https://github.com/tailwindlabs/tailwindcss-custom-forms)
- [PostCSS](https://postcss.org/)
- [Alpine.js](https://github.com/alpinejs/alpine)
- [Chart.js (charts)](https://www.chartjs.org/)
- [UI Faces (avatars)](https://uifaces.co/)
- [Heroicons (icons)](https://heroicons.dev/)
