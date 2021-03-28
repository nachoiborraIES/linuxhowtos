# Comandos útiles de Git

En este documento se recogen algunos comandos útiles de `git` para control de versiones. Los comandos son válidos en general para diversos sistemas operativos.

## 1. Ayuda

Podemos utilizar el comando `git help` seguido del comando del que queremos obtener ayuda, para que en consola nos muestre las opciones disponibles para ese comando. Por ejemplo, con `git help config` aparecerán las opciones disponibles para el comando `git config` que habremos utilizado previamente para configurar Git en el sistema (ver documento de *instalación y configuración*).

## 2. Trabajar con repositorios locales

### 2.1. Crear un repositorio local

Para crear un repositorio local, creamos una carpeta con el nombre que queramos, y desde dentro de la carpeta escribimos:

```
git init
```

Esto inicializará la carpeta como un repositorio Git. Internamente se habrá creado una carpeta oculta llamada `.git`, donde se almacena toda la base de datos del repositorio. No tenemos que preocuparnos por dicha carpeta.

Al repositorio podemos o bien incorporar archivos nuevos (*unmarked*) o bien editar archivos ya existentes, que pasarían a estar en estado modificado (*modified*). En cualquiera de los dos casos, para guardar los cambios debemos pasar esos archivos al área de preparación (*staged*), para que con una operación de *commit* se almacene en la base de datos (local) esa nueva versión de los mismos. Veremos estos comandos a continuación.

#### 2.1.1. Estado del repositorio

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

También podemos crear una rama y cambiar inmediatamente a esa rama con este comando:

```
git checkout -b nombre_rama
```

El comando anterior es una abreviatura de las operaciones *branch* (reflejada en el parámetro `-b`) y *checkout*.

### 4.3. Mostrar ramas

Con el comando `git log`, que muestra un histórico de cambios en el repositorio, podemos ver gráficamente la situación de las ramas y sus dependencias usando la opción `--graph` y la opción `--all` para que incluya todas las ramas:

```
git log --graph --all
```

También podemos ver un listado de todas las ramas creadas con `git branch` (sin parámetros).

### 4.4. Fusionar ramas

Podemos unir los trabajos de dos ramas, cosa que funcionará correctamente siempre y cuando no haya solapamientos en dichos trabajos. Para ello, nos situamos con `git checkout` en la rama donde queremos aglutinar todo el trabajo (la llamaremos rama "principal"), y ejecutamos el comando `git merge` indicando el nombre de la rama que queremos fusionar con la actual (a la que llamaremos rama "secundaria"):

```
git merge nombre_rama_a_fusionar
```

#### 4.4.1. Posibles resultados y conflictos

Existen dos tipos principales de fusiones a tener en cuenta:

* **Fast-forward**: es la fusión más sencilla, cuando la fusión no implica una "vuelta atrás", es decir, la rama secundaria ha sido una continuación del último estado o *commit* de la rama principal. En este caso, se adelanta la rama principal hasta hacerla coincidir con el estado actual de la secundaria. 
* **Merge**: si la rama secundaria a fusionar parte de un commit anterior de la rama principal, entonces lo que hace Git es un nuevo commit que fusione ambas ramas, juntando los cambios posteriores a ese punto común de una y otra rama. Es una operación más costosa, donde se corre el riesgo de que haya cambios incompatibles o conflictos en algunos ficheros. 
   * En el caso de que no haya conflictos, la rama principal apuntará a ese nuevo *commit*, y la rama secundaria se quedará apuntando donde apuntaba. Si queremos que ambas ramas apunten al último y más actualizado *commit*, deberemos ir a la rama secundaria y aplicar de nuevo un *merge* para fusionarla con la principal en el nuevo punto (lo que sería un *fast-forward*).

Los **conflictos** se dan, por ejemplo, cuando se ha cambiado la misma línea en el mismo fichero por parte de ambas ramas. Esto impedirá que se pueda hacer un *merge* automático, y exigirá que el usuario lo solucione manualmente. Al editar el archivo con conflicto, Git habrá dejado unas marcas en la(s) línea(s) que han provocado dicho conflicto, indicando desde qué rama se ha hecho qué cambio. Por ejemplo:

```
<<<<<<<<< HEAD
texto añadido en la línea por parte de rama actual
=========
texto añadido en la línea por parte de rama secundaria rama1
>>>>>>>>> rama1
```

Deberemos eliminar las marcas y dejar el contenido conflictivo corregido. Después, se haría una operación de *add* y *commit* para confirmar esos cambios y generar el *commit* que integra los cambios de las dos ramas. 

Para ver qué archivos tienen conflictos después de una operación `merge` fallida, podemos emplear el comando `git status`.

### 4.5. Borrar ramas

Para borrar una rama usamos el comando `git branch` con la opción `-d` seguida del nombre de la rama a borrar. Puede ser útil, por ejemplo, tras fusionar dos ramas, para eliminar la rama secundaria que se ha fusionado:

```
git branch -d nombre_rama_a_borrar
```

## 5. Trabajando con repositorios remotos

Veremos ahora algunos comandos útiles para comunicar con repositorios remotos (alojados en GitHub).

### 5.1. Clonar un repositorio remoto

Para clonar un repositorio remoto en nuestro sistema, nos colocamos en la carpeta donde queramos clonarlo (se creará una subcarpeta con el proyecto en sí), y ejecutamos el comando:

```
git clone url_repositorio
```

