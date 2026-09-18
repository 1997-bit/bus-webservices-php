<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador - Borrar Logs</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; }
        .container { max-width: 500px; margin: 0 auto; }
        .btn { display: inline-block; padding: 10px 20px; background: #1976d2; color: white; text-decoration: none; border-radius: 4px; margin: 10px 0; }
        .btn-danger { background: #d32f2f; }
        .confirm { background: #f57c00; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Administrador - Borrar Historial de Logs</h1>

        <?php
        try {
            $pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=bus_webservices;charset=utf8mb4',
                'root',
                '',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
            
            // Contar registros antes
            $stmt = $pdo->query('SELECT COUNT(*) AS total FROM logs_bus');
            $total = $stmt->fetch()['total'];
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
        ?>

        <p>Total de registros en <code>logs_bus</code>: <strong><?= $total ?></strong></p>

        <?php if ($total > 0): ?>
            <a href="?borrar=1" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres borrar TODOS los registros de logs_bus? Esta acción no se puede deshacer.');">
                Borrar todos los logs
            </a>
        <?php endif; ?>

        <?php if (isset($_GET['borrar'])): ?>
            <?php
try {
                $pdo = new PDO(
                    'mysql:host=127.0.0.1;dbname=bus_webservices;charset=utf8mb4',
                    'root',
                    '',
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
                );
                
                $stmt = $pdo->prepare('DELETE FROM logs_bus');
                $stmt->execute();
                
                echo "<div class='ok'>✅ Se borraron exitosamente todos los registros de logs_bus.</div>";
            } catch (PDOException $e) {
                echo "<div class='error'>❌ Error al borrar: " . $e->getMessage() . "</div>";
            }
            ?>
            
            <p><a href="index.php">Volver al cliente</a></p>
        <?php else: ?>
            <p>Ningún registro ha sido borrado aún.</p>
            <p><a href="index.php">Volver al cliente SOAP</a></p>
        <?php endif; ?>
    </div>
</body>
</html>