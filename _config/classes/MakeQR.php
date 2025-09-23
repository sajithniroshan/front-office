<?php

include 'phpqrcode/qrlib.php';

class MakeQR
{
    public static function create($url, $file_name, $ecc, $pixel_Size, $frame_Size)
    {

        $qr = QRcode::png($url, $file_name, $ecc, $pixel_Size, $frame_Size);
        return $qr;

    }

}