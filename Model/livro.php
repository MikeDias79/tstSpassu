<?php
class livro
{
	private $pdo;
    public $Cod;
    public $Titulo;
    public $Edicao;
	public $Editora;
	public $Preco;
    public $AnoPublicacao;

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
			$sql = "SELECT l.Cod AS Cod, 
					l.Titulo AS Titulo, 
					l.Editora AS Editora, 
					l.Edicao AS Edicao, 
					l.AnoPublicacao AS AnoPublicacao, 
					l.Preco AS Preco, 
					assu.Assunto_CodAs AS Assunto_CodAs,
					assunto.Descricao AS Descricao
					FROM livro l
					LEFT JOIN livro_assunto assu ON l.Cod = assu.Livro_Cod
					LEFT JOIN assunto ON assunto.CodAs = assu.Assunto_CodAs";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obter($cod)
	{
		try
		{
			$sql = "SELECT l.Cod as Cod, l.Titulo as Titulo, l.Editora as Editora, l.Edicao as Edicao, l.AnoPublicacao as AnoPublicacao, l.Preco as Preco, assu.Assunto_CodAs as Assunto_CodAs
					FROM livro l
					LEFT JOIN livro_assunto assu ON l.Cod = assu.Livro_Cod
					WHERE l.Cod = ?";
			$stm = $this->pdo->prepare($sql);
			$stm->execute(array($cod));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}



	public function ListaAssunto()
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM assunto order by Descricao");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function ListaAutor()
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM autor order by Nome");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function LivroAutor($CodLivro)
	{
		try
		{
			$sql = "SELECT distinct * FROM autor a
					INNER JOIN livro_autor la ON la.Autor_CodAu = a.CodAu
					WHERE la.Livro_Cod = " . $CodLivro;
					
			$result = array();
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	

	public function Eliminar($cod)
	{
		try
		{

			$stm = $this->pdo
			            ->prepare("DELETE FROM Livro_Assunto WHERE Livro_Cod = ?");
			$stm->execute(array($cod));


			$stm2 = $this->pdo
			->prepare("DELETE FROM Livro_Autor WHERE Livro_Cod = ?");
			$stm2->execute(array($cod));


			$stm3 = $this->pdo
			            ->prepare("DELETE FROM livro WHERE cod = ?");
			$stm3->execute(array($cod));

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function ApagarAutorLivro($cod, $CodAu)
	{
		try
		{
			$stm2 = $this->pdo
			->prepare("DELETE FROM Livro_Autor WHERE Livro_Cod =" . $cod . " and Autor_CodAu = " . $CodAu);
			$stm2->execute();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}



	public function Atualizar($data)
	{

		try
		{
			$sql = "UPDATE livro SET
						Titulo   = ?,
						Editora  = ?,
            			Edicao   = ?,
						AnoPublicacao   = ?,
						Preco   = ?
				    WHERE Cod = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Titulo,
                        $data->Editora,
                        $data->Edicao,
                        $data->AnoPublicacao,
						$data->Preco,
						$data->Cod
					)
				);

				$sql2 = "Update Livro_Assunto set Assunto_CodAs = ? where Livro_Cod = ?";
				$this->pdo->prepare($sql2)
			     ->execute(
				    array(
						$data->CodAs,
						$data->Cod
					)
				);	


		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar(livro $data)
	{

		try
		{
			$sql = "INSERT INTO livro (Titulo, Editora, Edicao, AnoPublicacao, Preco) VALUES (?, ?, ?, ?, ?)";
			$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Titulo,
                    $data->Editora,
                    $data->Edicao,
                    $data->AnoPublicacao,
					$data->Preco,
                )
			);

			$ultimoId = $this->pdo->lastInsertId();

			$sql2 = "INSERT INTO Livro_Assunto (Livro_Cod, Assunto_CodAs) VALUES (?, ?)";
			$this->pdo->prepare($sql2)
		     ->execute(
				array(
                    $ultimoId,
                    $data->CodAs,
                )
			);			

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function RegistraAutorLivro(livro $data)
	{
		try
		{
			$sql = "INSERT INTO livro_autor (Livro_Cod, Autor_CodAu) VALUES (?, ?)";
			$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Cod,
                    $data->CodAu,
                )
			);

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}



}