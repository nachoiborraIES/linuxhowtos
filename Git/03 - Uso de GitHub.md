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

Permiten llevar un listado de tareas pendientes en un repositorio. Dentro de la sección de *Issues* tenemos el botón *New issue* para crear nuevos, dándoles un título y una descripción (en formato Markdown). 

> **NOTA**: es posible que la sección de *Issues* no esté visible por defecto. Podemos activarla desde los *Settings* del repositorio.

Los *issues* pueden estar abiertos o cerrados (en el caso de que ya se hayan resuelto). Para ello tenemos los botones *Comment* o *Close and comment*, según lo que queramos hacer con el *issue*.

Los *issues* también se pueden cerrar automáticamente con un *commit*, si el en el mensaje del *commit* hacemos referencia a que queremos cerrar dicho *issue*. Esto se consigue finalizando el mensaje con ciertas palabras clave (como "Close", o "Fix"), seguidas del número de *issue* que queramos cerrar. Por ejemplo:

```
git commit -m "Subidos cambios. Close #2"
```

Al hacer el *push* de este *commit* se dará por cerrado el *issue* número 2.

> **NOTA**: esta forma de cerrar *issues* sólo es posible, en principio, para la rama principal del repositorio.

#### 3.2.1. Etiquetas

Desde la opción *Labels* dentro de *Issues* podemos crear o editar etiquetas, que nos sirvan un poco para clasificar o catalogar los diferentes *issues*. Por ejemplo, por tipo de problema (error, revisión, etc) o por dificultad. Después, cuando creamos el *issue*, a la derecha tenemos una opción *Labels* para poderle asignar una etiqueta de las del catálogo.

#### 3.2.2. Hitos (*milestones*)

Los hitos son conjuntos de *issues* agrupados por un proyecto, característica o período de tiempo concreto, de forma que se pueden tratar, en parte, como una unidad.

### 3.3. Proyectos

La sección *Projects* permite organizar *issues* en planificaciones más complejas: crear tableros de planificación, prioridades, etc. Está estrechamente vinculada con la metodología ágil Kanban, de modo que podemos asignar a cada tarea su estado actual dentro del tablero Kanban. Podemos elegir una plantilla base (como por ejemplo *Automated kanban*) y se crea el tablero en cuestión. Podemos crear o arrastrar tareas entre las diferentes columnas. Con el botón "+" de cada columna podemos añadir tareas, y con el botón de *Add cards* podemos incluso utilizar *issues* abiertos como tarjetas del proyecto.

### 3.4. Wikis

Desde la sección *Wiki* podemos asociar una wiki al proyecto.

## 4. Trabajo colaborativo

Existen varias formas de permitir trabajo en equipo en un repositorio GitHub:

* Dar acceso de colaborador a otros usuarios (desde *Settings* > *Collaborators*, invitándolos con su usuario de GitHub).
* A través de *forks* y *pull requests*.

### 4.1. Fork y pull requests

En el caso de que el propietario no nos haya añadido como colaboradores, pero queramos participar en el proyecto, podemos emplear este mecanismo. Para ello, localizamos el repositorio en el que queremos colaborar, y hacemos clic en el botón *Fork* (parte derecha de la ventana). Si tenemos más de una cuenta asociada a nuestro GitHub (caso de que trabajemos con instituciones, por ejemplo) podemos elegir a qué institución/cuenta añadir el repositorio. Se creará entonces una copia en esa ubicación del repositorio original. En el repositorio original aparecerá cuántos *forks* tiene hechos.

Si queremos subir cambios al repositorio original, trabajaremos sobre nuestra copia, y una vez finalizado, haremos un **pull request** para solicitar al dueño del repositorio original que incorpore nuestros cambios. Para ello, después de haber hecho el *commit* y el *push* para subir los cambios a nuestro repositorio particular, vamos a la página principal de dicho repositorio, y vamos al botón *New pull request*, junto al desplegable de ramas, o bien desde la sección *Pull requests* (junto a las de *Issues* o *Wiki*). Al hacer esto, GitHub verificará que la actualización es posible (que no hay conflictos) y si es así nos dejará crear la petición, añadiendo opcionalmente un comentario a la misma. El propietario del repositorio original verá la opción de aceptar la *pull request* y mezclarla con su repositorio original. Si se acepta la *pull request*, aparecerá como un *commit* más en el repositorio original.

