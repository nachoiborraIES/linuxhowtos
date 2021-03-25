# Instalación y configuración de git

En este documento se explican los pasos para descargar e instalar `git` en los diferentes sistemas, y cómo dejarlo configurado para poderlo empezar a utilizar.

## 1. Instalación

En sistemas **Linux**, se realiza con los siguientes comandos...

Para sistemas Fedora:

```
yum install git
```

Para sistemas Debian/Ubuntu:

```
sudo apt-get install git
```

Para **Windows**, descargar la versión adecuada (32/64 bits) de la [web oficial](https://git-scm.com/download/win). Es recomendable no usar la versión portable, para poder emplear los comandos desde el terminal del sistema.

Para **Mac**, descargar de la [web oficial](https://git-scm.com/download/mac).

## 2. Configuración inicial

Una vez tenemos instalado `git` en el sistema, son necesarios unos comandos adicionales que configuran ciertas variables de entorno, que nos van a permitir conectar con el servidor con nuestras credenciales. Usaremos para ello el comando `git config`. La configuración se puede almacenar a tres niveles: a nivel de sistema (parámetro `--system`, se aplica para todos los usuarios del equipo) a nivel de usuario (parámetro `--global`), y a nivel de repositorio (cada repositorio contaría con su propia configuración individual). Aquí explicaremos cómo configurar las opciones a nivel de usuario.

En primer lugar, debemos indicar cuál es nuestro nombre completo (entre comillas si tiene espacios):

```
git config --global user.name "Pepe Perez"
```

Después, indicamos nuestro correo electrónico (asociado a una cuenta de GitHub previamente creada, si es posible, para luego poder conectar con el servidor):

```
git config --global user.email correoGitHub@servidor.com
```

Opcionalmente, podemos hacer un par de pasos más. Uno de ellos es elegir el editor de preferencia para Git (el que usará Git si necesita abrir algún archivo). Por ejemplo, el bloc de notas:

```
git config --global core.editor notepad
```

Este editor se lanzará automáticamente en ciertas ocasiones. Por ejemplo, cuando hagamos una operación *commit* y no especifiquemos un mensaje asociado, Git abrirá el editor para que indiquemos dicho mensaje.

En segundo lugar, podemos especificar que las credenciales de acceso a GitHub se almacenen automáticamente en el sistema, para que no nos pida la contraseña cada vez que conectemos con un repositorio remoto. En el caso de Windows, la opción es:

```
git config --global credential.helper wincred
```

En el caso de Linux, es:

```
git config --global credential.helper cache
```

Con esto ya tendremos Git listo para usarse desde línea de comandos, e incluso desde diversos entornos que lo integren. Podemos revisar que todo esté bien establecido con el comando `git config --list`.
