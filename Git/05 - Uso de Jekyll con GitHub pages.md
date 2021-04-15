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

Por defecto, podremos acceder a la web en nuestra URL local (*localhost* o 127.0.0.1), por el puerto 4000 (*http://localhost:4000*). El contenido de los diferentes posts que se creen (se crea una web al estilo Wordpress) se almacenan en una carpeta llamada *_posts*.

## 2. Definiendo el contenido

Todos los archivos de contenido de Jekyll deben tener una serie de metadatos, expresados en formato YAML, delimitados por tres guiones (tanto por arriba como por abajo, lo que se conoce como *front matter*). Por ejemplo:

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
