<?php
include "db.php";
$erro = array();
$saida = "";

if (isset($_POST['id'])) 
{
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $estado = addslashes($_POST['estado']);
    $cpf = addslashes($_POST['cpf']);
    $id = $_POST['id'];

    $sql = 'UPDATE user SET nome = :n, email = :m, estado = :e, cpf = :c WHERE id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":n", $nome);
    $cmd->bindValue(":m", $email);
    $cmd->bindValue(":e", $estado);
    $cmd->bindValue(":c", $cpf);
    $cmd->bindValue(":id", $id);
    $cmd->execute();

    if ($cmd->rowCount() >= 1) {
        $saida .= "<p class='alert alert-success text-center mt-3'> 
        Usuário " .$nome. " cadastrado com sucesso!</p>";
    } else {
        $saida .= "<p class='alert alert-danger text-center mt-3'> Falha ao realizar cadastro! </p>";     
    }

} else {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $estado = addslashes($_POST['estado']);
    $cpf = addslashes($_POST['cpf']);

    if (empty($nome))
    {
        $erro['e'] = "Informe um nome válido!";
    } else if (empty($email)) {
        $erro['e'] = "Informe um email válido!";
    } else if (empty($estado)) {
        $erro['e'] = "Selecione um estado!";
    } else if (empty($cpf)) {
        $erro['e'] = "Informe um CPF válido!";
    } else {
        $sql = 'INSERT INTO user(nome, email, estado, cpf) VALUE(:n, :m, :e, :c)';
        $cmd = $pdo->prepare($sql);
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":m", $email);
        $cmd->bindValue(":e", $estado);
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();

        if ($cmd->rowCount() >= 1) {
            $saida .= "<p class='alert alert-success text-center mt-3'> 
            Usuário " .$nome. " cadastrado com sucesso!</p>";
        } else {
            $saida .= "<p class='alert alert-danger text-center mt-3'> Falha ao realizar cadastro! </p>";     
        }
    }
}

if (isset($erro['e']))
{
    $saida .= "<p class='alert alert-danger text-center mt-3'>".$erro['e']."</p>";
}

echo $saida;