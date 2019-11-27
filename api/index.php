<?php
require './vendor/autoload.php';
require 'config.php';

Flight::route('/lista-chamados/@data', function($data){
    header('Access-Control-Allow-Origin: *');

    global $pdo;
    $chamados = "SELECT * FROM registro_plantao WHERE data = :data";
    $res = $pdo->prepare($chamados);
    $res->bindValue(':data', $data);
    $res->execute();
    
    $res = $res->fetchAll();
    
    foreach ($res as $key => $date) {
        $res[$key]['hora'] = $date['hora_inicio']. ' até '.$date['hora_fim'];
    }

    echo json_encode($res);
});

Flight::route('/add-chamados', function(){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: content-type');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Request-Method: *');

    $dados = Flight::request()->data['payload'];

    $camposObrigatorios = !empty($dados['plantonista']) && !empty($dados['ocorrencia']) && !empty($dados['horaInicio']) && !empty($dados['horaFim']);

    $novaData = date($dados['data'], strtotime('Y-m-d'));

    if($camposObrigatorios) {
        global $pdo;
        $insert = 'INSERT INTO registro_plantao SET data = :dataPlantao, plantonista = :plantonista, tipo = :tipo, hora_inicio = :inicio, hora_fim = :fim, ticket = :ticket, descricao = :descr';
        $res = $pdo->prepare($insert);
        $res->bindValue(':dataPlantao', $novaData);
        $res->bindValue(':plantonista', $dados['plantonista']);
        $res->bindValue(':tipo', $dados['ocorrencia']);
        $res->bindValue(':inicio', $dados['horaInicio']);
        $res->bindValue(':fim', $dados['horaFim']);
        $res->bindValue(':ticket', $dados['ticket']);
        $res->bindValue(':descr', $dados['desc']);
        $res->execute();
    } else {
        echo 'addFail';
    }
});


Flight::route('/update-chamado', function(){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: content-type');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Request-Method: *');

    $dados = Flight::request()->data['payload'];

    global $pdo;

    if ($dados['campo']['name'] == 'hora') {
        $hora = explode('até', $dados['campo']['value']);

        $update = "UPDATE registro_plantao SET hora_inicio = :inicio, hora_fim = :fim WHERE id_registro = :{$dados['id']} LIMIT 1";
        $res = $pdo->prepare($update);
        $res->bindValue(":inicio", trim($hora[0]));
        $res->bindValue(":fim", trim($hora[1]));
        $res->bindValue(":{$dados['id']}", $dados['id']);
        $res->execute();

    } else {
        $update = "UPDATE registro_plantao SET {$dados['campo']['name']} = :{$dados['campo']['name']} WHERE id_registro = :{$dados['id']} LIMIT 1";
        $res = $pdo->prepare($update);
        $res->bindValue(":{$dados['campo']['name']}", $dados['campo']['value']);
        $res->bindValue(":{$dados['id']}", $dados['id']);
        $res->execute();
    }
    
});

Flight::route('/delete-chamado', function(){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: content-type');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Request-Method: *');

    $id = Flight::request()->data['payload'];

    global $pdo;

    $delete = "DELETE FROM registro_plantao WHERE id_registro = :id LIMIT 1";
    $res = $pdo->prepare($delete);
    $res->bindValue(":id", $id);
    $res->execute();
    
});


Flight::start();