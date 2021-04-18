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

> **IMPORTANTE**: al cambiar la variable *baseurl*, ésta también afecta a la URL local de pruebas, que dejará de ser *localhost:4000*, y pasaría a ser *localhost:4000/prueba* según el ejemplo anterior.

> **IMPORTANTE**: cualquier cambio en el archivo `config.yml` requiere reiniciar el servidor de pruebas, si lo tenemos lanzado en local.

## 4. Uso de plantillas

Por defecto, cuando creamos un proyecto Jekyll, en el archivo `config.yml` se especifica una plantilla o tema por defecto, en la propiedad `theme`:

```
theme: minima
```

Existen una serie de temas predefinidos y soportados por GitHub Pages, que podemos consultar [aquí](https://pages.github.com/themes/). Sin embargo, si queremos utilizar ese mismo tema en local para hacer pruebas previas, debemos descargarlo, y para ello, debemos modificar el archivo *Gemfile* del proyecto, y añadir el tema en cuestión. Por ejemplo, así añadiríamos el tema *architect*:

```
gem "minima", "->2.0"
gem "architect"
```

Después, procedemos a actualizar las gemas del proyecto para instalar el nuevo tema, con el comando `bundle install`. Después, de esto, ya podemos cambiar la propiedad *theme* en el archivo *config.yml* y lanzar de nuevo el servidor local. Aún así, es posible que algunos temas no tengan los mismos *layouts* que otros, y al poner en marcha Jekyll en local nos diga que no encuentra algunos *layouts*. Entonces, debemos ir a la página del tema en cuestión (podemos acceder a cada una desde el enlace anterior de temas soportados), ir a la subcarpeta *_layouts* y ver cuáles son soportados, para luego usar esos en nuestras páginas y posts. Por ejemplo, el tema *architect* no soporta los layouts de *home*, *post* ni *page*, sólo tiene un layout *default*, por lo que todos los elementos del sitio (páginas y posts) deben usar este layout.

```
---
layout: default
title: "Welcome to Jekyll!"
date: 2021-04-15 10:44:22 + 0200
categories: jekyll update
---

... contenido del post
```

### 4.1. Editando un tema

Podemos editar los elementos de un tema para personalizar su apariencia. Entre otras cosas, podemos hacer uso de una serie de variables predefinidas, incluir unos archivos en otros y editar algunos aspectos de diseño.

#### 4.1.1. Variables

Existen una serie de variables predefinidas en los temas, y que podemos consultar [aquí](https://jekyllrb.com/docs/variables/). Por ejemplo, la variable `site` nos da información sobre el sitio, la variable `page` aporta información específica de la página (por ejemplo, podemos acceder a las variables definidas en el *front matter*), y la variable `content` hace referencia al contenido de la página. Dentro de algunas de estas variables, podemos acceder a ciertas propiedades útiles. Por ejemplo, la propiedad `site.pages` es un vector que permite recorrer todas las páginas del sitio, y `page.title` contiene el título de la página.

#### 4.1.2. Includes

Los includes son instrucciones que permiten incorporar otros archivos en el actual.

```
{% include cabecera.html %}
```

Los archivos incluidos se buscan dentro de la subcarpeta `_includes` del proyecto. Podemos obtener más información sobre el uso de includes [aquí](https://jekyllrb.com/docs/includes/).

#### 4.1.3. Layouts

Los *layouts* son plantillas con una cierta estructura prefijada, sobre las que volcar un determinado contenido. Al menos se suele tener uno llamado `default.html`, que es el *layout* por defecto. Dentro de cada *layout* podemos hacer uso tanto de los *includes* como de las variables vistas antes. En este último caso, para utilizar las variables se incluyen en el contenido del *layout* con esta nomenclatura:

```
<h1>{{ page.title }}</h1>
```

Dentro del *front matter* de cada página o post, indicaremos cuál de los *layouts* disponibles en el tema queremos utilizar.

**Crear nuestros propios layouts**

Si queremos crear nuestros propios *layouts*, debemos crear los archivos en la carpeta `_layouts` del proyecto (si no existe la carpeta, deberemos crearla también). Un ejemplo de layout podría ser:

```html
<!DOCTYPE html>
<html>
  <head>
    <title>{{ page.title }}</title>
  </head>
  <body>
    <header>
      {% include header.html %}
    </header>
    <nav>
      {% include nav.html %}
    </nav>
    <section>
      {{ content }}
    </section>
    <footer>
      {% include footer.html %}
    </footer>
  </body>
</html>
```

También deberíamos definir el contenido de los archivos `header.html`, `nav.html` y `footer.html` en la carpeta `_include`. Por ejemplo, dentro de `nav.html` podemos hacer un listado que recorra las distintas páginas que tengan título (para excluir páginas que no lo tengan, como la *404.html*) así:

```html
<ul>
  {% for page in site.html_pages %}
    {% if page.title %}
      <li>
        <a href="{{site.baseurl}}{{page.url}}">{{page.title}}</a>
      </li>
    {% endif %}
  {% endfor %}
</ul>
```

> **NOTA**: la propiedad `site.html_pages` obtiene todas las páginas HTML compiladas, ya sean originalmente en HTML o en Markdown. Esto excluye a otros tipos de archivos que admite Jekyll, como archivos de sindicación de contenidos.

Para poder utilizar este *layout* en las páginas, basta con que pongamos el nombre del archivo que hayamos creado (por ejemplo, *layout.html*) en el *front matter* de las distintas páginas:

```
---
layout: layout
title: Página de inicio
...
---
...
```

**Crear layouts a partir de otros**

Podemos definir *layouts* que extiendan el contenidode otros (hereden) definiendo en el *front matter* de estos *layouts* secundarios cuál es el *layout* que están extendiendo:

```
---
layout: layout
---

... contenido del layout secundario
```

Al hacer esto, el contenido del *layout* secundario se añade como contenido (*content*) del layout principal.
