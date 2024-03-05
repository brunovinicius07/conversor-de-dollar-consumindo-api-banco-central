<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Desafio PHP</title>
</head>
<body>
    <header>
        <h1>Conversor de Moedas v2.0</h1>
    </header>
    <main>
        <?php 
            $real = $_GET["numero"] ?? "0";
            $inicio = date("m-d-Y", strtotime("-7 days")); 
            $fim = date("m-d-Y");

            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $inicio .'\'&@dataFinalCotacao=\''. $fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            $dados = json_decode(file_get_contents($url), true);
            $cotacao = $dados["value"][0]["cotacaoCompra"];
            $dolar = $real / $cotacao;
            echo "<p>R$ " . number_format($real, 2, ",", ".") . " equivalem a <strong>US$ " .
             number_format($dolar, 2, ",", ".") . "</strong>";

            echo "<p><strong>*Cotação R$" . number_format($cotacao, 2, ",", ".") .
             "</strong> obtida diretamente do site do <a href='https://www.bcb.gov.br/'  target='_blank'>Branco Central do Brasil.</a>";
        ?>
        <p><a href="javascript:history.go(-1)">Voltar para página anterior</a></p>
    </main>
</body>
</html>