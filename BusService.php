<?php

require_once __DIR__ . '/config/Conexion.php';


class BusService
{
    public function login(string $usuario, string $password): array
    {
        $pdo = Conexion::obtenerConexion();

        $stmt = $pdo->prepare('SELECT usuario, nombre, password_hash FROM usuarios WHERE usuario = :usuario');
        $stmt->execute(['usuario' => $usuario]);
        $fila = $stmt->fetch();

        $ok = $fila !== false && password_verify($password, $fila['password_hash']);
        $this->registrarLog('login', $ok ? 'OK' : 'FAULT');

        if (!$ok) {
            throw new SoapFault('Client', 'Usuario o contrasena incorrectos');
        }

        return ['usuario' => $fila['usuario'], 'nombre' => $fila['nombre']];
    }

    public function consultarProducto(string $codigo): array
    {
        $pdo = Conexion::obtenerConexion();

        $stmt = $pdo->prepare('SELECT codigo, nombre, precio, stock FROM productos WHERE codigo = :codigo');
        $stmt->execute(['codigo' => $codigo]);
        $producto = $stmt->fetch();

        $this->registrarLog('consultarProducto', $producto !== false ? 'OK' : 'FAULT');

        if ($producto === false) {
            throw new SoapFault('Client', 'Producto no encontrado');
        }

        return [
            'codigo' => $producto['codigo'],
            'nombre' => $producto['nombre'],
            'precio' => (float) $producto['precio'],
            'stock'  => (int) $producto['stock'],
        ];
    }

    public function listarProductos(): array
    {
        $pdo = Conexion::obtenerConexion();
        $stmt = $pdo->query('SELECT codigo, nombre, precio, stock FROM productos ORDER BY nombre');

        $this->registrarLog('listarProductos', 'OK');

        $productos = [];
        foreach ($stmt as $fila) {
            $productos[] = [
                'codigo' => $fila['codigo'],
                'nombre' => $fila['nombre'],
                'precio' => (float) $fila['precio'],
                'stock'  => (int) $fila['stock'],
            ];
        }

        return $productos;
    }

    public function reporteUso(): array
    {
        $pdo = Conexion::obtenerConexion();
        $stmt = $pdo->query(
            'SELECT operacion, COUNT(*) AS total,
                    SUM(CASE WHEN resultado = "FAULT" THEN 1 ELSE 0 END) AS total_errores
             FROM logs_bus
             GROUP BY operacion'
        );

        $reporte = [];
        foreach ($stmt as $fila) {
            $reporte[] = [
                'operacion'      => $fila['operacion'],
                'total'          => (int) $fila['total'],
                'total_errores'  => (int) $fila['total_errores'],
            ];
        }

        return $reporte;
    }

    private function registrarLog(string $operacion, string $resultado): void
    {
        $pdo = Conexion::obtenerConexion();
        $stmt = $pdo->prepare('INSERT INTO logs_bus (operacion, resultado) VALUES (:operacion, :resultado)');
        $stmt->execute(['operacion' => $operacion, 'resultado' => $resultado]);
    }
}
