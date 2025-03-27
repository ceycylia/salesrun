<?php

use Carbon\Carbon;


/**
 * Memformat tanggal ke dalam format bahasa Indonesia
 *
 * @param string $tanggal Tanggal dalam format yang dapat diterima oleh DateTime
 * @param string $format Jenis format yang digunakan ('short', 'medium', 'long', 'full'). Default: 'full'.
 * 
 * @return string Tanggal yang diformat sesuai dengan format yang dipilih
 * 
 * @throws Exception Jika format tanggal tidak valid
 */
if (!function_exists('format_tanggal')) {
    function format_tanggal($tanggal, $format = 'full')
    {
        $formatter = new IntlDateFormatter(
            'id_ID',
            match ($format) {
                'short' => IntlDateFormatter::SHORT,
                'medium' => IntlDateFormatter::MEDIUM,
                'long' => IntlDateFormatter::LONG,
                default => IntlDateFormatter::FULL,
            },
            IntlDateFormatter::NONE
        );

        return $formatter->format(new DateTime($tanggal));
    }
}

/**
 * Menentukan apakah sebuah menu aktif berdasarkan URI
 *
 * @param string $url URL yang ingin diperiksa
 * @return string Kelas CSS untuk menu yang aktif
 */
if (!function_exists('isActive')) {
    function isActive($url)
    {
        $currentUrl = service('request')->getPath();
        return ($currentUrl == trim($url, '/')) ? 'text-blue-700' : 'text-gray-700 hover:text-blue-600';
    }
}

/**
 * Membuat elemen menu navigasi tunggal
 *
 * @param string $url URL tujuan
 * @param string $label Teks yang akan ditampilkan
 * @return string Elemen HTML untuk menu
 */
if (!function_exists('NavLink')) {
    function NavLink($url, $label)
    {
        return '<a href="' . base_url($url) . '" class="' . isActive($url) . ' font-medium">' . $label . '</a>';
    }
}

/**
 * Membuat elemen menu dropdown dalam navigasi
 *
 * @param string $label Nama menu dropdown
 * @param array $links Array dari menu dropdown (berisi url dan label)
 * @return string Elemen HTML untuk dropdown menu
 */
if (!function_exists('NavLinkDropdown')) {
    function NavLinkDropdown($label, $links)
    {
        $dropdown = '<div class="relative group">
            <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 font-medium focus:outline-none">
                <span>' . $label . '</span>
                <i class="fa fa-chevron-down text-xs"></i>
            </button>
            <div class="absolute left-0 hidden group-hover:block bg-white shadow-md rounded-md w-52 py-2">
        ';

        foreach ($links as $link) {
            $dropdown .= '<a href="' . base_url($link['url']) . '" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">' . $link['label'] . '</a>';
        }

        $dropdown .= '</div></div>';
        return $dropdown;
    }
}
