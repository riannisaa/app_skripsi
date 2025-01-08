<?php

use Carbon\Carbon;

if (!function_exists('formatTanggalIndo')) {
    function formatTanggalIndo($date)
    {
        Carbon::setlocale('ID');

        $date = Carbon::parse($date);

        return $date->translatedFormat('d F Y');
    }
}