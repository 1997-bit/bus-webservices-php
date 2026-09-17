# Que falta

## cliente.php

Este archivo debe consumir `bus.php` con `SoapClient`. El servicio no usa WSDL. El parametro `uri` debe ser `urn:BusWebServices`. La pagina debe llamar las 4 operaciones expuestas y mostrar el resultado de cada una en pantalla. Esto cumple RF-07.

Datos de prueba para cada operacion:

- `login(usuario, password)`. Usar el usuario `demo` con la contrasena `Demo123!`. Si la autenticacion es correcta, mostrar `usuario` y `nombre`.
- `consultarProducto(codigo)`. Usar el codigo `PRD-001` o `PRD-002`. Mostrar `codigo`, `nombre`, `precio` y `stock`.
- `listarProductos()`. Mostrar todos los productos. Una tabla HTML simple es suficiente.
- `reporteUso()`. Mostrar el total de llamadas y el total de errores por operacion. Esto sirve para verificar que `logs_bus` esta registrando cada llamada.

Cada llamada debe ir en su propio bloque `try/catch (SoapFault $e)`. Un fallo en una operacion, por ejemplo un login incorrecto, no debe detener la ejecucion de las demas. El mensaje de error debe mostrarse junto al resultado de las otras operaciones.

El diseno visual no es un requisito. HTML basico con `print_r()` o una tabla simple es suficiente para la sustentacion.

## admin.php

Esta pagina debe mostrar un boton que borra todas las filas de `logs_bus`. Esto cumple RF-06. La conexion es PDO directa. La pagina no pasa por el bus SOAP. El `DELETE` debe usar una sentencia preparada. La pagina debe pedir confirmacion antes de ejecutar el borrado. Esto cumple RNF-05.

Flujo esperado:

1. La pagina carga y muestra cuantos registros hay en `logs_bus`. Un `SELECT COUNT(*)` es suficiente para este dato.
2. Un boton o formulario dispara la accion de borrado.
3. Antes de borrar, la pagina pide confirmacion explicita. Esto puede ser un `confirm()` de JavaScript o un segundo paso con un boton de confirmacion.
4. Al confirmar, la pagina ejecuta `DELETE FROM logs_bus` con una sentencia preparada de PDO.
5. El borrado de `logs_bus` no debe afectar las tablas `usuarios` ni `productos`.
6. Despues del borrado, `reporteUso()` debe reflejar el historial vacio. Esto se puede verificar desde `cliente.php` o llamando al bus directamente.
