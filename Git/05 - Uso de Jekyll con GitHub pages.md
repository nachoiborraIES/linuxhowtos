# Uso de Jekyll con GitHub pages

Jekyll es un gestor de contenidos estático (sin parte de *backend* ni base de datos al uso), que nos va a permitir definir unas plantillas de diseño para nuestro sitio web en GitHub pages, independiente del contenido que se vaya a mostrar en él. Jekyll tiene un proceso de compilación que aúna ambas partes (las plantillas de diseño con el contenido), y afortunadamente GitHub pages integra Jekyll, con lo que no tendremos que preocuparnos de este proceso de compilación.

La web oficial es [jekyllrb.com](https://jekyllrb.com). Está basado en Ruby, por lo que también será necesario tenerlo instalado. En la página de [instalación](https://jekyllrb.com/docs/installation) tenemos los detalles y pasos a seguir en cada sistema operativo.

## 1. Creación de proyectos

Una vez tengamos instalado Jekyll y sus herramientas siguiendo los pasos del documento de instalación comentado antes, ya podemos crear proyectos. Para ello, vamos a la carpeta donde queramos tener el proyecto y escribimos:

```
jekyll new nombre_proyecto
```

Se creará una carpeta con el nombre del proyecto, con un contenido predefinido.

### 1.1. Puesta en marcha

En cualquier momento podemos poner en marcha una especie de servidor local, para poder probar la web que estemos haciendo. Para ello usamos este comando desde dentro del proyecto Jekyll:

```
bundle exec jekyll serve
```

Por defecto, podremos acceder a la web en nuestra URL local (*localhost* o 127.0.0.1), por el puerto 4000 (*http://localhost:4000*). 

## 2. Definiendo el contenido

En Jekyll podemos especificar dos tipos principales de contenido: posts o páginas.

### 2.1. Uso de posts

Los posts de Jekyll funcionan de forma similar a los de Wordpress. Todos ellos deben tener una serie de metadatos, expresados en formato YAML, delimitados por tres guiones (tanto por arriba como por abajo, lo que se conoce como *front matter*). Por ejemplo:

```
---
layout: post
title: "Welcome to Jekyll!"
date: 2021-04-15 10:44:22 + 0200
categories: jekyll update
---

... contenido del post
```

El contenido del post en sí se puede expresar tanto en HTML como en formato Markdown. Para crear posts, basta con añadir nuevos archivos a la carpeta *_posts*, con el formato de nombre de fichero del que viene como ejemplo:

```
AÑO-MES-DIA-titulo.md
```

donde, como hemos dicho, además de la extensión *.markdown* o *.md* también se acepta *.html*.

### 2.2. Uso de páginas

Las páginas del sitio se crean en la raíz del proyecto, bien con extensión Markdown (*.md*) o con extensión *.html*. En el primer caso, la URL para acceder a la página tendrá el mismo nombre de archivo, pero con extensión *.html*.

> **EJEMPLO**: si creamos una página llamada `prueba.md` en la raíz del proyecto, podremos acceder a su contenido con *localhost:4000/prueba.html*.

También en este caso, las páginas disponen de un *front matter* con los metadatos. En estos casos se incluye normalmente el *layout* o plantilla de diseño que se utiliza (suele ser el layout *post* para los posts, y el layout *page* para las páginas), el título, etc. En el caso de las páginas, también se puede definir el *permalink* que se emplea en la URL para referenciar a la página (en lugar de su nombre).

### 2.3. Otros elementos

Además de los posts y las páginas, la estructura principal del proyecto Jekyll muestra otros tipos de elementos.

* Las gemas de Jekyll, que no trataremos aquí.
* Una página `404.html` que podemos editar para definir una página a la que se enviará cuando las URLs que se indiquen no se encuentren en la web.
* Una carpeta `_site` que contiene el sitio automáticamente compilado por Jekyll. Esta carpeta está automáticamente incluida en un archivo `.gitignore` que también se crea, para que no se suba al repositorio remoto.
* Un archivo `config.yml` de configuración del proyecto, donde podemos cambiar entre otras cosas el título de la web, el e-mail de contacto, la breve descripción, y sobre todo un par de parámetros que debemos definir para que la web sea accesible en GitHub pages: la `baseurl` y la `url`.

## 3. Subir cambios a GitHub

Para subir los cambios de nuestro sitio Jekyll a GitHub, tenemos varias opciones.

### 3.1. Crear repositorio local y subirlo a remoto

Podemos ejecutar un comando `git init` dentro del proyecto Jekyll local para inicializar un repositorio, y luego subir los cambios a un repositorio remoto con estos pasos:

1. Añadir los archivos con `git add .`
2. Hacer un commit inicial con `git commit -m "Commit inicial"`
3. Crear un repositorio remoto en GitHub con el nombre que queramos (sin archivo *README* ni ningún contenido)
4. Conectar el repositorio local con el remoto usando el comando `git remote add origin url_repositorio_remoto`
5. Hacer un *push* inicial. La primera vez habrá que indicar el nombre de la rama remota para que se emparejen: `git push -u origin master`
6. Activar el servicio de GitHub pages en la rama adecuada del repositorio remoto.

### 3.2. Configurar las URL

Comentábamos que en el archivo `config.yml`, entre otras cosas, es necesario configurar los parámetros `baseurl` y `url` para que la web cargue correctamente en GitHub pages.

* El parámetro `baseurl` debe tener el nombre del repositorio donde se ha creado la web (salvo que sea una web de usuario o de organización). Por ejemplo:

```
baseurl: "/prueba"
```

* El parámetro `url` debe tener la URL de la web (sin contar la *baseurl* anterior). Por ejemplo:

```
url: "https://pepe123.github.io"
```

Con esto, ya se sabe que la web será accesible desde *https://pepe123.github.io/prueba*, y las plantillas de diseño y demás se localizarán correctamente.
* 
