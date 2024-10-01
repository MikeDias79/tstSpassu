<?php
// Incluindo a biblioteca FPDF
require('../fpdf/fpdf.php');

$host  = 'localhost';
$dbname = 'testespassu';
$username = 'TesteSpassu';
$password = '@Teste$passu';


class PDF extends FPDF
{

    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Lista de Livros Cadastrados', 0, 1, 'C');
        $this->Ln(10);
    }


    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }


    function CreateTable($header, $data)
    {
        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $col) {
            $this->Cell(40, 7, $col, 1);
        }
        $this->Ln();

        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(40, 6, $col, 1);
            }
            $this->Ln();
        }
    }
}

$pdf = new PDF('L', 'mm', 'A4');;

$pdf->AddPage();

$header = array('COD', 'TITULO', 'EDITORA', 'EDICAO', 'ANO', 'AUTOR', 'ASSUNTO');

$data = array();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * from vw_lista_livros";
    
    $stmt = $pdo->query($sql);

    foreach ($stmt as $r) {

        $sqlA = "SELECT distinct Nome FROM autor a
        INNER JOIN livro_autor la ON la.Autor_CodAu = a.CodAu
        WHERE la.Livro_Cod = " . $r['Cod'] . " limit 1";

        $stmtA = $pdo->query($sqlA);

        $autores = "";
        foreach ($stmtA as $a) {
            $autores = $autores . chr(10) . $a['Nome'];
        }

        array_push($data, array($r['Cod'], $r['Titulo'], $r['Editora'], $r['Edicao'], $r['AnoPublicacao'], $autores, $r['Descricao']));

    }
    
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}

$pdo = null;

$pdf->CreateTable($header, $data);

$pdf->Output();
?>