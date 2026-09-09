# Que falta

## cliente.php

Consumir `bus.php` con `SoapClient`, llamando:

- `login(usuario, password)`
- `consultarProducto(codigo)`
- `listarProductos()`
- `reporteUso()`

## admin.php

Pagina con un boton para borrar filas de `logs_bus` (RF-04). Conexion PDO,
`DELETE` con sentencia preparada, pedir confirmacion antes de borrar.
