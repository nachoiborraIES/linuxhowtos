<?php
    require('partials/cabecera.inc');
    require('partials/contenidos.inc');
?>

<div class="jumbotron">
    <h1>Linux HowTos</h1>
    <p>Esta es una web que recoge algunos de los comandos más útiles en Linux (distribuciones Debian, Ubuntu y derivados), a la hora de instalar
    o configurar ciertas aplicaciones.</p>
    <p>La web está estructurada en categorías, y dentro de cada categoría existen distintas secciones que explican los comandos a emplear en cada caso.</p>
</div>

<?php

echo '<div class="listado">';

for ($i = 0; $i < count($contenidos); $i++)
{
    echo '<a href="contenido.php?id=' . $i . '">' . $contenidos[$i][0] . '</a>';
}

echo '</div>';

require('partials/pie.inc');

?>