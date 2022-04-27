<?php 
/**
 * Plugin Name: Cotação moedas
 * Description: Plugin para obter o valor das cotações (Dólar, Euro e criptomoedas)
 * Version: 1.0.0
 * Author: Giovane Ferreira
 * Author URI: https://github.com/giovanef16-sys
 * 
 */
add_shortcode("valor_moeda", function($atts) {
    $moeda = $atts["moeda"];
    // Iniciando conexão com o link que queremos acessar, enviando os parâmetros (get ?)
    $ch = curl_init("https://economia.awesomeapi.com.br/json/last/$moeda-BRL");
    // Definindo configurações para a nossa conexão (Parâmetros: conexão, comando, valor)
    curl_setopt($ch, CURLOPT_HEADER, 0); // Desativa retorno das informações do cabeçalho do server
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Desativa verificação SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Desativa verificação SSL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Ativamos para permitir receber os dados enviados pelo server
    $res_curl = curl_exec($ch); // Executamos a nossa conexão
    $resultado = json_decode($res_curl, true); // Convertendo a string JSON para Array
    curl_close($ch); // Fechando a conexão
    // Pegando o valor da chave high, que está dentro do array [USDBRL]
    $num = $resultado["{$moeda}BRL"]["low"];
    return substr($num, 0, 4); // retornando a string tratada
});

add_shortcode("criptomoedas", function($atts){
    $entrada = $atts["entrada"];

    $ch = curl_init("https://api.coinranking.com/v2/coins");
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    $res_curl = curl_exec($ch); 
    $resultado = json_decode($res_curl, true);
    curl_close($ch);
    
    $formatado = (float)$resultado["data"]["coins"][$entrada]["price"];

    return number_format($formatado, 2, ',', '.');
});

?>
