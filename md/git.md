# Control de versiones con Git

En este documento se recogen algunos comandos útiles de `git` para control de versiones. Muchos son válidos tanto para distribuciones Debian como para otros sistemas en general.

* [Instalación](#instalación)
* [Configuración inicial](#configuración-inicial)

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