En el caso de que el repositorio original sufra cambios, para incorporarlo al repositorio personal de nuestra cuenta debemos hacerlo vía comandos. añadiendo un nuevo remoto que enlace con el repositorio original:

```
git remote add nombre_remoto url_repositorio_original
```

Como nombre de dicho remoto se suele usar *upstream*, aunque no es obligatorio. Una vez asignado, y suponiendo que lo hemos llamado *upstream*, podemos descargar los cambios que hayan hecho otros desde ese repositorio original con:

```
git fetch upstream
git merge upstream/master
```

Para subir estas actualizaciones a nuestro repositorio propio, debemos hacer `git push` después, evidentemente, ya que de lo contrario esos cambios sólo se habrán descargado en nuestra máquina local (no en GitHub).

### 4.2. Organizaciones

Desde el perfil de usuario, haciendo clic en el botón "+" de la parte superior derecha, podemos dar de alta organizaciones en nuestra cuenta de GitHub. En estas organizaciones podemos invitar a otros usuarios para que formen parte de ella, de forma que podemos crear proyectos asociados a estas organizaciones (en lugar de a nuestro usuario particular) y así vincularlos también con los usuarios que forman parte de esa organización. Se pueden hacer equipos de distintos miembros, dar permisos a cada equipo sobre ciertos repositorios (lectura, escritura, administración), etc.

## 5. GitHub pages

GitHub pages es un servicio gratuito para alojamiento de webs estáticas (HTML + CSS + JavaScript). Su web de referencia es [pages.github.com](https://pages.github.com/). Desde ahí, podemos configurar GitHub pages para:

* Un usuario u organización en concreto de nuestra cuenta. En este caso, tenemos un sitio web general para ese usuario o para esa organización (uno solo por usuario u organización). Se puede emplear como web personal o cosas similares. Para esto, debemos crear en GitHub un repositorio con nuestro nombre de usuario u organización, seguido del sufijo *.github.io*. Por ejemplo: *pepito123.github.io*. Luego, basta con clonarlo, e ir subiendo los cambios de páginas HTML, CSS o JavaScript. Podremos consultar la web en la URL indicada (*https://nombreusuario.github.io*). Por defecto, la web se asocia a la rama *master* del repositorio.

> **NOTA**: es posible que se tarden unos segundos/minutos en actualizar los cambios subidos al repositorio.
> **NOTA**: si utilizamos herramientas como Jekyll para generar la web, es posible que se produzcan errores al publicar. Podremos verlos yendo a los *Settings* del repositorio en cuestión. De lo contrario, en esos *Settings* nos dirá que nuestra web está publicada.

* Un proyecto o repositorio. En este caso, creamos un proyecto con el nombre que queramos, y en los *Settings* del repositorio (sección *GitHub pages*), podemos activar GitHub pages y elegir qué rama va a contener las páginas (o una subcarpeta *docs* dentro de la rama). En este caso, la web estará accesible en *https://nombreusuario.github.io/nombre_repositorio*.

> **NOTA**: hasta hace poco, la forma habitual de tener una web asociada a un repositorio era crear una rama llamada *gh-pages*, de forma que automáticemente GitHub tomaba esta rama como rama de contenido web. Así, al crear esta rama con el repositorio vacío, podíamos trabajar con nuestro proyecto en la rama *master*, y publicar el contenido web en la rama paralela e independiente *gh-pages*. De hecho, si creamos la rama al principio, con el repositorio vacío, GitHub la detecta automáticamente y activa GitHub pages en ella. Esta opción puede seguirse utilizando si se quiere, aunque ahora GitHub ya deja usar cualquier rama como fuente web.
