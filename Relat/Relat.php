<?php
require('fpdf.php');

$db = new PDO('mysql:host=localhost;dbname=testespassu', 'TesteSpassu', '@Teste$passu');

class myPDF extends FPDF{

    function header(){
        $this->Image('logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276, 5, 'LISTA DE LIVROS', 0, 0, 'C');
        $this->Ln();
        $this->SetFont('Times','',10);
        $this->Cell(276, 10, 'Teste Spassu - 2024', 0, 0, 'C');
        $this->Ln(20);
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }

    function headerTable(){
        $this->SetFont('Times','B', 10);
        $this->Cell(15,10,'COD',1,0,'C');
        $this->Cell(35,10,'TITULO',1,0,'C');
        $this->Cell(35,10,'EDITORA',1,0,'C');
        $this->Cell(15,10,'EDICAO',1,0,'C');
        $this->Cell(15,10,'ANO',1,0,'C');
        $this->Cell(70,10,'AUTOR',1,0,'C');
        $this->Cell(25,10,'VALOR',1,0,'C');
        $this->Cell(50,10,'ASSUNTO',1,0,'C');

        $this->Ln();

    }

    function viewTable($db){



        $this->SetFont('Times','', 8);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * from vw_lista_livros";
        $stmt = $db->query($sql);
        $cA_atual = 0;
        $cA_tot = 0;

        while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {


            $sqlA = "SELECT distinct Nome FROM autor a
            INNER JOIN livro_autor la ON la.Autor_CodAu = a.CodAu
            WHERE la.Livro_Cod = " . $data->Cod ;
            $stmtA = $db->query($sqlA);
    
            $autores = "";
            foreach ($stmtA as $a) {
                if ($autores == "") {
                    $autores = $a['Nome'];
                } else {
                    $autores = $autores . " - " . $a['Nome'];
                }
                $cA_atual =  $cA_atual + 5;

            }   
            
            if ($cA_atual > $cA_tot) {
                $cA_tot = $cA_atual;
            }

            $this->Cell(15,$cA_tot,$data->Cod,1,0,'C');
            $this->Cell(35,$cA_tot,$data->Titulo,1,0,'L');
            $this->Cell(35,$cA_tot,$data->Editora,1,0,'C');
            $this->Cell(15,$cA_tot,$data->Edicao,1,0,'C');
            $this->Cell(15,$cA_tot,$data->AnoPublicacao,1,0,'C');
            $x = $this->GetX();
            $y = $this->GetY();
            $this->MultiCell(70, $cA_tot, $autores, 1, 'L');
            $this->SetXY($x + 70, $y);
            $this->Cell(25,$cA_tot,$data->Preco,1,0,'C');
            $this->Cell(50,$cA_tot,$data->Descricao,1,0,'C');
            $this->Ln();
        }
    }

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>