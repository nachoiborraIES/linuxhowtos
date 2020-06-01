# linuxhowtos

Esta es una web que pretende recopilar algunos de los comandos Linux más útiles a la hora de configurar ciertos aspectos. Desde la creación de usuarios, asignación a grupos y permisos, hasta la instalación y configuración de algunos servidores y herramientas más complejas.

Desde la página inicial, se mostrará un listado de categorías principales, como por ejemplo "Gestión del Sistema Operativo", o "Servidores Web", y haciendo clic en cualquiera de ellas se accederá al documento con las instrucciones para realizar las operaciones en cuestión: añadir usuarios al sistema, instalar Apache como un sistema XAMPP, etc.

Para el desarrollo de esta web se ha combinado el uso de PHP estándar con una librería llamada [Parsedown](https://github.com/erusev/parsedown), que permite parsear contenido en formato MarkDown dentro de un documento HTML. De este modo, toda la documentación de los comandos Linux, así como el código de dichos comandos, se ha definido empleando el formato MarkDown, y lo que se hace es embeber este contenido en la propia web, convirtiéndolo a HTML con *Parsedown*.

Dentro de la subcarpeta `md` se irán colocando los diferentes archivos MarkDown de explicación, y en el archivo `partials/contenidos.inc` se tiene un array que asocia cada título o categoría principal con el archivo MarkDown donde se detallan los contenidos de dicha categoría. Basta con editar este archivo y añadir el correspondiente archivo MarkDown a la subcarpeta `md` para que el sistema recargue los cambios.