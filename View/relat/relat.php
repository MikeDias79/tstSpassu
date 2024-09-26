<?php

class PDF extends FPDF
{
    // Função para criar o cabeçalho do relatório
    function Header()
    {
        // Definindo a fonte
        $this->SetFont('Arial', 'B', 12);
        // Título do relatório
        $this->Cell(0, 10, 'Relatorio de Vendas - 2024', 0, 1, 'C');
        // Pulando uma linha
        $this->Ln(10);
    }

    // Função para criar o rodapé do relatório
    function Footer()
    {
        // Posicionando o rodapé a 1.5 cm da parte inferior
        $this->SetY(-15);
        // Definindo a fonte do rodapé
        $this->SetFont('Arial', 'I', 8);
        // Número da página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Função para criar a tabela de dados
    function CreateTable($header, $data)
    {
        // Definindo a fonte da tabela
        $this->SetFont('Arial', 'B', 10);
        // Criando o cabeçalho da tabela
        foreach ($header as $col) {
            $this->Cell(40, 7, $col, 1);
        }
        $this->Ln();

        // Preenchendo os dados
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(40, 6, $col, 1);
            }
            $this->Ln();
        }
    }
}

$pdf = new PDF();

$pdf->AddPage();

$header = array('COD', 'TITULO', 'EDITORA', 'EDICAO', 'ANO', 'AUTOR', 'ASSUNTO');

$data = array();

foreach($this->model->Relat() as $r):
    array_push($data, array(
        'Cod' => $r->Cod,
        'Titulo' => $r->Titulo,
        'Editora' => $r->Editora,
        'Edicao' => $r->Edicao,
        'AnoPublicacao' => $r->AnoPublicacao,
        'Nome' => $r->Nome,
        'Descricao' => $r->Descricao
    ));
endforeach;


// Chamando a função para gerar a tabela com os dados
$pdf->CreateTable($header, $data);

// Gerando o PDF
$pdf->Output();
?>
