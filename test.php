<?php
// Forzar limpieza de caché sin terminal
exec('php artisan config:clear');
echo "Configuración limpiada";
?>
