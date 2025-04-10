<?php
function medirTempoRequisicoesParalelas($urls) {
    $multiHandle = curl_multi_init();
    $curlHandles = [];

    foreach ($urls as $key => $url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curlHandles[$key] = $ch;
        curl_multi_add_handle($multiHandle, $ch);
    }

    $inicio = microtime(true);

    do {
        $status = curl_multi_exec($multiHandle, $running);
        curl_multi_select($multiHandle);
    } while ($running > 0);

    $fim = microtime(true);

    $conteudo = [];
    foreach ($curlHandles as $key => $ch) {
        $conteudo[$key] = curl_multi_getcontent($ch);
        curl_multi_remove_handle($multiHandle, $ch);
        curl_close($ch);
    }

    curl_multi_close($multiHandle);

    return [
        'tempos' => number_format($fim - $inicio, 4),
        'respostas' => $conteudo
    ];
}

// Conjuntos de URLs
$urls1 = [
    'root' => 'http://localhost/AtividadeArquitetura/',
    'demorado' => 'http://localhost/AtividadeArquitetura/demorado.php',
];

$urls2 = [
    'demorado' => 'http://localhost/AtividadeArquitetura/demorado.php',
    'root' => 'http://localhost/AtividadeArquitetura/',
];

$urls3 = [
    'excecao' => 'http://localhost/AtividadeArquitetura/excecao.php',
    'root' => 'http://localhost/AtividadeArquitetura/',
];
$url1 = [
    'root' => 'http://localhost/AtividadeArquitetura/',
];

$url2 = [
    'demorado' => 'http://localhost/AtividadeArquitetura/demorado.php',
];

$url3 = [
    'excecao' => 'http://localhost/AtividadeArquitetura/excecao.php',
];

$resultado1 = medirTempoRequisicoesParalelas($urls1);
$resultado2 = medirTempoRequisicoesParalelas($urls2);
$resultado3 = medirTempoRequisicoesParalelas($urls3);

$resultado4 = medirTempoRequisicoesParalelas($url1);
$resultado5 = medirTempoRequisicoesParalelas($url2);
$resultado6 = medirTempoRequisicoesParalelas($url3);

// Exibe os resultados
echo "<h3>Teste 1: / depois /demorado</h3>";
echo "Tempo de execução: {$resultado1['tempos']} segundos<br>";

echo "<h3>Teste 2: /demorado depois /</h3>";
echo "Tempo de execução: {$resultado2['tempos']} segundos<br>";

echo "<h3>Teste 3: /excecao depois /</h3>";
echo "Tempo de execução: {$resultado3['tempos']} segundos<br>";

echo "<h3>Tempos individuais: /</h3>";
echo "Tempo de execução /: {$resultado4['tempos']} segundos<br>";
echo "Tempo de execução /demorado.php: {$resultado5['tempos']} segundos<br>";
echo "Tempo de execução /excecao.php: {$resultado6['tempos']} segundos<br>";
?>
