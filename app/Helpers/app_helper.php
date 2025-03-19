<?php

use Carbon\Carbon;

/**
 * Menentukan apakah sebuah menu aktif berdasarkan URI
 *
 * @param string $uri
 * @return string
 */
function is_active($uri)
{
    // Get current URI path
    $currentURI = current_url();

    // Check if the current URI matches the passed URI
    return strpos($currentURI, $uri) !== false;
}

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

if (!function_exists('format_tanggal_carbon')) {
    function format_tanggal_carbon($tanggal, $format = 'l, d F Y')
    {
        Carbon::setLocale('id');
        return Carbon::parse($tanggal)->translatedFormat($format);
    }
}
