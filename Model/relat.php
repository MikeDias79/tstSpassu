<?php
class relat
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

	public function Relat()
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
					au.Autor_CodAu AS Autor_CodAu, 
					assu.Assunto_CodAs AS Assunto_CodAs,
					autor.Nome AS Nome,
					assunto.Descricao AS Descricao
					FROM livro l
					LEFT JOIN livro_assunto assu ON l.Cod = assu.Livro_Cod
					LEFT JOIN assunto ON assunto.CodAs = assu.Assunto_CodAs
					LEFT JOIN livro_autor au ON l.Cod = au.Livro_Cod
					LEFT JOIN autor ON autor.CodAu = au.Autor_CodAu";	
			$stm = $this->pdo->prepare($sql);
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

}
