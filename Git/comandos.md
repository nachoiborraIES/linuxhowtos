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

Al repositorio podemos o bien incorporar archivos nuevos (*unmarked*) o bien editar archivos ya existentes, que pasarían a estar en estado modificado (*modified*). En cualquiera de los dos casos, para guardar los cambios debemos pasar esos archivos al área de preparación (*staged*), para que con una operación de *commit* se almacene en la base de datos (local) esa nueva versión de los mismos. Veremos estos comandos más adelante.

### 2.1. Estado del repositorio

Con el comando `git status` podemos ver en todo momento el estado del repositorio, incluyendo las ramas actuales, commits realizados, etc.







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
