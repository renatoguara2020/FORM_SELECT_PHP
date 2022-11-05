<?php
include_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Celke - Formulario com INSERT</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
</head>

<body>
    <h2>Cadastrar Usuário</h2>
    <?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendCadUsuario'])) {
        //var_dump($dados);

        try {
            $query_usuario = "INSERT INTO usuarios (nome, email, senha, sists_usuario_id, niveis_acesso_id, created) 
                VALUES (:nome, :email, :senha, :sists_usuario_id, :niveis_acesso_id, NOW())";
            $cad_usuario = $conn->prepare($query_usuario);
            $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':email', $dados['email']);
            $senha_cript = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $cad_usuario->bindParam(':senha', $senha_cript);
            $cad_usuario->bindParam(':sists_usuario_id', $dados['sists_usuario_id'], PDO::PARAM_INT);
            $cad_usuario->bindParam(':niveis_acesso_id', $dados['niveis_acesso_id'], PDO::PARAM_INT);

            $cad_usuario->execute();

            if ($cad_usuario->rowCount() > 0) {
                echo "Usuário cadastrado com sucesso!<br>";
                unset($dados);
            } else {
                echo "Erro: Usuário não cadastrado com sucesso!<br>";
            }
        } catch (PDOException $erro) {
            echo "Erro: Usuário não cadastrado com sucesso!<br>".$erro->getMessage();
            echo "Erro: Usuário não cadastrado com sucesso. Erro gerado:   $erro->getMessage()   <br>";
        }
    }

    ?>
    <form method="POST" action="">
        <label>Nome: </label>
        <?php
        $nome = "";
        if (isset($dados['nome'])) {
            $nome = $dados['nome'];
        }
        ?>
        <input type="text" name="nome" placeholder="Nome completo" value="<?php echo $nome; ?>" required /><br><br>


        <?php
        $email = "";
        if (isset($dados['email'])) {
            $email = $dados['email'];
        }
        ?>
        <label>E-mail: </label>
        <input type="email" name="email" placeholder="Melhor e-mail do usuário" value="<?php echo $email; ?>"
            required /><br><br>


        <?php
        $senha = "";
        if (isset($dados['senha'])) {
            $senha = $dados['senha'];
        }
        ?>
        <label>Senha: </label>
        <input type="password" name="senha" placeholder="Senha do usuário" value="<?php echo $senha; ?>"
            required /><br><br>

        <?php
        $query_sists_usuarios = "SELECT id, nome FROM sists_usuarios ORDER BY nome ASC";
        $result_sists_usuarios = $conn->prepare($query_sists_usuarios);
        $result_sists_usuarios->execute();
        ?>
        <label>Situação do Usuário: </label>
        <select name="sists_usuario_id" required>
            <option value="">Selecione</option>
            <?php
            while ($row_sist_usuario = $result_sists_usuarios->fetch(PDO::FETCH_ASSOC)) {
                $select_sit_usuario = "";

                if (isset($dados['sists_usuario_id']) and ($dados['sists_usuario_id'] == $row_sist_usuario['id'])) {
                    $select_sit_usuario = "selected";
                }

                echo "<option value='" . $row_sist_usuario['id'] . "' $select_sit_usuario>" . $row_sist_usuario['nome'] . "</option>";
            }
            ?>
        </select>
        <br><br>

        <?php
        $query_niveis_acessos = "SELECT id, nome FROM niveis_acessos ORDER BY nome ASC";
        $result_niveis_acessos = $conn->prepare($query_niveis_acessos);
        $result_niveis_acessos->execute();
        ?>
        <label>Nível de Acesso: </label>
        <select name="niveis_acesso_id" required>
            <option value="">Selecione</option>
            <?php
            while ($row_nivel_acesso = $result_niveis_acessos->fetch(PDO::FETCH_ASSOC)) {
                $select_nivel_acesso = "";

                if (isset($dados['niveis_acesso_id']) and ($dados['niveis_acesso_id'] == $row_nivel_acesso['id'])) {
                    $select_nivel_acesso = "selected";
                }

                echo "<option value='" . $row_nivel_acesso['id'] . "' $select_nivel_acesso>" . $row_nivel_acesso['nome'] . "</option>";
            }
            ?>
        </select>
        <br><br>

        <input type="submit" value="Cadastra" name="SendCadUsuario" />
    </form>
</body>

</html>