#!/bin/bash
cd /opt/dtweb/public/
php -S 0.0.0.0:7533 &
PHP_PID=$!
echo $PHP_PID
su -c "chromium-browser http://localhost:7533" udooer
echo "Killing PHP..."
kill $PHP_PID
