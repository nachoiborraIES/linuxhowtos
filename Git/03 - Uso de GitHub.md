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

## 2. Clonado

Para clonar un repositorio de GitHub en nuestra máquina, desde la página principal de dicho repositorio vamos al botón verde de *Clone or download* y copiamos la URL del repositorio. Desde un terminal, nos ubicamos en la carpeta donde queramos tener el repositorio y hacemos un `git clone`, pegando como parámetro la URL que hemos copiado. Al clonar, nuestra rama *master* local aparecerá ya automáticamente asociada con *origin/master*.

### 2.1. Subiendo cambios

Cuando hagamos cambios en nuestro repositorio local, podemos subirlos con `git push`.

> **NOTA**: la primera vez que hagamos esto nos pedirá las credenciales para conectar a GitHub. Si hemos configurado Git en local para que guarde esas credenciales, ya no lo volverá a hacer.

### 2.2. Creación de ramas

A la hora de crear ramas en el repositorio, podemos hacerlo de dos formas:

1. Crear la rama remota y descargarla en local (con `git fetch`, por ejemplo). En este caso, cuando hagamos un `git checkout` a la rama remota, automáticamente se creará esa rama en local y quedará asociada con la remota. Para crear una rama remota, desde la página principal del repositorio, en el desplegable izquierdo *Branch* tenemos las ramas disponibles. Basta con que creemos una desde el formulario que hay.
2. Crear la rama local (con `git branch`) y subirla a remoto. Para ello, cuando vayamos a publicar los cambios de esa rama usamos el comando `git push --set-upstream origin nombre_rama`.
