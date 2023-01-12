<?php

include "db.php";

$base = "";

if (isset($_POST['id'])) {
    $base .= 'Existe!';
} else {
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
                            btn-danger mr-1" id="'.$dado['id'].'">
                    </td>
                </tr>
            ';     
        }
    }

echo $base;