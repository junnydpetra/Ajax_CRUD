<?php

include "db.php";

$base = "";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = 'SELECT * FROM user WHERE id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    $dados = $cmd->fetch();

    $base .= '
        <form action="" class="form-group" id="update">
            <div class="row">
                <div class="col-sm-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" 
                     placeholder="Informe o nome" value="'.$dados['nome'].'"> 
                </div>
                
                <div class="col-sm-3">
                    <label class="form-label">Email</label>
                    <input type="hidden" name="id" id="id" class="form-control" 
                     value="'.$dados['id'].'"> 
                    <input type="email" name="email" id="email" class="form-control" 
                    placeholder="Informe o email" value="'.$dados['email'].'"> 
                </div>

                <div class="col-sm-3">
                    <label for="" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-control value="'.$dados['estado'].'"">
                        <option value="'.$dados['nome'].'">'.$dados['estado'].'</option>
                        <option value="Minas Gerais">Minas Gerais</option>
                        <option value="São Paulo">São Paulo</option>
                        <option value="Mato Grosso">Mato Grosso</option>
                        <option value="Goiás">Goiás</option>
                        <option value="Paraná">Paraná</option>
                        <option value="Santa Catarina">Santa Catarina</option>
                    </select>
                </div>

                <div class="col-sm-3">
                    <label for="" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="" placeholder="CPF" class="form-control" 
                     value="'.$dados['cpf'].'">
                </div>

            </div>
                <div class="row pt-4">
                    <div class="">
                        <input type="submit" value="Atualizar" id="update" class="btn btn-primary col-sm-12">
                    </div>
                </div>

        </form>
        ';
}elseif(isset($_POST['del'])){
 
    $id = $_POST['del'];
    $sql = 'DELETE FROM user WHERE id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $dados = $cmd->execute();

    if ($cmd->rowCount() >= 1) {
        $base .= "<p class='alert alert-success text-center mt-3'> Exclusão realizada!</p>";
    } else {
        $base .= "<p class='alert alert-danger text-center mt-3'> Falha na tentativa de remoção! </p>";     
    }

}else{
        $sql = 'SELECT * FROM user';
        $cmd = $pdo->prepare($sql);
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($dados as $dado) 
        {
            $base .= '
                <tr>
                    <td>'.$dado['nome'].'</td>
                    <td>'.$dado['email'].'</td>
                    <td>'.$dado['estado'].'</td>
                    <td>'.$dado['cpf'].'</td>
                    <td>
                        <input type="submit" value="Editar" class="edit btn btn-sm 
                            btn-success m-1" id="'.$dado['id'].'">
                        <input type="submit" value="Exlcuir" class="btn btn-sm 
                            btn-danger mr-1 delete" id="'.$dado['id'].'">
                    </td>
                </tr>
            ';     
        }
}

echo $base;