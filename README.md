# linuxhowtos

Este repositorio pretende recopilar algunos de los comandos y pasos en Linux más útiles a la hora de configurar ciertos aspectos. Desde la creación de usuarios, asignación a grupos y permisos, hasta la instalación y configuración de algunos servidores y herramientas más complejas.

Inicialmente, se pensó como una web HTML donde, mediante la librería [Parsedown](https://github.com/erusev/parsedown) se embebía en el contenido HTML el contenido MarkDown parseado: 

```php
require('lib/Parsedown.php');    

...

$Parsedown = new Parsedown();
echo $Parsedown->text($contenidoEnFormatoMD);
```

Ahora se ha optado por dejar los contenidos directamente accesible en GitHub en formato MarkDown. Basta con entrar en la carpeta de la categoría deseada y buscar el contenido que se quiera.