# Entornos de Desarrollo

En este documento se explican los pasos a seguir para instalar distintos entornos de desarrollo software sobre sistemas Debian y derivados.

## Visual Studio Code

Desde la [web oficial](https://code.visualstudio.com/) de Visual Studio Code podemos descargarlo para la plataforma deseada. 

En el caso de **Linux** (nuestra máquina virtual Lubuntu o una distribución similar), descargaremos un archivo *.deb*. Una vez descargado, accedemos por terminal a la carpeta donde esté y ejecutamos este comando para instalarlo:

```
sudo dpkg -i nombre_del_archivo.deb
```

Se creará automáticamente un acceso directo en el menú de inicio, dentro de la sección de *Programación*.

## Geany

Para instalar el editor Geany, desde línea de comandos escribimos esta instrucción:


```
sudo apt-get install geany
```

Se creará el acceso directo dentro de la sección de *Programación*.