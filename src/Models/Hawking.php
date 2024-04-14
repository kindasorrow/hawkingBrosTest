<?php

namespace Models;

use Exception;
use mysqli;

final class Hawking
{
    private string $hostname = "mysql";
    private string $username = "root";
    private string $password = "MYSQL_ROOT_PASSWORD";
    private string $database = "hawking";

    public function __construct()
    {
        try {
            $this->bros();
            $this->brothers();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Retrieves data from the 'test' table where the 'result' field is either 'normal' or 'success'.
     *
     * @return array
     */
    public function production(): array
    {
        $con = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        if ($con->connect_error) {
            return [];
        }

        $query = "SELECT * FROM `test` WHERE `result` IN ('normal', 'success')";
        $result = $con->query($query);

        if ($result === false) {
            $con->close();
            return [];
        }

        $res = [];
        while ($row = $result->fetch_assoc()) {
            $res[] = $row;
        }
        $con->close();
        return $res;
    }

    /**
     * Creates a table 'test' if it doesn't already exist with fields: id, script_name, start_time, end_time, result.
     *
     * @throws Exception if there is an error executing the query or connecting to the database
     * @return void
     */
    private function bros(): void
    {
        $con = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if ($con->connect_error) {
            throw new Exception($con->connect_error);
        }

        $query = "CREATE TABLE if NOT EXISTS `test` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `script_name` VARCHAR(25) NOT NULL,
            `start_time` int(11),
            `end_time` int(11),
            `result` ENUM('normal', 'illegal', 'failed', 'success'),
            PRIMARY KEY (`id`)
        )";
        if ($con->query($query) === false) {
            throw new Exception($con->error);
        }

        $con->close();
    }

    /**
     * Randomly generates 100 rows of data and inserts it into the 'test' table.
     *
     * @throws Exception if there is an error during the data insertion process
     * @return void
     */
    private function brothers(): void
    {
        $result = [
            'normal',
            'illegal',
            'failed',
            'success'
        ];
        $con = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if ($con->connect_error) {
            throw new Exception($con->connect_error);
        }

        for ($i = 0; $i < 100; $i++) {
            $scriptName = "Script_".rand(0, $i * 10);
            $startTime = rand(1, time());
            $endTime = rand($startTime, time());
            $randomResult = $result[array_rand($result)];

            $query = "INSERT INTO `test` (`script_name`, `start_time`, `end_time`, `result`) VALUES ('$scriptName', $startTime, $endTime, '$randomResult')";

            if ($con->query($query) === false) {
                throw new Exception($con->error);
            }
        }

        $con->close();
    }
}