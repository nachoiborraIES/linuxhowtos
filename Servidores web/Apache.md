# Instalar Apache como servidor independiente

Si queremos instalar Apache como un servidor independiente (y no incluido en un sistema XAMPP) escribimos este comando:

```
sudo apt-get install apache2
```

Se instalará Apache como un servicio, que se auto-arranca al iniciar el sistema. 

## Parada y puesta en marcha

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

## Configuración básica

La configuración básica de Apache se encuentra en el archivo `/etc/apache2/apache2.conf`. Puede ser buena idea hacer una copia del archivo original:

```
sudo cp /etc/apache2/apache2.conf /etc/apache2/apache2.conf.original
```

Dentro de este archivo de configuración hay poco que modificar. Entre otras cosas, podemos consultar o cambiar la propiedad `DocumentRoot` que referencia a la carpeta donde se ubicarán por defecto los documentos web, y que es `/var/www/html`. Además, los posibles errores al iniciar o estar en marcha Apache se volcarán al archivo indicado por la propiedad `ErrorLog`, cuyo valor por defecto es `/var/log/apache2/error.log`.

Finalmente, si queremos modificar los **puertos** por defecto por los que escucha Apache, debemos hacerlo en el archivo `/etc/apache2/ports.conf`. Podemos, por ejemplo, añadir otros puertos alternativos a los que ya hay, añadiendo más directivas `Listen` a ese archivo.

## Definir hosts virtuales

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
