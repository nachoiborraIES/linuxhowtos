# Integración continua

La integración continua es una metodología de desarrollo software que permite integrar partes del código de forma frecuente con el resto del proyecto que se va construyendo. Así, a medida que vamos completando partes (pequeñas) de un proyecto, podemos automáticamente aplicarles los tests unitarios correspondientes e incorporarlas o integrarlas con el resto del proyecto que se ya se ha construido y probado previamente.

Esta metodología está muy vinculada otras dos:

* El **desarrollo dirigido por las pruebas** (TDD, *Test Driven Development*), una metodología que consiste en desarrollar las pruebas de un código antes que el propio código.
* La **entrega continua** (CD, *Continuous delivery* o *Continuous deployment*), consistente en desplegar automáticamente los cambios de una aplicación sobre el servidor de producción a medida que se suben a un determinado repositorio. Podemos considerar esta metodología como un paso posterior a la integración continua: una vez se han pasado las pruebas del nuevo código incorporado, se despliega la nueva versión del software. El matiz entre *delivery* o *deployment* puede aludir a varios factores. Por ejemplo, en algunas bibliografías se habla de *continuous delivery* cuando el proceso de despliegue tras las pruebas de integración es manual, mientras que el *continuous deployment* se refiere a un despliegue automático tras las pruebas.

## 1. Introducción a Travis CI

Travis CI es la herramienta incorporada en GitHub para integración continua. Para poderlo utilizar, debemos darnos de alta en su web, [travis-ci.com](https://www.travis-ci.com/). Podemos (debemos) hacerlo con nuestra propia cuenta de GitHub, con lo que ambas aplicaciones quedan conectadas y autorizadas.

> **NOTA**: hasta hace poco, la web oficial era *travis-ci.org*, pero dejará de estar operativa en breve.

Los pasos para establecer la integración continua en un repositorio son:

1. Activar el repositorio en cuestión desde la herramienta Travis
2. Crear en el repositorio el fichero de configuración de Travis para realizar la integración continua. Por defecto, este archivo debe llamarse `.travis.yml`.
3. Se crean o modifican los tests necesarios
4. Se publican los cambios realizados, a través de *commits* o de *pull requests*.

### 1.1. Ejecución de tests

Para realizar la ejecución de los tests que desarrollemos, se siguen también una serie de pasos. Estos pasos se realizan desde Travis automáticamente, y consisten en crear una máquina virtual, clonar el repositorio, instalar las dependencias necesarias (según lo que hayamos indicado en el archivo `.travis.yml` y ejecutar los tests. Finalmente, también se pueden realizar otras acciones complementarias, como desplegar la aplicación, etc. Tanto si se pasan los tests como si no, se notifica al propietario del repositorio sobre los resultados.

Si se realiza una *pull request* sobre un repositorio en el que tengamos activada la integración continua, en los propios comentarios de la *pull request* se nos informa si se han pasado las pruebas o no, y en función de eso podemos decidir si se incorporan los cambios o no al proyecto.

## 2. Manejo básico de Travis CI

Una vez nos hemos dado de alta en Travis con nuestra cuenta de GitHub y hemos confirmado o validado esa cuenta, podremos entrar en Travis. En la sección de *Settings* (desplegando el icono superior derecho) podemos ver nuestros repositorios en GitHub, y activar/desactivar la integración continua en cada uno de ellos, marcando o desmarcando el interruptor correspondiente.

> **NOTA**: al principio, deberemos activar la integración con GitHub Apps para poder ver los repositorios.
> **NOTA**: si tenemos organizaciones asociadas a nuestra cuenta GitHub, podemos darles permisos para Travis yendo a los *Settings* de GitHub, y en la sección de *Applications*, permitir (*Grant*) el acceso a Travis para aquellas organizaciones de las que seamos propietarios.

### 2.1. El archivo *.travis.yml*

El archivo de configuración `.travis.yml` que debemos añadir en la raíz de los proyectos en los que queramos habilitar la integración continua tiene una serie de propiedades que debemos conocer:

* La propiedad `language` alude al lenguaje en que está desarrollado el proyecto. Puede ser PHP, Java, etc.
* A partir de la opción anterior, también podemos establecer la versión (o versiones) para las que queremos hacer las pruebas. Por ejemplo, podríamos pasar pruebas en un proyecto PHP tanto para PHP 7.2 como para PHP 5.4
* La propiedad `beforeScript` indica el comando (o comandos) a ejecutar antes de realizar las pruebas. Por ejemplo, si estamos probando un proyecto PHP, lo suyo sería ejecutar `composer install` para instalar las dependencias del proyecto antes.
* La propiedad `script` es el comando que va a lanzar las pruebas. En el caso de un proyecto PHP con PHPUnit, por ejemplo, y suponiendo que tenemos los tests almacenados en una subcarpeta *tests*, ese comando podría ser `phpunit tests`.

En cuanto hagamos un *push* de un proyecto configurado con Travis en GitHub, automáticamente (o a los pocos segundos) aparecerá el proceso de test en la web de Travis: se lanza la máquina virtual, se instalan dependencias, etc. En unos segundos (o unos pocos minutos) tendremos el resultado, pero en caso de que se ralentice demasiado tenemos disponible en Travis un botón *Restart build* para intentarlo de nuevo.

### 2.2. Travis y *pull requests*

Además de subiendo (*push*) la propia rama principal, también podemos crear trabajo en una rama paralela, subirla con *push* a su rama asociada remota, y luego hacer un *pull request* en GitHub para integrar esa rama con la principal (la operación *pull request*, además de para solicitar integrar cambios en un proyecto ajeno, también puede servir para combinar ramas). En este caso, si el repositorio tiene la integración continua activada, desde GitHub (en los mensajes de la *pull request*) podremos ver que se queda pendiente de que Travis complete las pruebas, pudiendo así esperar el resultado antes de decidir si se mezclan las ramas o no. De hecho, al confirmar el *merge* de las ramas, se tendrá un nuevo *commit* que provocará otra integración más de Travis.
