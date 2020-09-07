# MongoDB

MongoDB se puede instalar para inicio manual o como servicio.

## Instalación para arranque manual

Para instalar MongoDB para iniciarlo manualmente, debemos ir a la [web oficial](https://www.mongodb.com/es), y a la sección de descargas (*Try Free*) y, en la pestaña de *Server*, descargar el servidor en formato TGZ. Después, lo descomprimimos en una carpeta localizable (por ejemplo, en nuestra carpeta de usuario, `/home/usuario/mongo`, donde "usuario" será nuestro login). También es recomendable en este caso crear una carpeta donde almacenaremos las bases de datos. Esta carpeta suele llamarse `mongo-data`, y ubicarse de forma paralela al servidor (por ejemplo, en `/home/usuario/mongo-data`). Después, para iniciar el servidor, accedemos a la subcarpeta `/home/usuario/mongo/bin` y escribimos este comando:

```
./mongod --dbpath /home/usuario/mongo-data
```

Indicamos en el comando dónde se van a almacenar los datos (la carpeta que hemos creado). 

> **NOTA**: dependiendo de la distribución de Linux que estemos usando y la versión, es posible que nos dé algún error indicando que falta alguna dependencia, normalmente de alguna librería *libcurl*. Bastará con instalarla para solucionar el problema. Por ejemplo:

```
sudo apt-get install libcurl3
```

## Instalación como servicio

Para instalar MongoDB en un servidor real, lo propio es instalarlo como servicio. Los pasos a seguir son, como usuario *root*:

```
apt-get update
apt-get install mongodb
```

Tras esto, ya podemos lanzar y detener Mongo con el servicio:

```
/etc/init.d/mongodb start
/etc/init.d/mongodb stop
/etc/init.d/mongodb restart
```

## Habilitar conexiones externas

Podríamos utilizar un cliente *Robo 3T* para conectar a nuestro servidor MongoDB. En el caso de una conexión remota, antes debemos habilitar MongoDB para aceptar estas conexiones. Para ello, editamos el archivo `/etc/mongodb.conf` y comentamos esta línea:

```
#bind_ip = 127.0.0.1
```

Reiniciamos el servicio de MongoDB, y después iniciamos Robo3T y creamos una nueva conexión a nuestro servidor (por ejemplo, *vps112233.ovh.net*) por el puerto que sea. Recordemos que el puerto por defecto es 27017, pero se puede modificar con la directiva `port` en el archivo de configuración anterior:

```
port = 27017
```

## Instalar Robo3T

Para una gestión más amigable de bases de datos MongoDB, podemos emplear un gestor gráfico como RoboMongo (actualmente llamado Robo 3T). Es un gestor gratuito y multiplataforma, que se puede descargar desde su [web oficial](https://robomongo.org/). Debemos atenernos a *Robo3T*, y no a *Studio3T*, que es la versión profesional y de pago. En la sección de descargas (Download) podremos elegir la versión que se adapte a nuestro sistema operativo (Windows, Mac o Linux). En el caso de **Linux**, disponemos de un archivo *.tar.gz* que podemos descomprimir, y después podemos ejecutar el programa desde la subcarpeta `bin`, o bien crear un acceso directo en un lugar más accesible (consulta la sección de *Gestión del Sistema Operativo* para averiguar cómo crear los accesos directos).