Dependiendo de si es un repositorio público o privado, es posible que nos pida las credenciales para acceder y descargarlo. Una vez descargado, se le asigna un nombre por defecto, `origin`, para poderlo referenciar para futuras operaciones.

#### 5.1.1. Incluir más remotos

Podemos añadir más URLs remotas que participen en este repositorio, de forma que en cualquier momento podemos descargar actualizaciones de cualquiera de ellas, e incluso subir cambios a los remotos para los que tengamos permiso. Esto se consigue con el comando:

```
git remote add alias url_remoto
```

El `alias` es un nombre corto a nuestra elección, que servirá para referenciar este remoto en futuras operaciones. Con el comando `git remote` a secas podemos ver un listado de los remotos que tenemos incorporados en el repositorio local actualmente, y con el comando `git remote show`, seguido del nombre de un remoto, podemos ver información detallada del mismo:

```
git remote show origin
```

También podemos usar la opción `-v` con `git remote` para conocer las URLs activas del remoto, y las operaciones permitidas:

```
git remote -v
```

Ejemplo de salida:

```
git remote -v
origin	https://github.com/schacon/ticgit (fetch)
origin	https://github.com/schacon/ticgit (push)
pb	https://github.com/paulboone/ticgit (fetch)
pb	https://github.com/paulboone/ticgit (push)
```

#### 5.1.2. Renombrar y eliminar remotos

Para cambiar el nombre que le hemos dado a un remoto, usamos `git remote rename`, seguido del nombre viejo y el nombre nuevo que queremos darle:

```
git remote rename pb paul
```

Para eliminar un remoto, usamos el comando `git remote rm` seguido del nombre del remoto a eliminar:

``` 
git remote rm paul
```

### 5.2.  Actualizar contenidos desde un remoto

El comando `git fetch` permite incorporar a nuestro repositorio local todos los cambios que ha habido en un remoto determinado desde que clonamos el repositorio (o desde la última vez que hicimos *fetch*). Si no especificamos nombre de remoto, por defecto se toma `origin`, aunque podemos especificarlo igualmente.

```
git fetch origin
```

Este comando sólo trae la información nueva, pero no realiza ningún tipo de combinación. Incorporará también las ramas nuevas que se hayan creado y demás, pero deberemos ser nosotros quienes combinemos ramas o hagamos estas tareas manualmente, a través de `git merge`. Por ejemplo, así fusionaríamos la rama recién descargada del remoto con nuestra rama local, para que ambas queden actualizadas:

```
git merge origin/master
```

Como alternativa, también se tiene disponible el comando `git pull`, que descarga los cambios de una rama determinada y la mezcla automáticamente con la rama actual de nuestro repositorio local (una combinación de `fetch` y `merge`).

```
git pull
```

### 5.3. Subir cambios a un repositorio remoto

Para subir cambios a un repositorio remoto usamos el comando `git push`, indicando el nombre del remoto al que subir los cambios, y la rama remota a la que queremos subir los cambios. Este comando sube los cambios a la rama *master* del remoto *origin*.

```
git push origin master
```

Si nuestra rama local está directamente asociada a la rama remota que queremos actualizar (esto lo podemos averiguar con `git status`), no hacen falta los parámetros, podemos hacer simplemente `git push`.

Con `git log --all` podemos ver la situación de todas las ramas. Aparecerán también las ramas remotas, y en qué punto de los cambios está actualizada cada una.

### 5.4. Más sobre ramas remotas

Como hemos visto, las ramas remotas tienen la nomenclatura `nombre_del_remoto/nombre_de_la_rama`. Son ramas de sólo lectura, que nos sirven para traer a nuestro repositorio local los datos de la rama, pero no podemos modificarlas (salvo haciendo `git push`).

#### 5.4.1. Asociación de ramas locales y remotas

Por defecto, la rama local por defecto *master* se asocia con la rama remota por defecto *origin/master*, pero ¿qué ocurre cuando creamos nuevas ramas? Pueden darse dos situaciones:

* Que esa rama haya sido creada en el repositorio remoto (creada por nosotros u otra persona). En este caso, si hacemos un `git fetch` o un `git pull`, la rama se descarga, pero no se asocia a ninguna rama local. Ocurre lo mismo cuando clonamos por primera vez un repositorio con varias ramas: Git sólo nos crea en local la rama principal como *master*, pero no el resto. Para crear una rama local asociada a una de las remotas, usamos `git checkout` seguido del nombre de la rama remota. Automáticamente, *git* creará una rama local con el mismo nombre y las asociará (IMPORTANTE no usar `git branch` en este caso para crear una rama local con el mismo nombre, porque Git no la asociaría con la remota y podríamos tener problemas después):

``` 
git checkout rama1
```

* Que esa rama la creemos nosotros en local. En este caso, podemos hacer un *push* de esa rama nueva para subirla a remoto, pero para que se asocie con la rama remota, debemos enlazarlo con uno de estos dos comandos(y suponiendo que trabajamos sobre el remoto *origin*):

```
git push -u origin nombre_rama_local
git push --set-upstream origin nombre_rama_local
```

El hecho de asociar ramas no es obligatorio, pero facilita el no tener que pasar parámetros adicionales cada vez que necesitemos hacer `git push` o `git pull`.

Podemos ver las asociaciones entre ramas actuales con el comando `git branch -vv`, y el listado de ramas remotas con `git branch -r` (en este último caso, no se visualizarán las ramas que aún no se hayan actualizado en local con `git fetch` o `git pull`).
