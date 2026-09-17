# Que falta

## cliente.php

Consumir `bus.php` con `SoapClient` (sin WSDL, `uri` = `urn:BusWebServices`),
llamando las 4 operaciones expuestas y mostrando el resultado de cada una en
pantalla (RF-07):

- `login(usuario, password)` — probar con el usuario de prueba `demo` /
  `Demo123!`. Mostrar `usuario` y `nombre` si la autenticacion es correcta.
- `consultarProducto(codigo)` — probar con `PRD-001` o `PRD-002`. Mostrar
  `codigo`, `nombre`, `precio` y `stock`.
- `listarProductos()` — mostrar todos los productos, por ejemplo en una tabla
  HTML simple.
- `reporteUso()` — mostrar el total de llamadas y de errores por operacion,
  para verificar que `logs_bus` se esta registrando bien.

Cada llamada esta envuelta en su propio `try/catch (SoapFault $e)`, para que
un fallo (por ejemplo un login incorrecto) no rompa la pagina completa y se
pueda ver el mensaje de error junto a las demas operaciones.

No hace falta diseno elaborado: con HTML basico y `print_r()` o una tabla
simple alcanza para la sustentacion.

## admin.php

Pagina con un boton para borrar todas las filas de `logs_bus` (RF-06).
Conexion PDO directa (no pasa por el bus SOAP), `DELETE` con sentencia
preparada, pidiendo confirmacion antes de ejecutar el borrado (RNF-05).

Flujo esperado:

1. La pagina carga y muestra cuantos registros hay actualmente en
   `logs_bus` (por ejemplo con un `SELECT COUNT(*)`).
2. Un boton o formulario dispara la accion de borrado.
3. Antes de borrar, se pide confirmacion explicita (puede ser un
   `confirm()` de JavaScript, o un segundo paso con un boton de
   "Si, borrar todo").
4. Al confirmar, se ejecuta `DELETE FROM logs_bus` con sentencia preparada
   de PDO.
5. El borrado de `logs_bus` no debe afectar `usuarios` ni `productos`.
6. Despues de borrar, `reporteUso()` (desde `cliente.php` o el bus) debe
   reflejar el historial vacio.
