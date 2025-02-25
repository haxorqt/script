#!/bin/bash

WATCH_DIR="/home/pariwisata/public_html/bulan/"

while true; do
    find "$WATCH_DIR" -type d ! -perm 755 -exec chmod 755 {} \;
    sleep 5
done

while true; do find /home/pariwisata/public_html/bulan/ -type f ! -perm 755 -exec chmod 755 {} \;; sleep 5; done
