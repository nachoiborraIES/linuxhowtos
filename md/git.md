# Control de versiones con Git

En este documento se recogen algunos comandos útiles de `git` para control de versiones. Muchos son válidos tanto para distribuciones Debian como para otros sistemas en general.

## Instalación

La instalación de la herramienta `git` en sistemas Debian y derivados es sencilla:

```
sudo apt-get install git
```

## Configuración inicial

Una vez tengamos instalada la herramienta `git`, debemos configurar nuestro nombre de usuario y cuenta de correo electrónico, con estos comandos:

```
git config --global user.name "nuestro_nombre"
git config --global user.email "nuestro_email"
```

## Clonar un repositorio remoto

Para clonar un repositorio remoto en nuestro sistema, nos colocamos en la carpeta donde queramos clonarlo (se creará una subcarpeta con el proyecto en sí), y ejecutamos el comando:

```
git clone url_repositorio
```

Dependiendo de si es un repositorio público o privado, es posible que nos pida las credenciales para acceder y descargarlo.

## Actualizar un proyecto desde un repositorio remoto

Si queremos descargar los últimos cambios que haya hechos en un repositorio remoto sobre un proyecto local previamente clonado, desde la carpeta del proyecto ejecutamos este comando:

```
git pull
```

Nuevamente, dependiendo de si es un repositorio privado o público, es posible que nos pida las credenciales para acceder.

## Crear un proyecto en Visual Studio Code y subirlo por primera vez a un repositorio nuevo en GitHub

Para este proceso debemos seguir estos pasos (suponiendo que ya tenemos la herramienta `git` instalada, siguiendo los pasos comentados en puntos anteriores).

1. Creamos un repositorio nuevo (privado o público) y **vacío** (sin archivo README, ni *.gitignore* ni nada), en GitHub
2. Creamos el proyecto en Visual Studio Code, con el contenido que queramos
3. Ejecutamos estos comandos para crear una conexión entre nuestro proyecto local y nuestro repositorio remoto, y subir los cambios:

```
echo "# prueba" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/...ruta.../prueba.git
git push -u origin master
```

> **NOTA**: el nombre del proyecto en el ejemplo anterior es *prueba*, que deberá cambiarse por el del proyecto en cuestión. Las primeras líneas para crear el archivo `README.md` pueden obviarse si ya lo hemos creado mediante otros medios previamente.

A partir de este punto, ya podemos usar la integración de *git* con Visual Studio Code, y las opciones del panel de *Source Control* en la parte izquierda, para marcar los cambios, hacer los *commits* y subirlos al servidor (con la opción *Sync* o con *Push*).