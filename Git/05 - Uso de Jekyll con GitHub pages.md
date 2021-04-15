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

También en este caso, las páginas disponen de un *front matter* con los metadatos. En estos casos se incluye normalmente el *layout* o plantilla de diseño que se utiliza (suele ser el layout *post* para los posts, y el layout *page* para las páginas), el título, etc. En el caso de las páginas, también se puede definir el *permalink* que se emplea en la URL para referenciar a la página.
