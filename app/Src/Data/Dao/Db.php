<?php
namespace App\Src\Data\Dao;

use App\Src\Business\Services\LogService;
use App\Src\Data\Exceptions\DatabaseConnectionException;
use App\Src\Data\Exceptions\DatabaseQueryException;
use App\Src\Data\Exceptions\InvalidEnvironmentException;
use App\Src\Data\Exceptions\PdoBindingFailureException;
use App\Src\Data\Exceptions\PdoFetchFailureException;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Class DatabaseConn
 * @package App\Database
 */
abstract class Db {

    /**
     * @var string
     */
    protected string $username;
    /**
     * @var string
     */
    protected string $hostspec;
    /**
     * @var string
     */
    protected string $password;
    /**
     * @var string
     */
    protected string $database;
    /**
     * @var string
     */
    protected string $pdoConfig;
    /**
     * @var PDO|null
     */
    protected ?PDO $connection;
    /**
     * @var PDOStatement|null
     */
    protected ?PDOStatement $stmt;
    /**
     * @var int
     */
    protected int $countRow;
    /**
     * @var string|mixed
     */
    protected string $environment;
    /**
     * @var string
     */
    protected string $sql;
    private bool $keepConnectionAlive;
    protected const DEVELOPMENT = 'dev';
    protected const QA = 'qa';
    protected const PRODUCTION = 'prod';

    /**
     * DatabaseConn constructor.
     * @throws InvalidEnvironmentException
     */
    public final function __construct(bool $keepConnectionAlive = false)
    {
        $this->keepConnectionAlive = $keepConnectionAlive;
        $this->environment = env('ENVIRONMENT');
        if (!in_array($this->environment, [self::DEVELOPMENT, self::QA, self::PRODUCTION]))
        {
            throw new InvalidEnvironmentException($this->environment);
        }
    }

    abstract protected function configureAccessCredentials(): void;
    abstract protected function configurePDOConfig(): void;
    abstract protected function configureAfterConnection(): void;

    /**
     * @return void
     * @throws DatabaseConnectionException
     */
    public final function connect(): void
    {
        $this->configureAccessCredentials();
        $this->configurePDOConfig();
        try {
            $this->connection = new PDO($this->pdoConfig, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->configureAfterConnection();
            Log::info("A connection with the database {$this->database} on host {$this->hostspec} was established.");
        } catch (PDOException $pdoException) {
            LogService::logPdoException($pdoException);
            throw new DatabaseConnectionException($this);
        }
    }


    /**
     * @param array $binds
     * @param string $sql
     * @return void
     * @throws PdoBindingFailureException
     */
    private function configureBinds(array $binds, string $sql): void
    {
        foreach ($binds as $key => $value) {
            if (preg_match('/^bin_/', $key)) {
                if (!$this->stmt->bindValue(":$key", $value, PDO::PARAM_LOB)) {
                    throw new PdoBindingFailureException($this->sql, $key, $value, PDO::PARAM_LOB);
                }
                continue;
            }
            $type = gettype($value);
            $pdoParamType = [
                'boolean' => PDO::PARAM_BOOL,
                'integer' => PDO::PARAM_INT,
                'double' => PDO::PARAM_STR,
                'string' => PDO::PARAM_STR,
                'array' => - 1,
                'object' => - 1,
                'resource' => - 1,
                'NULL' => PDO::PARAM_NULL,
                'unknown type' => - 1
            ][$type];
            if ($pdoParamType === -1) {
                throw new PdoBindingFailureException($this->sql, $key, $value, $pdoParamType);
            }
            if (!$this->stmt->bindValue(":$key", $value, $pdoParamType)) {
                throw new PdoBindingFailureException($this->sql, $key, $value, $pdoParamType);
            }
        }
    }

    /**
     * @param callable|null $mapper
     * @return Collection
     * @throws PdoFetchFailureException
     */
    public function getResultArray(?callable $mapper = null): Collection
    {
        $resultColl = collect([]);
        if (!$this->stmt)
        {
            throw new PdoFetchFailureException($this, "PdoStatement is null on getResultArray method.");
        }
        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row === false) {
                throw new PdoFetchFailureException($this, "Result row is false on getResultArray method.");
            }
            $resultColl[] = $mapper ? $mapper($row) : $row;
        }
        if (!$this->keepConnectionAlive)
        {
           $this->disconnect();
        }
        return $resultColl;
    }

    /**
     * @param callable|null $mapper
     * @return mixed
     * @throws PdoFetchFailureException
     */
    public function getResultObj(?callable $mapper = null)
    {
        if (!$this->stmt)
        {
            throw new PdoFetchFailureException($this, "PdoStatement is null on getResultObj method.");
        }
        $fetchedObj = $this->stmt->fetch(PDO::FETCH_ASSOC);
        if ($fetchedObj === false)
        {
            throw new PdoFetchFailureException($this);
        }
        $mappedObj = $mapper ? $mapper($fetchedObj) : $fetchedObj;
        if (!$this->keepConnectionAlive)
        {
            $this->disconnect();
        }
        return $mappedObj;
    }

    /**
     * @param string $sql
     * @param array $binds
     * @return bool
     * @throws Exception
     */
    public final function query(string $sql, array $binds = []): bool
    {
        $this->sql = $sql;
        try {
            $this->stmt = $this->connection->prepare($this->sql);
            $this->configureBinds($binds, $this->sql);
            return $this->stmt->execute();
        } catch (PDOException $pdoException) {
            LogService::logPdoException($pdoException);
            throw new DatabaseQueryException($this, $binds);
        }
    }


    /**
     *
     */
    public final function disconnect(): void
    {
//        LogService::logInfo("A conexão com o banco de dados {$this->hostspec}:{$this->database} foi fechada.", $_SERVER);
        $this->connection = null;
    }

    /**
     *
     * @return string
     */
    public final function getUsername(): string
    {
        return $this->username;
    }

    /**
     *
     * @return string
     */
    public final function getHostspec(): string
    {
        return $this->hostspec;
    }

    /**
     *
     * @return string
     */
    public final function getPassword(): string
    {
        return $this->password;
    }

    /**
     *
     * @return string
     */
    public final function getDatabase(): string
    {
        return $this->database;
    }


    /**
     *
     * @return PDO
     */
    public final function getConnection(): ?PDO
    {
        return $this->connection;
    }

    /**
     *
     * @return int
     */
    public final function getCountRow(): int
    {
        return $this->countRow;
    }

    public final function getSql(): string
    {
       return $this->sql;
    }

    /**
     *
     * @param string $username
     */
    public final function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     *
     * @param string $hostspec
     */
    public final function setHostspec(string $hostspec): void
    {
        $this->hostspec = $hostspec;
    }

    /**
     *
     * @param string $password
     */
    public final function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     *
     * @param string $database
     */
    public final function setDatabase(string $database): void
    {
        $this->database = $database;
    }

    /**
     *
     * @param ?PDO $connection
     */
    public final function setConnection(?PDO $connection): void
    {
        $this->connection = $connection;
    }

    /**
     *
     * @param int $countRow
     */
    public final function setCountRow(int $countRow): void
    {
        $this->countRow = $countRow;
    }

}

