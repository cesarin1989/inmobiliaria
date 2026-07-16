<?php
// Script para eliminar archivos basura de Mac (._) recursivamente en el hosting
$dir = dirname(__DIR__); // Carpeta raíz (htdocs)

function eliminarBasuraMac($path) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    $eliminados = 0;
    foreach ($iterator as $file) {
        $filePath = $file->getRealPath();
        $filename = basename($filePath);
        
        // Detectar si empieza con "._"
        if (strpos($filename, '._') === 0) {
            if ($file->isFile()) {
                unlink($filePath);
                $eliminados++;
            }
        }
    }
    return $eliminados;
}

$cantidad = eliminarBasuraMac($dir);
echo "Se eliminaron $cantidad archivos temporales de Mac (._) con éxito del servidor.";
?>
