# Comandos útiles de Git

En este documento se recogen algunos comandos útiles de `git` para control de versiones. Los comandos son válidos en general para diversos sistemas operativos.

## 1. Ayuda

Podemos utilizar el comando `git help` seguido del comando del que queremos obtener ayuda, para que en consola nos muestre las opciones disponibles para ese comando. Por ejemplo, con `git help config` aparecerán las opciones disponibles para el comando `git config` que habremos utilizado previamente para configurar Git en el sistema (ver documento de *instalación y configuración*).

## 2. Crear un repositorio local

Para crear un repositorio local, creamos una carpeta con el nombre que queramos, y desde dentro de la carpeta escribimos:

```
git init
```

Esto inicializará la carpeta como un repositorio Git. Internamente se habrá creado una carpeta oculta llamada `.git`, donde se almacena toda la base de datos del repositorio. No tenemos que preocuparnos por dicha carpeta.

Al repositorio podemos o bien incorporar archivos nuevos (*unmarked*) o bien editar archivos ya existentes, que pasarían a estar en estado modificado (*modified*). En cualquiera de los dos casos, para guardar los cambios debemos pasar esos archivos al área de preparación (*staged*), para que con una operación de *commit* se almacene en la base de datos (local) esa nueva versión de los mismos. Veremos estos comandos a continuación.

### 2.1. Estado del repositorio

Con el comando `git status` podemos ver en todo momento el estado del repositorio, incluyendo las ramas actuales, commits realizados, etc.

### 2.2. Añadir archivos nuevos o modificados

Si añadimos un archivo nuevo con contenido (por ejemplo, un código fuente o un archivo de texto), y lanzamos el comando `git status` anterior, nos avisará de que hay archivo(s) sin seguimiento, que deben darse de alta en el repositorio mediante el comando `git add`. Lo mismo ocurrirá si hemos modificado un archivo existente.

El comando `git add` tiene dos variantes:

Esta primera variante sirve para dar de alta un único archivo (nuevo o modificado)

```
git add nombre_archivo
```

Esta segunda opción sive para dar de alta todos los archivos nuevos o modificados:

```
git add .
```

Tras este comando, los archivos afectados pasarán al área de preparados (*staged*), para ser incluidos en el próximo *commit*.

Si, después de hacer `git add` queremos seguir haciendo cambios en alguno de los archivos implicados, no hay problema. Luego deberemos volver a hacer `git add` para añadir también esos nuevos cambios.

### 2.3. Confirmar cambios con *commit*

El comando `git commit` permite confirmar los cambios de anteriores operaciones `git add`, y generar así una nueva versión de la base de datos.

```
git commit -m "mensaje descriptivo del commit"
```

Tras la operación de *commit* los archivos afectados pasan del estado *staged* al estado *unmodified* (sin modificar desde la última versión guardada). Podemos consultar el histórico de versiones con el comando `git log`. Si volvemos a hacer cambios en cualquier archivo, pasará a estado *modified* y deberemos repetir el comando `git add` correspondiente para marcarlo como *staged* y hacer después el nuevo *commit*.

Alternativamente, también podemos usar la opción `-a`, para que se haga una operación `add` automáticamente antes, y añada los archivos pendientes a la zona de *staged*:

```
git commit -a -m "mensaje descriptivo"
```

#### 2.3.1. Ver cambios entre versiones

Con el comando `git show` podemos ver los cambios de una versión. Si no especificamos ningún parámetro adicional, nos muestra los cambios realizados en el último *commit*. Si queremos consultar cambios de algún *commit* previo, debemos indicar la referencia de dicho *commit* (un código *hash* que se genera). En realidad, basta con que indiquemos los primeros caracteres de esa referencia. Por ejemplo:

```
git show cb1fd6f8
```

### 2.3.2. Ver cambios en la versión actual

Con el comando `git diff` vemos qué cosas han cambiado de momento en la versión actual (los que aún no se han guardado con *commit*).

### 2.3.3. Asociar etiquetas a *commits*

Podemos asociar etiquetas etiquetas al último *commit* realizado, de forma que nos sea más fácil referenciarlo después, en operaciones como `git show` y no tengamos que acudir a su código *hash*. Para ello basta con usar el comando `git tag` seguido del nombre de etiqueta que queramos poner. Por ejemplo, un número de versión:

```
git tag v1.0
```

Esto se aplicará, como decimos, al último *commit* realizado. Después, podemos ver la información de ese commit o sus cambios con `git show v1.0`, además de por su código *hash*.

Si queremos asociar la etiqueta a un *commit* que no sea el último, debemos indicar el código *hash* del *commit* en cuestión:

```
git tag v1.0 cb1fd6f8
```

## 3. El archivo .gitignore

El archivo `.gitignore` se puede incluir en la raíz de un repositorio Git para definir en él qué archivos o carpetas no queremos incluir en las operaciones. Por ejemplo, archivos ejecutables, carpetas tipo *node_modules* que pueden ser muy pesadas y se pueden auto-generar, etc. La estructura de este archivo es sencilla: añadiremos una línea por cada uno de los archivos o carpetas que no queramos tener en cuenta.

```
node_modules/
*.exe
*.tmp
```

[Aquí](https://github.com/github/gitignore) podemos encontrar un listado de archivos `.gitignore` con elementos predefinidos de acuerdo a diferentes tipos de proyectos o lenguajes. Por ejemplo, qué elementos se excluyen típicamente en proyectos Node, Laravel, aplicaciones Java...

## 4. Uso de ramas

Una rama es un puntero a un *commit* determinado, y cada repositorio debe tener al menos una rama (la rama principal de todo repositorio es la rama *master*, por defecto). Además, existe un puntero llamado HEAD que apunta a la rama en la que estamos ahora mismo.

Trabajar con ramas aporta algunas ventajas:

* Podemos crear ramas para hacer pruebas que no alteren el código "real" que haya ahora mismo en producción.
* Permiten separar el trabajo en subproyectos o subtareas independientes, de forma que no interfieran unas con otras.

### 4.1. Creación de ramas

Las ramas se crean con el comando `git branch`:

```
git branch nombre_rama
```

Se crea una rama apuntando al *commit* en el que estamos actualmente.

### 4.2. Cambiar de rama

Los cambios de rama son automáticos, y el directorio de trabajo (y el puntero HEAD) cambian automáticamente al estado actual de la rama a la que vamos. Para cambiar de rama usamos el comando `git checkout`:

```
git checkout nombre_rama
```

El comando `git status` nos da información de en qué rama estamos actualmente.

### 4.3. Mostrar ramas

Con el comando `git log`, que muestra un histórico de cambios en el repositorio, podemos ver gráficamente la situación de las ramas y sus dependencias usando la opción `--graph`:

```
git log --graph
```

También podemos ver un listado de todas las ramas creadas con `git branch` (sin parámetros).





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
