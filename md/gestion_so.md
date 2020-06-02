# Gestión del Sistema Operativo

En este documento se explican las instrucciones para algunas operaciones habituales de gestión del sistema operativo Debian y derivados (Ubuntu, Lubuntu, etc).

* [Crear usuarios y grupos](#Crear-usuarios-y-grupos)
* [Cambiar configuración del teclado](#Cambiar-configuración-del-teclado)

## Crear usuarios y grupos

Una de las tareas básicas esenciales en un sistema operativo es la capacidad de poder crear usuarios con sus contraseñas, y asignarlos a grupos.

### Crear grupo

Para crear un grupo, ejecutamos este comando:

```
sudo groupadd nombre_grupo
```

Por ejemplo, así crearíamos un grupo `usuarios`:

```
sudo groupadd usuarios
```

### Crear un usuario y asignarlo a un grupo

Para crear un usuario y asignarlo a un grupo, primero debemos crearle su carpeta de usuario (normalmente en la carpeta `home` o alguna subcarpeta interna) y asignarle los permisos correspondientes. Por ejemplo, para crear una carpeta para el usuario `usuario1`, podríamos hacer algo así:

```
mkdir /home/usuario1
chmod -R 777 /home/usuario1
```

También podríamos haber elegido alguna subcarpeta que lo identificara como miembro del grupo, como por ejemplo `/home/usuarios/usuario1`.

Una vez creada la carpeta, pasamos a crear el usuario, asignándolo al grupo y a la carpeta que ya hemos creado:

```
sudo useradd -g usuarios -d /home/usuario1 -c "Usuario 1" usuario1
```

donde el parámetro `-g` indica el nombre del grupo al que se asigna, el parámetro `-d` indica cuál será su carpeta de inicio, y el parámetro `-c` indica el nombre del usuario. El último dato que aparece en el comando anterior es el login del usuario que hemos creado.

Finalmente, creamos la contraseña del usuario:

```
sudo passwd usuario1
```

Este comando nos pedirá que indiquemos la contraseña, y ya se quedará guardada.

### Gestionar usuarios de forma gráfica

Para gestionar usuarios de forma gráfica, podemos ir al menú *Herramientas del Sistema* > *Usuarios y grupos*. Ahí podemos, por ejemplo, crear un nuevo usuario con el login y password que queramos, y darle (o no) permisos de administrador.

## Cambiar configuración del teclado

Para cambiar la configuración del teclado a, por ejemplo, español, escribimos este comando:

```
setxkbmap -layout "es"
```

Para que el cambio sea permanente, debemos añadir este comando a las tareas de inicio del sistema. En Lubuntu, por ejemplo, debemos ir al menú *Preferencias* > *Aplicaciones predeterminadas para LXSession* > *Inicio automático*, y escribir el comando en el cuadro habilitado para ello.

## Cambiar idioma del sistema

En ocasiones con la instalación inicial (o si descargamos una máquina virtual ya hecha en otro idioma) la configuración inicial de idioma no es la correcta. Para cambiarla, en **Lubuntu** debemos ir al menú *Preferences* > *Language Support*, e instalar el paquete de idiomas deseado. Tras instalarlo, debemos arrastrarlo al inicio de la lista de idiomas disponibles, para que sea el idioma por defecto, y después pulsar en el botón *Apply System-Wide* para aplicar los cambios a todo el sistema, e incluso renombrar las carpetas de Descargas, Escritorio, etc.