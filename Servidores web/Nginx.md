# Instalar Nginx

Veamos cómo descargar, instalar y poner en marcha una instancia básica de Nginx. Los primeros pasos son similares a cualquier otra herramienta bajo sistemas Linux: actualizamos repositorios e instalamos el paquete:

```
sudo apt update
sudo apt install nginx
```

> **NOTA**: si ya tenemos una instancia de otro servidor (por ejemplo, Apache), corriendo en el puerto 80, es conveniente que detengamos el servicio temporalmente, para que Nginx pueda completar su instalación y puesta en marcha en dicho puerto 80. Más adelante veremos cómo podemos cambiar el puerto y hacer que cada servidor tenga el suyo, si es necesario.

Por defecto, Nginx utiliza la misma carpeta de documentos web que Apache (`/var/www/html`), por lo que, si tenemos Apache ya instalado, Nginx utilizará esta página de inicio, y dejará la suya renombrada en la misma carpeta, en un segundo plano. Si Nginx es nuestro primer servidor, entonces al conectar al puerto 80 desde nuestro dominio (por ejemplo, *vps112233.ovh.net* o similar), veremos la página de bienvenida de Nginx.

## Configuración básica

El archivo de configuración de Nginx es `/etc/nginx/nginx.conf`. Internamente redirige o incluye otros archivos de configuración adicionales, y de hecho, gran parte de la configuración que necesitemos la haremos en esos archivos.

## Añadir hosts virtuales

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

## Redirección de peticiones

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

## El archivo *favicon.ico* y los errores en el *log*

En algunos casos, al cargar una URL se tiende a buscar el archivo por defecto "favicon.ico", y si no se encuentra nos podemos encontrar con mensaje de error en el navegador, o con el correspondiente mensaje de log en el archivo de errores. Para evitar esto, podemos añadir esta directiva a la configuración de nuestro host virtual:

```
location = /favicon.ico {
    return 204;
    access_log     off;
    log_not_found  off;
}
```

Por otra parte, ante cualquier error en la ejecución de Nginx, se generarán los correspondientes mensajes en el archivo de logs, ubicado en `/var/log/nginx/error.log`. Podemos consultarlo si algo va mal para tener algo más de información sobre el error. Si es debido a un error de sintaxis en algún fichero de configuración, podemos tener alguna pista de en qué archivo y línea está el error.