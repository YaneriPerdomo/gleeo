<?php
if (!function_exists('converter_slug')) {
    function converter_slug($name_lastname, $cedula = '')
    {
        $text = Str::slug($name_lastname);
        if ($cedula != '') {
            $text .= '-' . $cedula;
        }
        return $text;
    }
}
use Carbon\Carbon;
if (!function_exists('formatting_date')) {
    function formatting_date($data)
    {
        if (!$data || $data == null) {
            return 'N/A';
        }
        $fullDateString = substr($data, 0, 10);
        $dateParts = explode('-', $fullDateString);
        $formattedDate = $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
        $dateTimeString = $data;
        echo $formattedDate ;
    }
}
if (!function_exists('formatting_date_h')) {
    function formatting_date_h($data)
    {
        if (!$data || $data == null) {
            return 'N/A';
        }
        $fullDateString = substr($data, 0, 10);
        $dateParts = explode('-', $fullDateString);
        $formattedDate = $dateParts[2] . '/' . $dateParts[1] . '/' . $dateParts[0];
        $dateTimeString = $data;
        $dateTime = new DateTime($dateTimeString);
        $formattedTime = $dateTime->format('g:i a');
        echo $formattedDate . ' ' . $formattedTime;
    }
}
?>
