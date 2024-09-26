<?php
class assunto
{
	private $pdo;

    public $CodAs;
    public $Descricao;

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

			$stm = $this->pdo->prepare("SELECT * FROM assunto");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obter($CodAs)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT * FROM assunto WHERE CodAs = ?");
			$stm->execute(array($CodAs));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($CodAs)
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM assunto WHERE CodAs = ?");

			$stm->execute(array($CodAs));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Atualizar($data)
	{
		try
		{
			$sql = "UPDATE assunto SET
						Descricao   = ?
				    WHERE CodAs = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Descricao,
                        $data->CodAs
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar(assunto $data)
	{
		try
		{
		$sql = "INSERT INTO assunto (Descricao) VALUES (?)";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Descricao
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
