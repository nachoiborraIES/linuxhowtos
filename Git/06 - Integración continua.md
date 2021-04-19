# Integración continua

La integración continua es una metodología de desarrollo software que permite integrar partes del código de forma frecuente con el resto del proyecto que se va construyendo. Así, a medida que vamos completando partes (pequeñas) de un proyecto, podemos automáticamente aplicarles los tests unitarios correspondientes e incorporarlas o integrarlas con el resto del proyecto que se ya se ha construido y probado previamente.

Esta metodología está muy vinculada otras dos:

* El **desarrollo dirigido por las pruebas** (TDD, *Test Driven Development*), una metodología que consiste en desarrollar las pruebas de un código antes que el propio código.
* La **entrega continua** (CD, *Continuous delivery* o *Continuous deployment*), consistente en desplegar automáticamente los cambios de una aplicación sobre el servidor de producción a medida que se suben a un determinado repositorio. Podemos considerar esta metodología como un paso posterior a la integración continua: una vez se han pasado las pruebas del nuevo código incorporado, se despliega la nueva versión del software. El matiz entre *delivery* o *deployment* puede aludir a varios factores. Por ejemplo, en algunas bibliografías se habla de *continuous delivery* cuando el proceso de despliegue tras las pruebas de integración es manual, mientras que el *continuous deployment* se refiere a un despliegue automático tras las pruebas.



