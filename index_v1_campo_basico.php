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

            if ($cad_usuario->rowCount()) {
                echo "Usuário cadastrado com sucesso!<br>";
                unset($dados);
            } else {
                echo "Erro: Usuário não cadastrado com sucesso!<br>";
            }
        } catch (PDOException $erro) {
            echo "Erro: Usuário não cadastrado com sucesso!<br>";
            //echo "Erro: Usuário não cadastrado com sucesso. Erro gerado: " . $erro->getMessage() . " <br>";
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
        <input type="email" name="email" placeholder="Melhor e-mail do usuário" value="<?php echo $email; ?>" required /><br><br>


        <?php
        $senha = "";
        if (isset($dados['senha'])) {
            $senha = $dados['senha'];
        }
        ?>
        <label>Senha: </label>
        <input type="password" name="senha" placeholder="Senha do usuário" value="<?php echo $senha; ?>" required /><br><br>

        <?php
        $sists_usuario_id = "";
        if (isset($dados['sists_usuario_id'])) {
            $sists_usuario_id = $dados['sists_usuario_id'];
        }
        ?>
        <label>Situação do Usuário: </label>
        <input type="number" name="sists_usuario_id" placeholder="Situação do usuário" value="<?php echo $sists_usuario_id; ?>" required /><br><br>

        <?php
        $niveis_acesso_id = "";
        if (isset($dados['niveis_acesso_id'])) {
            $niveis_acesso_id = $dados['niveis_acesso_id'];
        }
        ?>
        <label>Nível de Acesso: </label>
        <input type="number" name="niveis_acesso_id" placeholder="Nível de acesso do usuário" value="<?php echo $niveis_acesso_id; ?>" required /><br><br>

        <input type="submit" value="Cadastra" name="SendCadUsuario" />
    </form>
</body>

</html>