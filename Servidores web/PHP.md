# Instalar PHP

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

## Configuración para Nginx

En lo que respecta a **Nginx**, nos faltaría habilitar PHP en él. Este paso no es tan automático y sencillo como en Apache, ya que Nginx no dispone de procesamiento PHP nativo, y requiere de unos pasos a seguir, una vez hemos instalado previamente el FPM (*FastCGI Process Manager*).

**Paso 1.** Abrimos el archivo `/etc/php/7.x/fpm/php.ini` (siendo la x la versión que tengamos instalada de PHP). Buscamos la línea de configuración `cgi.fix_pathinfo`, y la dejamos así, guardando el archivo al finalizar:

```
cgi.fix_pathinfo=0
```

**Paso 2.** También puede resultar conveniente, por problemas con permisos, hacer que se atiendan las peticiones PHP por TCP, y no a través de un archivo de socket especial que tiene php-fpm. Para ello, editamos el archivo `/etc/php/7.x/fpm/pool.d/www.conf` y comentamos esta línea y añadimos la que va a continuación:

```
;listen = /run/php/php7.0-fpm.sock
listen = 127.0.0.1:9000
```

**Paso 3.** Reiniciamos el procesador PHP para que acepte los nuevos cambios (sustituimos nuevamente la x por la versión que tengamos de PHP):

```
sudo systemctl restart php7.x-fpm
```

**Paso 4.** Indicamos a Nginx que las solicitudes a páginas PHP las pase al procesador que hemos instalado. Para ello, abrimos el archivo del host virtual que queramos configurar (por ejemplo, `/etc/nginx/sites-available/default`, o cualquier otro que hayamos creado) y hacemos lo siguiente:

En primer lugar, añadir el archivo index.php como uno de los posibles archivos de inicio:

```
index index.php index.html ...
```

Después, descomentamos el siguiente bloque de directivas, y lo dejamos como sigue (sustituimos, de nuevo, la x por nuestra versión de PHP):

```
location ~ \.php$ {
    include /etc/nginx/fastcgi_params;
    fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
    fastcgi_pass 127.0.0.1:9000;
}
```

Tras estos pasos, reiniciamos Nginx y probamos a cargar algún contenido PHP básico, como la llamada a `phpinfo()`.
