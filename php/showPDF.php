<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pdf_file = './uploads/' . $_POST["fileName"];
    if (!file_exists($pdf_file)) {
        die('PDF file not found.');
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($pdf_file) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    readfile($pdf_file);

    return readfile($pdf_file);
}
?>