<?php
class home
{
	private $pdo;
    public $CodAu;
    public $Nome;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

}
