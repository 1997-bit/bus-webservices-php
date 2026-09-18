<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cliente SOAP - Bus de Web Services</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px; }
        .section { margin-bottom: 30px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .error { color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .ok { color: #388e3c; background: #e8f5e9; padding: 10px; border-radius: 4px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h1>Cliente SOAP - Bus de Web Services</h1>

    <?php
    $client = new SoapClient(null, [
        'location' => 'http://' . $_SERVER['HTTP_HOST'] . '/bus-webservices-php/bus.php',
        'uri' => 'urn:BusWebServices',
        'trace' => 1,
    ]);
    ?>

    <div class="section">
        <h2>1. login(usuario, password)</h2>
        <p>Usuario de prueba: <strong>demo</strong> / <strong>Demo123!</strong></p>
        <?php try { ?>
            <?php $result = $client->login('demo', 'Demo123!'); ?>
            <div class="ok">
                Éxito: usuario = <?= htmlspecialchars($result['usuario']) ?>, nombre = <?= htmlspecialchars($result['nombre']) ?>
            </div>
        <?php } catch (SoapFault $e) { ?>
            <div class="error">
                Error: <?= $e->getMessage() ?>
            </div>
        <?php } ?>
    </div>

    <div class="section">
        <h2>2. consultarProducto(codigo)</h2>
        <p>Códigos de prueba: <strong>PRD-001</strong> (Teclado) o <strong>PRD-002</strong> (Mouse)</p>
        <?php try { ?>
            <?php $result = $client->consultarProducto('PRD-001'); ?>
            <div class="ok">
                Código: <?= htmlspecialchars($result['codigo']) ?>, Nombre: <?= htmlspecialchars($result['nombre']) ?><br>
                Precio: $<?= number_format($result['precio'], 2) ?>, Stock: <?= htmlspecialchars($result['stock']) ?>
            </div>
        <?php } catch (SoapFault $e) { ?>
            <div class="error">
                Error: <?= $e->getMessage() ?>
            </div>
        <?php } ?>
        <?php try { ?>
            <?php $result = $client->consultarProducto('PRD-002'); ?>
            <div class="ok">
                Código: <?= htmlspecialchars($result['codigo']) ?>, Nombre: <?= htmlspecialchars($result['nombre']) ?><br>
                Precio: $<?= number_format($result['precio'], 2) ?>, Stock: <?= htmlspecialchars($result['stock']) ?>
            </div>
        <?php } catch (SoapFault $e) { ?>
            <div class="error">
                Error: <?= $e->getMessage() ?>
            </div>
        <?php } ?>
    </div>

    <div class="section">
        <h2>3. listarProductos()</h2>
        <?php try { ?>
            <?php $result = $client->listarProductos(); ?>
            <table>
                <thead>
                    <tr>
                        <th>Código</th><th>Nombre</th><th>Precio</th><th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $producto): ?>
                        <tr>
                            <td><?= htmlspecialchars($producto['codigo']) ?></td>
                            <td><?= htmlspecialchars($producto['nombre']) ?></td>
                            <td>$<?= number_format($producto['precio'], 2) ?></td>
                            <td><?= htmlspecialchars($producto['stock']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } catch (SoapFault $e) { ?>
            <div class="error">
                Error: <?= $e->getMessage() ?>
            </div>
        <?php } ?>
    </div>

    <div class="section">
        <h2>4. reporteUso()</h2>
        <?php try { ?>
            <?php $result = $client->reporteUso(); ?>
            <table>
                <thead>
                    <tr>
                        <th>Operación</th><th>Total llamadas</th><th>Total errores</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['operacion']) ?></td>
                            <td><?= htmlspecialchars($fila['total']) ?></td>
                            <td><?= htmlspecialchars($fila['total_errores']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } catch (SoapFault $e) { ?>
            <div class="error">
                Error: <?= $e->getMessage() ?>
            </div>
        <?php } ?>
    </div>

    <hr>
    <p>Servicio SOAP en: <code>http://<?= $_SERVER['HTTP_HOST'] ?>/bus-webservices-php/bus.php</code></p>
</body>
</html>