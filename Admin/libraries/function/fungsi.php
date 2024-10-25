<?php
// Fungsi untuk memotong teks HTML dengan aman
function truncateHtml($text, $maxLength) {
    $doc = new DOMDocument();
    @$doc->loadHTML(mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8'));
    $totalLength = 0;
    $output = '';

    foreach ($doc->getElementsByTagName('body')->item(0)->childNodes as $node) {
        if ($totalLength >= $maxLength) {
            break;
        }

        $nodeHtml = $doc->saveHTML($node);
        $nodeLength = strlen(strip_tags($nodeHtml)); // Panjang teks tanpa tag HTML

        if ($totalLength + $nodeLength > $maxLength) {
            $remainingLength = $maxLength - $totalLength;
            $truncatedText = substr(strip_tags($nodeHtml), 0, $remainingLength);
            $output .= '<p>' . htmlentities($truncatedText) . '...</p>';
            break;
        } else {
            $output .= $nodeHtml;
            $totalLength += $nodeLength;
        }
    }

    return $output;
}

?>
