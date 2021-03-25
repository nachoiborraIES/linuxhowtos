# Visual Studio Code y git

Veremos a continuación cómo integra el IDE Visual Studio code las herramientas *git* para control de versiones.

## Clonar un repositorio existente remoto

Para utilizar desde Visual Studio Code un repositorio existente en GitHub, basta con que lo clonemos en local, abramos la carpeta con Visual Studio Code y empecemos a trabajar en él. Para subir los cambios actualizados al repositorio, desde la opción izquierda de *Source Control*, marcamos los cambios (*stage*), hacemos el *commit* con un comentario, y después desde el botón de más opciones (puntos suspensivos), elegimos la opción de *Push*. Desde este mismo panel tenemos la opción de *Pull* para actualizar en local cambios hechos desde otro equipo.

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
