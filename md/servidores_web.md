# Servidores Web

En este documento se explican los pasos a seguir para instalar y configurar distintos tipos de servidores web en sistemas Debian y derivados.

## Instalar Apache, PHP y MysQL como XAMPP

Para instalar XAMPP, basta con descargarlo de su [web oficial](https://www.apachefriends.org/es/index.html) y seguir los pasos del asistente. Debemos dar permisos de ejecución y ejecutar el archivo *.run* que descarguemos desde algún terminal, con permisos de administrador (*sudo*). Suponiendo que el archivo se llame *xampp-linux-x64-7.4.5-installer.run*, por ejemplo, los pasos son los siguientes (desde la carpeta donde lo hemos descargado):

```
sudo chmod +x xampp-linux-x64-7.4.5-installer.run
sudo ./xampp-linux-x64-7.4.5-installer.run
```

Se iniciará un asistente que instalará XAMPP. El *manager* de XAMPP será la herramienta que usaremos para ponerlo en marcha, y se encuentra en **/opt/lampp/manager-linux-x64.run**. Podemos acceder a la carpeta desde el terminal para ejecutarlo (con permisos de superusuario), o bien crear algún acceso directo en otra ubicación que nos resulte más cómoda. Consulta la sección de *Gestión del Sistema Operativo* para ver cómo crear accesos directos a aplicaciones.

### Configuración de apache y hosts virtuales

Si queremos editar la configuración del servidor Apache en XAMPP, ésta se encuentra en el archivo `/opt/lampp/etc/httpd.conf`. Para poder, por ejemplo, definir hosts virtuales, debemos editar este fichero, y descomentar la línea que hace referencia al archivo donde se definen los hosts virtuales:

```
# Virtual hosts
Include etc/extra/httpd-vhosts.conf
```

Si queremos asignar un nombre local al host virtual, podemos editar el archivo `/etc/hosts` y añadirlo junto al resto. Podemos especificar una dirección local asociada:

```
127.0.0.5       linuxhowtos
```

Después, debemos editar ese archivo indicado, `/opt/lampp/etc/extra/httpd-vhosts.conf`, y añadir el nuevo host virtual. Por ejemplo:

```
<VirtualHost 127.0.0.5:80>
    DocumentRoot "/home/nacho/Proyectos/linuxhowtos"
    DirectoryIndex index.php
    <Directory "/home/nacho/Proyectos/linuxhowtos">
        Options All
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Notar que indicamos la dirección local que hemos establecido en `/etc/hosts` para acceder a este host virtual. Si estamos en un servidor de producción con un nombre de dominio o subdominio públicos, entonces la configuración de este host virtual cambia, y podría quedar así:

```
<VirtualHost *:80>
    ServerName linuxhowtos.nachoib.es
    DocumentRoot "/home/nacho/Proyectos/linuxhowtos"
    DirectoryIndex index.php
    <Directory "/home/nacho/Proyectos/linuxhowtos">
        Options All
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Tras estos cambios, debemos reiniciar Apache para que los incorpore.

## Instalar Apache como servidor independiente

Si queremos instalar Apache como un servidor independiente (y no incluido en un sistema XAMPP) escribimos este comando:

```
sudo apt-get install apache2
```

Se instalará Apache como un servicio, que se auto-arranca al iniciar el sistema. 

### Parada y puesta en marcha

Estos comandos nos servirán para pararlo, iniciarlo o reiniciarlo:

```
sudo systemctl start apache2
sudo systemctl stop apache2
sudo systemctl restart apache2
sudo systemctl reload apache2
```

La diferencia entre las opciones de `reload` y `restart` es que la primera es más "suave", y se emplea para cambios poco profundos en la configuración. Alternativamente, también podemos usar estos otros comandos:

```
sudo /etc/init.d/apache2 start
sudo /etc/init.d/apache2 stop
sudo /etc/init.d/apache2 reload
sudo /etc/init.d/apache2 restart
```

### Configuración básica

La configuración básica de Apache se encuentra en el archivo `/etc/apache2/apache2.conf`. Puede ser buena idea hacer una copia del archivo original:

```
sudo cp /etc/apache2/apache2.conf /etc/apache2/apache2.conf.original
```

Dentro de este archivo de configuración hay poco que modificar. Entre otras cosas, podemos consultar o cambiar la propiedad `DocumentRoot` que referencia a la carpeta donde se ubicarán por defecto los documentos web, y que es `/var/www/html`. Además, los posibles errores al iniciar o estar en marcha Apache se volcarán al archivo indicado por la propiedad `ErrorLog`, cuyo valor por defecto es `/var/log/apache2/error.log`.

Finalmente, si queremos modificar los **puertos** por defecto por los que escucha Apache, debemos hacerlo en el archivo `/etc/apache2/ports.conf`. Podemos, por ejemplo, añadir otros puertos alternativos a los que ya hay, añadiendo más directivas `Listen` a ese archivo.

### Definir hosts virtuales

Los hosts virtuales se definen cada uno en un archivo independiente dentro de la carpeta `/etc/apache2/sites-available`. Existe un archivo de ejemplo que podemos copiar para crear nuestros hosts adicionales. Por ejemplo, podemos crear un archivo `001-pruebas.conf` con un host como éste:

```
<VirtualHost *:80>
    ServerAdmin admin@pruebas.org
    ServerName pruebas.nachoib.ovh
    DocumentRoot "/home/usuario/pruebas"
    <Directory "/home/usuario/pruebas">
        Require all granted
    </Directory>
</VirtualHost>
```

Si queremos añadir un nombre de *host* local (para pruebas en local), podemos editar el archivo `/etc/hosts` como se ha explicado más arriba para el uso de XAMPP.

Finalmente, para que este nuevo host virtual se active, debemos crear un enlace simbólico a este archivo dentro de la carpeta `/etc/apache2/sites-enabled`. Podemos hacerlo de este modo:

```
sudo ln -s /etc/apache2/sites-available/001-pruebas.conf /etc/apache2/sites-enabled
```

Del mismo modo, para deshabilitar este sitio, debemos simplemente borrar el enlace simbólico de esta carpeta. Cualquier cambio que apliquemos en este sentido (crear o quitar hosts virtuales) necesitará que reiniciemos el servidor Apache.

```
sudo systemctl reload apache2
```

## Instalar Node y NPM

Para instalar Node en un sistema Linux, haremos uso de otra herramienta llamada **NVM** (*Node Version Manager*), una herramienta que nos permite fácilmente instalar distintas versiones de Node, desinstalar versiones obsoletas, o elegir en cualquier momento cuál de las versiones que tenemos instalada queremos dejar activa. Podemos consultar información en su [web oficial en GitHub](https://github.com/nvm-sh/nvm). 

Para instalar NVM, debemos descargarlo con el comando `curl` o `wget`, según se explica en la propia web de GitHub. Si optamos por `wget`, el comando es como sigue (en una sola línea):

```
wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/
v0.35.3/install.sh | bash
```

En el caso de no disponer del comando `wget` instalado, podemos o bien instalarlo, o bien emplear este otro comando equivalente, con la orden `curl` (también en una sola línea):

```
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/
v0.35.3/install.sh | bash
```

> **NOTA**: el número de versión `v0.35.3` puede variar. Es preferible consultar la web de GitHub para obtener el comando actualizado.

> **NOTA**: después de ejecutar el comando anterior, será necesario cerrar el terminal y volverlo a abrir para poder utilizar el comando `nvm`.

Ya tenemos `nvm` instalado en el sistema. Aquí mostramos algunas de las opciones más interesantes que podemos utilizar:

* `nvm install node`: instala la última versión disponible de Node
* `nvm install --lts`: instala la última versión LTS disponible
* `nvm install 12.16.0`: instala la versión especificada de Node
* `nvm uninstall 12.16.0`: desinstala la versión especificada de Node
* `nvm ls-remote`: muestra todas las versiones disponibles para instalar
* `nvm list`: muestra todas las versiones instaladas localmente
* `nvm current`: muestra la versión actualmente activa
* `nvm use 12.16.0`: marca la versión indicada como actualmente activa
* `nvm use --lts`: marca como activa la última versión LTS instalada

En nuestro caso, vamos a instalar la última versión LTS disponible, por lo que ejecutaremos el comando:

```
nvm install --lts
```

Podemos ejecutar ahora `node -v` en el terminal y comprobar que nos muestra el número de versión adecuado. También podemos ejecutar el comando `npm - v` para comprobar la versión que se ha instalado del gestor NPM (que no tiene por qué coincidir con la de Node).

## Instalar Nginx

Veamos cómo descargar, instalar y poner en marcha una instancia básica de Nginx. Los primeros pasos son similares a cualquier otra herramienta bajo sistemas Linux: actualizamos repositorios e instalamos el paquete:

```
sudo apt update
sudo apt install nginx
```

> **NOTA**: si ya tenemos una instancia de otro servidor (por ejemplo, Apache), corriendo en el puerto 80, es conveniente que detengamos el servicio temporalmente, para que Nginx pueda completar su instalación y puesta en marcha en dicho puerto 80. Más adelante veremos cómo podemos cambiar el puerto y hacer que cada servidor tenga el suyo, si es necesario.

Por defecto, Nginx utiliza la misma carpeta de documentos web que Apache (`/var/www/html`), por lo que, si tenemos Apache ya instalado, Nginx utilizará esta página de inicio, y dejará la suya renombrada en la misma carpeta, en un segundo plano. Si Nginx es nuestro primer servidor, entonces al conectar al puerto 80 desde nuestro dominio (por ejemplo, *vps112233.ovh.net* o similar), veremos la página de bienvenida de Nginx.

### Configuración básica

El archivo de configuración de Nginx es `/etc/nginx/nginx.conf`. Internamente redirige o incluye otros archivos de configuración adicionales, y de hecho, gran parte de la configuración que necesitemos la haremos en esos archivos.

### Añadir hosts virtuales

La mecánica de Nginx para habilitar sitios web es similar a la utilizada por Apache: existe una carpeta `/etc/nginx/sites-available` donde definir archivos de configuración para los distintos hosts virtuales que tengamos (además de la propia carpeta `/var/www/html`), y luego existe una carpeta paralela `/etc/nginx/sites-enabled` con enlaces simbólicos a los sitios de la carpeta anterior que queramos tener activos en cada momento.

Para añadir un nuevo host virtual en Nginx, basta con añadir un nuevo archivo a la carpeta `/etc/nginx/sites-available`. Ya existe un archivo `default` que apunta a la carpeta por defecto `/var/www/html`, y lo podemos utilizar para crear un duplicado, por ejemplo, `misitio.com`, con una apariencia como ésta:

```
server {
    listen 80;
    listen [::]:80;

    root /home/usuario/pruebas;
    index index.html index.htm;

    server_name pruebas.vps112233.ovh.net;

    location / {
        try_files $uri $uri/ =404;
    }
}
```

* La directiva `listen` se emplea para indicar el puerto por el que escuchar. La segunda directiva `listen` con la sintaxis `[::]` se emplea para direcciones IPv6.
* La directiva `root` indica la carpeta raíz de los documentos de este host virtual
* La directiva `index` contiene las páginas que se van a cargar cuando se acceda a la carpeta de la web sin indicar ninguna. En este caso se buscará primero la página `index.html`, y si no se encuentra, se buscará `index.htm` en segundo lugar. También podríamos incluir aquí `index.php`, por ejemplo, si trabajamos con PHP.
* La directiva `server_name` es el nombre asociado al host virtual (normalmente, un alias o subdominio)
* Los grupos `location` se emplean para configuraciones particulares de ciertas rutas. En este caso, se emite un código 404 en el caso de que el archivo solicitado no se encuentre.

Una vez tenemos el sitio configurado, para hacerlo visible debemos crear un enlace simbólico de este archivo en la carpeta `sites-enabled`, con el siguiente comando (en una sola línea):

```
sudo ln -s /etc/nginx/sites-available/misitio.com 
/etc/nginx/sites-enabled
```

### Redirección de peticiones

En algunos tipos de aplicaciones, como por ejemplo aplicaciones SPA (*Single Page Applications*), o hechas con frameworks como Angular, puede resultar interesante redirigir cualquier URL que solicite el cliente a un único recurso (por ejemplo, a la página `index.html` en la raíz de la aplicación). Para eso, podemos crear un archivo de configuración (copia de `default.conf`, como en el caso anterior), como éste. La línea con la instrucción `rewrite` se encarga de la redirección propiamente dicha.

```
server {
    listen       80;
    server_name  pruebas.nachoib.ovh;

    root /home/debian/pruebas;
    rewrite ^\/.+$ /index.html last;

    location / {
    }
    ...
```

### El archivo *favicon.ico* y los errores en el *log*

En algunos casos, al cargar una URL se tiende a buscar el archivo por defecto "favicon.ico", y si no se encuentra nos podemos encontrar con mensaje de error en el navegador, o con el correspondiente mensaje de log en el archivo de errores. Para evitar esto, podemos añadir esta directiva a la configuración de nuestro host virtual:

```
location = /favicon.ico {
    return 204;
    access_log     off;
    log_not_found  off;
}
```

Por otra parte, ante cualquier error en la ejecución de Nginx, se generarán los correspondientes mensajes en el archivo de logs, ubicado en `/var/log/nginx/error.log`. Podemos consultarlo si algo va mal para tener algo más de información sobre el error. Si es debido a un error de sintaxis en algún fichero de configuración, podemos tener alguna pista de en qué archivo y línea está el error.

## Instalar PHP

Para instalar las últimas versiones de PHP, deberemos acudir a un repositorio adicional, ya que normalmente los repositorios oficiales tardan más en actualizarse. Por ejemplo, así instalaríamos PHP 7.4. En primer lugar, debemos ejecutar los siguientes comandos para descargar PHP 7.4 del repositorio correspondiente:

```
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
```

Después, instalamos tanto `php7.4` como `php7.4-fpm`, que es la herramienta que utiliza Nginx para tratamiento de páginas PHP (en el caso de que vayamos a utilizar un servidor Nginx).

```
sudo apt install php7.4
sudo apt install php7.4-fpm
```

Podemos consultar la versión instalada con estos comandos, respectivamente:

```
php -v
php-fpm7.4 -v
```

De forma similar a como hemos instalado FPM, podemos instalar otras extensiones que puedan ser necesarias en un momento dado, haciendo el correspondiente `sudo apt install php7.4-XXXX`, siendo XXXX la extensión en sí (por ejemplo, `php7.4-common`, o `php7.4-mysql`). Aunque en principio no son necesarias para la instalación de base.

### Configuración para Nginx

En lo que respecta a **Nginx**, nos faltaría habilitar PHP en él. Este paso no es tan automático y sencillo como en Apache, ya que Nginx no dispone de procesamiento PHP nativo, y requiere de unos pasos a seguir, una vez hemos instalado previamente el FPM (*FastCGI Process Manager*).

1. Abrimos el archivo `/etc/php/7.x/fpm/php.ini` (siendo la x la versión que tengamos instalada de PHP). Buscamos la línea de configuración `cgi.fix_pathinfo`, y la dejamos así, guardando el archivo al finalizar:

```
cgi.fix_pathinfo=0
```

2. También puede resultar conveniente, por problemas con permisos, hacer que se atiendan las peticiones PHP por TCP, y no a través de un archivo de socket especial que tiene php-fpm. Para ello, editamos el archivo `/etc/php/7.x/fpm/pool.d/www.conf` y comentamos esta línea y añadimos la que va a continuación:

```
;listen = /run/php/php7.0-fpm.sock
listen = 127.0.0.1:9000
```

3. Reiniciamos el procesador PHP para que acepte los nuevos cambios (sustituimos nuevamente la x por la versión que tengamos de PHP):

```
sudo systemctl restart php7.x-fpm
```

4. Indicamos a Nginx que las solicitudes a páginas PHP las pase al procesador que hemos instalado. Para ello, abrimos el archivo del host virtual que queramos configurar (por ejemplo, `/etc/nginx/sites-available/default`, o cualquier otro que hayamos creado) y hacemos lo siguiente:

    * En primer lugar, añadir el archivo index.php como uno de los posibles archivos de inicio:

```
index index.php index.html ...
```

    * Descomentamos el siguiente bloque de directivas, y lo dejamos como sigue (sustituimos, de nuevo, la x por nuestra versión de PHP):

```
location ~ \.php$ {
    include /etc/nginx/fastcgi_params;
    fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
    fastcgi_pass 127.0.0.1:9000;
}
```

Tras estos pasos, reiniciamos Nginx y probamos a cargar algún contenido PHP básico, como la llamada a `phpinfo()`.

