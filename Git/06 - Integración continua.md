# Integración continua

La integración continua es una metodología de desarrollo software que permite integrar partes del código de forma frecuente con el resto del proyecto que se va construyendo. Así, a medida que vamos completando partes (pequeñas) de un proyecto, podemos automáticamente aplicarles los tests unitarios correspondientes e incorporarlas o integrarlas con el resto del proyecto que se ya se ha construido y probado previamente.

Esta metodología está muy vinculada otras dos:

* El **desarrollo dirigido por las pruebas** (TDD, *Test Driven Development*), una metodología que consiste en desarrollar las pruebas de un código antes que el propio código.
* La **entrega continua** (CD, *Continuous delivery* o *Continuous deployment*), consistente en desplegar automáticamente los cambios de una aplicación sobre el servidor de producción a medida que se suben a un determinado repositorio. Podemos considerar esta metodología como un paso posterior a la integración continua: una vez se han pasado las pruebas del nuevo código incorporado, se despliega la nueva versión del software. El matiz entre *delivery* o *deployment* puede aludir a varios factores. Por ejemplo, en algunas bibliografías se habla de *continuous delivery* cuando el proceso de despliegue tras las pruebas de integración es manual, mientras que el *continuous deployment* se refiere a un despliegue automático tras las pruebas.

## 1. Introducción a Travis CI

Travis CI es la herramienta incorporada en GitHub para integración continua. Los pasos para establecer la integración continua en un repositorio son:

1. Activar el repositorio en cuestión desde la herramienta Travis
2. Crear en el repositorio el fichero de configuración de Travis para realizar la integración continua. Por defecto, este archivo debe llamarse `.travis.yml`.
3. Se crean o modifican los tests necesarios
4. Se publican los cambios realizados, a través de *commits* o de *pull requests*.

### 1.1. Ejecución de tests

Para realizar la ejecución de los tests que desarrollemos, se siguen también una serie de pasos. Estos pasos se realizan desde Travis automáticamente, y consisten en crear una máquina virtual, clonar el repositorio, instalar las dependencias necesarias (según lo que hayamos indicado en el archivo `.travis.yml` y ejecutar los tests. Finalmente, también se pueden realizar otras acciones complementarias, como desplegar la aplicación, etc. Tanto si se pasan los tests como si no, se notifica al propietario del repositorio sobre los resultados.

Si se realiza una *pull request* sobre un repositorio en el que tengamos activada la integración continua, en los propios comentarios de la *pull request* se nos informa si se han pasado las pruebas o no, y en función de eso podemos decidir si se incorporan los cambios o no al proyecto.
