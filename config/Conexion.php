<?php

final class Conexion
{
    private static ?PDO $instancia = null;

    private function __construct()
    {
    }

    private static function cargarEnv(string $ruta): void
    {
        if (!is_readable($ruta)) {
            return;
        }

        foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
            $linea = trim($linea);
            if ($linea === '' || str_starts_with($linea, '#') || !str_contains($linea, '=')) {
                continue;
            }

            [$clave, $valor] = explode('=', $linea, 2);
            $clave = trim($clave);
            $valor = trim($valor, " \t\n\r\0\x0B\"'");

            if ($clave !== '' && getenv($clave) === false) {
                putenv("$clave=$valor");
            }
        }
    }

    public static function obtenerConexion(): PDO
    {
        if (self::$instancia instanceof PDO) {
            return self::$instancia;
        }

        self::cargarEnv(dirname(__DIR__) . '/.env');

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            getenv('DB_HOST') ?: '127.0.0.1',
            getenv('DB_PORT') ?: '3306',
            getenv('DB_NAME') ?: ''
        );

        self::$instancia = new PDO($dsn, getenv('DB_USER') ?: '', getenv('DB_PASS') ?: '', [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        return self::$instancia;
    }
}
