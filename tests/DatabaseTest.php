<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Ellephanty\Database\Database;
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
        $db->connect();
        $this->assertInstanceOf(PDO::class, $db->connection());
        $db->close();
    }

    public function testCloseSetsConnectionToNull()
    {
        $db = new Database();
        $db->connect();
        $this->assertNotNull($db->connection());
        $db->close();
        $this->assertNull($db->connection());
    }
}