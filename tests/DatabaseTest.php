<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Quimiphp\Database\Database;
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();


class DatabaseTest extends TestCase
{

    public function testCanInstantiateDatabase()
    {
        $db = new Database();
        $this->assertInstanceOf(Database::class, $db);
    }

    public function testConnectReturnsPdoInstance()
    {
        $db = new Database();
        $pdo = $db->connect();

        $this->assertInstanceOf(PDO::class, $pdo);

        $db->close($pdo);
    }

    public function testCloseSetsConnectionToNull()
    {
        $db = new Database();
        $pdo = $db->connect();

        $db->close($pdo);

        // usamos Reflection porque la propiedad es private
        $reflection = new ReflectionClass($db);
        $property = $reflection->getProperty('conexion');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($db));
    }
}