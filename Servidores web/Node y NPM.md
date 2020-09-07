# Instalar Node y NPM

Para instalar Node en un sistema Linux, haremos uso de otra herramienta llamada **NVM** (*Node Version Manager*), una herramienta que nos permite fácilmente instalar distintas versiones de Node, desinstalar versiones obsoletas, o elegir en cualquier momento cuál de las versiones que tenemos instalada queremos dejar activa. Podemos consultar información en su [web oficial en GitHub](https://github.com/nvm-sh/nvm). 

Para instalar NVM, debemos descargarlo con el comando `curl` o `wget`, según se explica en la propia web de GitHub. Si optamos por `wget`, el comando es como sigue (en una sola línea):

```
wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/
v0.35.3/install.sh | bash
```

En el caso de no disponer del comando `wget` instalado, podemos o bien instalarlo, o bien emplear este otro comando equivalente, con la orden `curl` (también en una sola línea):

```
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/
v0.35.3/install.sh | bash
```

> **NOTA**: el número de versión `v0.35.3` puede variar. Es preferible consultar la web de GitHub para obtener el comando actualizado.

> **NOTA**: después de ejecutar el comando anterior, será necesario cerrar el terminal y volverlo a abrir para poder utilizar el comando `nvm`.

Ya tenemos `nvm` instalado en el sistema. Aquí mostramos algunas de las opciones más interesantes que podemos utilizar:

* `nvm install node`: instala la última versión disponible de Node
* `nvm install --lts`: instala la última versión LTS disponible
* `nvm install 12.16.0`: instala la versión especificada de Node
* `nvm uninstall 12.16.0`: desinstala la versión especificada de Node
* `nvm ls-remote`: muestra todas las versiones disponibles para instalar
* `nvm list`: muestra todas las versiones instaladas localmente
* `nvm current`: muestra la versión actualmente activa
* `nvm use 12.16.0`: marca la versión indicada como actualmente activa
* `nvm use --lts`: marca como activa la última versión LTS instalada

En nuestro caso, vamos a instalar la última versión LTS disponible, por lo que ejecutaremos el comando:

```
nvm install --lts
```

Podemos ejecutar ahora `node -v` en el terminal y comprobar que nos muestra el número de versión adecuado. También podemos ejecutar el comando `npm - v` para comprobar la versión que se ha instalado del gestor NPM (que no tiene por qué coincidir con la de Node).
