# Crear un acceso directo a una aplicación

Para crear un acceso directo a una aplicación, debemos crear un archivo de texto (normalmente tienen extensión `.desktop`) en el lugar que queramos. Por ejemplo, en el escritorio. Imaginemos que queremos crear un acceso directo a XAMPP. Escribiríamos algo así desde la carpeta del escritorio:

```
nano xampp.desktop
```

Después, editamos el contenido del archivo con algo como esto:

```
[Desktop Entry]
Encoding=UTF-8
Name=Manager XAMPP
Comment=Manager XAMPP
Exec=sudo /opt/lampp/manager-linux-x64.run
Icon=/opt/lampp/htdocs/favicon.ico
Categories=Aplicaciones;Programación;Web
Version=7.4.5
Type=Application
Terminal=1
```

## Añadir el acceso directo a la barra de lanzadores

Si queremos añadir el acceso directo a la barra de lanzadores inferior, dependiendo de la distribución se podrá hacer de una u otra forma. En **Lubuntu**, por ejemplo, debemos copiar el archivo de acceso directo `.desktop` que hemos creado previamente a la carpeta `/usr/share/applications` y después, haciendo clic derecho en la barra, elegimos la opción de *Configuración de barra de tareas e iniciador de aplicaciones* y elegimos el acceso directo dentro de la sección *Otras*, para añadirlo al panel.
