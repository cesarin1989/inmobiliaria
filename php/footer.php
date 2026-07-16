<?php
  // Detecta dinámicamente si estamos en la raíz o en la subcarpeta 'php' para enlazar correctamente el mapa web
  $prefijo = (basename(dirname($_SERVER['PHP_SELF'])) == 'php') ? '' : 'php/';
  $url_mapa = $prefijo . 'mapa_web.php';
?>
<p align="center">
  <a class="aweb" href="<?php echo $url_mapa; ?>">Mapa web</a> | 
  Socio Bienes ♦ Gestión Inmobiliaria de Inicio a Fin | 
  Dirección: Av. Quito 0806 y TM 4, Guayaquil, Ecuador | 
  Teléfono: 0969048724 | 
  Email: info@sociobienes.com
</p>
