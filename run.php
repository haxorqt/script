<?php
// SAFE: hanya menjalankan script yang sudah fixed, bukan perintah input user
$allowed = '/www/wwwroot/karangkobar.banjarnegarakab.go.id/final.sh';
if (file_exists($allowed)) {
    $output = shell_exec(escapeshellcmd($allowed));
    echo htmlspecialchars($output);
} else {
    echo "Script tidak ditemukan.";
}
?>