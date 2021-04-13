# Uso de GitHub

**GitHub** es un servidor donde alojar repositorios Git de forma remota. Existen distintas alternativas para alojar repositorios remotos Git:

* GitHub (la más popular)
* BitBucket
* GitLab

Algunas, como GitLab, ofrecen algunas mejoras, como el tener en el mismo sitio todas las herramientas integradas (integración, despliegue, etc).

## 1. Registro y primeros pasos

Para registrarnos, basta con acceder a la [web oficial](https://github.com/) (en este caso, de GitHub) y elegir la opción de registro (parte superior derecha, *Sign up*). Una vez registrados, también desde la parte superior derecha podremos ver nuestro perfil de usuario (*profile*) y cambiar los ajustes de la cuenta (*settings*). En esta última opción, entre otras cosas, podemos configurar cuentas de correo vinculadas, cambiar contraseña, etc.

### 1.1. Creación de repositorios

Se crean con el botón superior derecho de "+" (eligiendo *New repository*), o desde el perfil del usuario (icono superior izquierdo), clicando después en el botón verde *New*. Indicaremos el nombre del repositorio, si es público o privado, si queremos algún archivo `.gitignore` para un tipo de proyecto determinado (Java, Node, etc) y si tiene algún tipo de licencia de uso (MIT, etc). También podemos inicializar el repositorio con un *commit* inicial donde, además de los archivos anteriores (`.gitignore` y licencia), se añadirá un archivo `README` al repositorio, que suele ser un archivo de presentación que muestra a los visitantes la información esencial del proyecto.

#### 1.1.1. Configuración del repositorio

Desde la página principal del repositorio, tenemos también un icono de *Settings* donde podemos establecer algunas opciones útiles de configuración, como por ejemplo:

* Definir los **colaboradores** del proyecto (otros usuarios de GitHub que pueden acceder al mismo y hacer cambios), desde el apartado *Collaborators*.
* Eliminar el repositorio desde el apartado *Options*. Al final de la página tenemos un botón para ello, que nos pedirá que confirmemos el nombre del repositorio antes de borrarlo.
* Establecer la rama por defecto desde el apartado *Branches*.
* Establecer *webhooks*, servicios que se pueden adjuntar en un *commit* para ejecutar tareas adicionales (integración continua, despliegue, etc.)

## 2. Clonar y gestionar cambios en repositorio remoto

Para clonar un repositorio de GitHub en nuestra máquina, desde la página principal de dicho repositorio vamos al botón verde de *Clone or download* y copiamos la URL del repositorio. Desde un terminal, nos ubicamos en la carpeta donde queramos tener el repositorio y hacemos un `git clone`, pegando como parámetro la URL que hemos copiado. Al clonar, nuestra rama *master* local aparecerá ya automáticamente asociada con *origin/master*.

### 2.1. Subiendo cambios

Cuando hagamos cambios en nuestro repositorio local, podemos subirlos con `git push`.

> **NOTA**: la primera vez que hagamos esto nos pedirá las credenciales para conectar a GitHub. Si hemos configurado Git en local para que guarde esas credenciales, ya no lo volverá a hacer.

### 2.2. Creación de ramas

A la hora de crear ramas en el repositorio, podemos hacerlo de dos formas:

1. Crear la rama remota y descargarla en local (con `git fetch`, por ejemplo). En este caso, cuando hagamos un `git checkout` a la rama remota, automáticamente se creará esa rama en local y quedará asociada con la remota. Para crear una rama remota, desde la página principal del repositorio, en el desplegable izquierdo *Branch* tenemos las ramas disponibles. Basta con que creemos una desde el formulario que hay.
2. Crear la rama local (con `git branch`) y subirla a remoto. Para ello, cuando vayamos a publicar los cambios de esa rama usamos el comando `git push --set-upstream origin nombre_rama` (la opción `--set-upstream` sirve para asociar ramas local y remota).

### 2.3. Historial de cambios

Con el botón *History* vemos un historial de en qué *commits* se ha cambiado el fichero que estamos examinando. Con el botón *Blame* vemos más concretamente en qué commits se han cambiado qué líneas. El botón *Raw* nos permite ver el texto plano del archivo (útil para copiar y pegar).

## 3. Otras funcionalidades de GitHub

### 3.1. GitHub como red social

En GitHub también podemos realizar algunas funciones típicas de una red social, tales como:

* Seguir ciertos proyectos de otros desarrolladores (*Watch/Unwatch*)
* Valorar los proyectos (*Star*)
* Comentar los proyectos, o ciertos *commits*, o ciertas líneas de un determinado archivo. Estos comentarios se realizan en formato Markdown, con el editor que proporciona la plataforma.

### 3.2. Issues

Permiten llevar un listado de tareas pendientes en un repositorio. Dentro de la sección de *Issues* tenemos el botón *New issue* para crear nuevos, dándoles un título y una descripción (en formato Markdown). Los *issues* pueden estar abiertos o cerrados (en el caso de que ya se hayan resuelto). Para ello tenemos los botones *Comment* o *Close and comment*, según lo que queramos hacer con el *issue*.

Los *issues* también se pueden cerrar automáticamente con un *commit*, si el en el mensaje del *commit* hacemos referencia a que queremos cerrar dicho *issue*. Esto se consigue finalizando el mensaje con ciertas palabras clave (como "Close", o "Fix"), seguidas del número de *issue* que queramos cerrar. Por ejemplo:

```
git commit -m "Subidos cambios. Close #2"
```

Al hacer el *push* de este *commit* se dará por cerrado el *issue* número 2.

> **NOTA**: esta forma de cerrar *issues* sólo es posible, en principio, para la rama principal del repositorio.

#### 3.2.1. Etiquetas

Desde la opción *Labels* dentro de *Issues* podemos crear o editar etiquetas, que nos sirvan un poco para clasificar o catalogar los diferentes *issues*. Por ejemplo, por tipo de problema (error, revisión, etc) o por dificultad. Después, cuando creamos el *issue*, a la derecha tenemos una opción *Labels* para poderle asignar una etiqueta de las del catálogo.
