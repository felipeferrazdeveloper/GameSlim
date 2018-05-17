<?php

namespace controller;

require_once "model/Genero.php";
use \model\Genero;

class GeneroController{
    private $PDO;

    function __construct()
    {
        $this->PDO = new \PDO("mysql:host=localhost;port=3306;dbname=game_db", "root", "root");
        $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getAll(){
        global $app;

        $sql = "SELECT * FROM genero";
        $ds = $this->PDO->prepare($sql);
        $ds->execute();

        $result = $ds->fetchAll(\PDO::FETCH_CLASS, Genero::class);
        $app->render("default.php", ["data" => $result], 200);
    }


    public function cadastrarGenero(){
        global $app;

        $dados = $app->request->getBody();
        $dados = (sizeof($dados) == 0) ? $_POST : $dados;

        $sql = "insert into genero VALUES (Null, :descricao, :titulo)";
        $ds = $this->PDO->prepare($sql);
        $ds->execute($dados);

        $dados['id'] = $this->PDO->lastInsertId();

        $app->render("default.php", ["data" => $dados], 200);
    }

    public function apagarGenero($id){
        global $app;

        $sql = "delete from genero where id = :id)";
        $ds = $this->PDO->prepare($sql);
        $ds.bindValue(":id", $id);
        $ds->execute();

        $app->render("default.php",
            ["data" => "ok"],
            200);

    }
}