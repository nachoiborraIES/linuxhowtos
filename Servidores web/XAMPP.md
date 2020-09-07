# Instalar Apache, PHP y MysQL como XAMPP

Para instalar XAMPP, basta con descargarlo de su [web oficial](https://www.apachefriends.org/es/index.html) y seguir los pasos del asistente. Debemos dar permisos de ejecución y ejecutar el archivo *.run* que descarguemos desde algún terminal, con permisos de administrador (*sudo*). Suponiendo que el archivo se llame *xampp-linux-x64-7.4.5-installer.run*, por ejemplo, los pasos son los siguientes (desde la carpeta donde lo hemos descargado):

```
sudo chmod +x xampp-linux-x64-7.4.5-installer.run
sudo ./xampp-linux-x64-7.4.5-installer.run
```

Se iniciará un asistente que instalará XAMPP. El *manager* de XAMPP será la herramienta que usaremos para ponerlo en marcha, y se encuentra en **/opt/lampp/manager-linux-x64.run**. Podemos acceder a la carpeta desde el terminal para ejecutarlo (con permisos de superusuario), o bien crear algún acceso directo en otra ubicación que nos resulte más cómoda. Consulta la sección de *Gestión del Sistema Operativo* para ver cómo crear accesos directos a aplicaciones.

## Configuración de apache y hosts virtuales

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
