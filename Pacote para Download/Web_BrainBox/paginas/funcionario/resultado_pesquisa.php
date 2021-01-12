<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../../boots/css/bootstrap.min.css">
        <script src="../../js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="../../boots/js/bootstrap.min.js"></script>
        <script src="js/personalizado.js"></script>
    </head>
    <body>
        <?php
       include_once '../../classes/conexao.php';
        if (isset($_SESSION['msg'])) {
            $mensagem = ($_SESSION['msg']);
            unset($_SESSION['msg']);
        }
        $usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
      
//consultar no banco de dados
        $result_usuario = "SELECT * FROM usuarios WHERE nome_usuario LIKE '%$usuarios%' AND nivel_usuario=1 LIMIT 10";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
//Verificar se encontrou resultado na tabela "usuarios"
        if (($resultado_usuario) AND ( $resultado_usuario->num_rows != 0)) {
            ?>
         <table class="table table-striped table-bordered table-hover table table-sm">
            <thead> 
                    <tr style="text-align:center">
                        <th style="width:2em;">Id</th>
                        <th>Nome do cliente</th>
                        <th>E-mail do cliente</th>
                        <th style="width:2em;">Opção</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
                        ?>
                        <tr>
                            <th><?php echo $row_usuario['id_usuario']; ?></th>
                            <td><?php echo $row_usuario['nome_usuario']; ?></td>
                            <td><?php echo $row_usuario['email_usuario']; ?></td>
                            <td><button type="button" class="btn btn-danger" style="text-decoration: none; padding: 4px;"><?php echo "<a href='apagar_cliente_pesquisado.php?id=" . $row_usuario['id_usuario'] . "' data-confirm='Tem certeza de que deseja excluir o cliente selecionado?'><font color='#FFF'>Apagar</font></a>" ?></button></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
         </table>
            <?php
        } else {
            ?>
           <div class = "alert alert-danger" role = "alert" style="margin-top: 1em; margin-left:1em;">
               Nenhuma correspondência para "<?php echo $usuarios;?>".
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline: none!important;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <?php
        }
        ?>
    </body>
</html>
