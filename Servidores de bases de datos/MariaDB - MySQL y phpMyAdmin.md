# MariaDB/MySQL

Para instalar MariaDB/MysQL tenemos dos opciones:

* Utilizar un sistema XAMPP, que ya integra este servidor junto con Apache y PHP. En este caso, la información de la instalación está disponible en la sección de *Servidores Web*.
* Utilizar una instalación independiente, que es la que veremos aquí.

Para instalar MariaDB, escribimos el siguiente comando:

```
apt update
apt install mariadb-server
```

> **NOTA**: si queremos instalar MySQL en lugar de MariaDB, los pasos a seguir son los mismos, pero en el comando anterior cambiaremos el paquete `mariadb-server` por `mysql-server`.

Tras la instalación, podemos ejecutar con permisos de *root* el comando:

```
mysql_secure_installation
```

para asegurar algunos aspectos que quedan poco seguros en la instalación por defecto, como la contraseña de root o el acceso remoto o anónimo.

* Podemos establecer la contraseña de root en el primer paso de este asistente
* En el siguiente paso (Remove anonymous users), conviene responder que sí (Y)
* En el tercer paso (Disallow root login remotely), podemos elegir, aunque quizá convenga elegir que sí (Y)
* El siguiente paso (Remove test database and access to it), también podemos responder que sí (Y)
* Finalmente, recargamos la tabla de privilegios de los usuarios (Y) y ya está listo.

Una vez finalizada esta configuración, para iniciar, detener o reiniciar el servidor, escribiremos estos comandos, respectivamente:

```
/etc/init.d/mysql start
/etc/init.d/mysql stop
/etc/init.d/mysql restart
```

## Instalar phpMyAdmin

La forma más sencilla de gestionar nuestras bases de datos MySQL (o MariaDB) quizá sea a través de la aplicación *phpMyAdmin*, el cliente web por excelencia para gestionar las bases de datos de este tipo. Para poderlo utilizar, necesitamos tener instalado un servidor Apache o Nginx (consulta la sección de *Servidores Web* para la opciones de instalación). La herramienta *phpMyAdmin* en sí se instala con el siguiente comando (en modo *root* o con permisos de superusuario):

```
apt-get install phpmyadmin
```

Durante la instalación, nos pedirá los siguientes datos:

* Si queremos configurar algún servidor automáticamente para phpMyAdmin. Nos da la opción de Apache (no la de Nginx), así que podemos elegir Apache para que lo configure automáticamente.
* Nos indicará que necesita tener una base de datos por defecto a la que acceder,y que si crea la base de datos por defecto. Podemos contestar que sí.
* Finalmente, nos pedirá el password para acceder a phpMyAdmin desde el navegador, y que lo confirmemos después.

Tras los pasos anteriores, ya podemos acceder a phpMyAdmin con el nombre de nuestro dominio y el puerto por el que esté escuchando Apache. Por ejemplo:

```
http://vps112233.ovh.net/phpmyadmin
```

### Configuración para Nginx

En el caso de querer utilizar phpMyAdmin con **Nginx**, podemos hacer un enlace simbólico de la carpeta de instalación de phpMyAdmin (`/usr/local/phpmyadmin`) a la carpeta de nuestra aplicación web. Por ejemplo, si queremos acceder desde la carpeta general de aplicaciones de Nginx:

```
ln -s /usr/share/phpmyadmin /var/www/html
```

Después, editamos el archivo de configuración de esa carpeta (en nuestro ejemplo, sería el archivo `/etc/nginx/sites-available/default`, y añadimos la configuración para PHP, si no la tiene. También convendría dejar como globales la ruta raíz de la aplicación (*root*) y los archivos de inicio por defecto. Podría quedar algo así:

```
server {
    listen       80;
    server_name  localhost;

    root   /var/www/html;
    index  index.html index.php;

    location / {
    }

    location ~ \.php$ {
        include /etc/nginx/fastcgi_params;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        fastcgi_pass 127.0.0.1:9000;
    }
    ...
```