<?php 
/**
 * Plugin Name: Pegar valor do dólar
 * Description: Plugin para obter o valor do dólar 
 * Version: 1.0.0
 * Author: Giovane Ferreira
 * Author URI: https://github.com/giovanef16-sys
 * 
 */

add_shortcode("valor_dolar", function() {
    // Iniciando conexão com o link que queremos acessar, enviando os parâmetros (get ?)
    $ch = curl_init("http://economia.awesomeapi.com.br/json/last/USD-BRL");
                    
    // Definindo configurações para a nossa conexão (Parâmetros: conexão, comando, valor)
    curl_setopt($ch, CURLOPT_HEADER, 0); // Desativa retorno das informações do cabeçalho do server
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Desativa verificação SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Desativa verificação SSL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Ativamos para permitir receber os dados enviados pelo server
    
    $res_curl = curl_exec($ch); // Executamos a nossa conexão

    $resultado = json_decode($res_curl, true); // Convertendo a string JSON para Array
        
    curl_close($ch); // Fechando a conexão

    return $resultado["USDBRL"]["low"]; // Pegando o valor da chave low, que está dentro de dois arrays
});

add_shortcode("valor_euro", function(){
    $ch = curl_init("http://economia.awesomeapi.com.br/json/last/EUR-BRL"); // Iniciando a conexão

    curl_setopt($ch, CURLOPT_HEADER, 0); // Desativando o retorno das informações de cabeçalho
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Desativando verificação SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Desativando verificação SSL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Permitindo o retorno das informações

    $res_curl = curl_exec($ch); // Executando a conexão

    $resultado = json_decode($res_curl, true); // Conveterndo de Json para Array

    // print_r($resultado); Outra forma de visualizar o array multidimensional

    curl_close($ch); // Encerrando a conexão

    return $resultado["EURBRL"]["low"]; // Dentro do Array "EURBRL", estamos pegando a informação da chave "low"
})

?>
