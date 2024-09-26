<?php
class autor
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

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM autor");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obter($CodAu)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT * FROM autor WHERE CodAu = ?");
			$stm->execute(array($CodAu));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($CodAu)
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM autor WHERE CodAu = ?");

			$stm->execute(array($CodAu));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Atualizar($data)
	{
		try
		{
			$sql = "UPDATE autor SET
						Nome   = ?
				    WHERE CodAu = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nome,
                        $data->CodAu
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar(autor $data)
	{
		try
		{
		$sql = "INSERT INTO autor (Nome) VALUES (?)";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nome
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
