<?php
class Database 
{
    private static $instance = NULL;
    private $pdo;
    //private $query;
    
    private function __construct()
    {
		try{
			$this->pdo = new PDO('mysql:host=localhost;dbname=hdi', 'root', '');
		}
		catch(exception $e)
        {
            die ( 'DATABASE: Connection Failed! ' . $e->getMessage() );
		}
    }
    
    public static function obj()
    {
        if (self::$instance == NULL)
        {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
	/**
	 * Database::execute_query()
	 * 
     * This method executes all types of SQL transactions
     * If it is a SELECT statement, always set the return $format
     * 
	 * @param mixed $query
	 * @param mixed $format
	 * @param mixed $bind_array
	 * @return
	 */
	public function execute_query($query,$format='',$bind_array=array())
    {
        // Init.
		$result = false;
        
		try
        {
            // Prepare Statement
			$prep_stmt = $this->pdo->prepare($query);
            
            // Bind
            if (!empty($bind_array))
            {
                $this->bind_array($prep_stmt, $bind_array);
            }
            
            // Execute
			$exec_msg = $prep_stmt->execute();
        
            // If it is a SELECT statement, return an array or an object
            if ($format != '')
            {
                if (($format == 'A') || ($format == 'Array'))
                {
                    //return $this->obj2arr($result);
                    $result = $prep_stmt->fetchAll(PDO::FETCH_ASSOC);
                    //print_r($result);
                    return $result;
                }
                else if (($format == 'O') || ($format == 'Object'))
                {
                    //return $result;
                    $result = $prep_stmt->fetchAll(PDO::FETCH_OBJ);
                    //print_r($result);
                    return $result;
                }
            }
            // If it is not a SELECT statement, return the transaction status
            else
            {
                return $exec_msg;
            }
		}
		catch(exception $e)
        {
            die ('DATABASE: Query Execution Failed! ' . $e->getMessage());
		}
	}
    
    private function bind_array(&$prep_stmt, &$bind_array)
    {
        foreach ($bind_array as $k=>$v)
        {
            @$prep_stmt->bindParam($k, $v[0], $v[1]);
        }
    }
    
    public function begin_transaction()
    {
        return $this->pdo->beginTransaction();
    }
    
    public function commit_transaction()
    {
        return $this->pdo->commit();
    }
    
    public function roll_back()
    {
        return $this->pdo->rollBack();
    }
    
    public function last_insert_id()
    {
        return $this->pdo->lastInsertId();
    }
    
    public function get_query()
    {
        //return $this->query;
    }
} ?>