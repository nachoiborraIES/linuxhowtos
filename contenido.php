<?php
    if (!isset($_GET["id"]))
    {
        header("Location: index.php");
    }

    require('partials/cabecera.inc');
    require('partials/contenidos.inc');    
    require('lib/Parsedown.php');    
?>

<div class="listado">
    <a name="inicio" href="index.php">Inicio</a>
</div>

<?php
    $contenidoMD = file_get_contents(MD_PATH . $contenidos[$_GET["id"]][1] . '.md');
    $Parsedown = new Parsedown();
    echo $Parsedown->text($contenidoMD); 

    require('partials/pie.inc');
?>
