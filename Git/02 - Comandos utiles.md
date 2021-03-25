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

#### 2.3.1. Ver cambios entre versiones

Con el comando `git show` podemos ver los cambios de una versión. Si no especificamos ningún parámetro adicional, nos muestra los cambios realizados en el último *commit*. Si queremos consultar cambios de algún *commit* previo, debemos indicar la referencia de dicho *commit* (un código *hash* que se genera). En realidad, basta con que indiquemos los primeros caracteres de esa referencia. Por ejemplo:

```
git show cb1fd6f8
```

### 2.3.2. Ver cambios en la versión actual

Con el comando `git diff` vemos qué cosas han cambiado de momento en la versión actual (los que aún no se han guardado con *commit*).








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
