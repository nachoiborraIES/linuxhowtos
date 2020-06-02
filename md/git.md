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