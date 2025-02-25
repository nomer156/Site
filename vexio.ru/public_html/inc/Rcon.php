<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use xPaw\SourceQuery\SourceQuery;

class Rcon {
    private SourceQuery $query;
    private string $server;
    private int $port;
    private int $timeout;
    private int $engine;
    private string $rconPassword;

    public function __construct(string $server, int $port, int $timeout, int $engine, string $rconPassword) {
        $this->server = $server;
        $this->port = $port;
        $this->timeout = $timeout;
        $this->engine = $engine;
        $this->rconPassword = $rconPassword;
        $this->query = new SourceQuery();
    }

    public function sendCommand(string $command): string {
        try {
            $this->query->Connect($this->server, $this->port, $this->timeout, $this->engine);
            $this->query->SetRconPassword($this->rconPassword);
            $result = $this->query->Rcon($command);
            return $result;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        } finally {
            $this->query->Disconnect();
        }
    }
}
