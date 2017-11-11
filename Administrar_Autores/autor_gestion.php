<?php
    require "controladores/autorController.php";
    $autor = new AutorController();
    $resultado = $autor->ListarAutores();
    //var_dump($resultado->fetch_assoc());
    $eliminar = $autor->eliminar();
?>
<link href="css/bootstrap.css" rel="stylesheet">
<div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Apellido</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
        <h1 style="margin-left: 10px"> Autores</h1> 
        <button style="margin-left: 10px"class="btn btn-success"><a style="text-decoration:none; color:white"  href="autor_nuevo.php">Nuevo Autor</a></button>
        <?php
            while($array = $resultado -> fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $array["apellido"]; ?></td>
                     <td><?php echo $array["nombre"]; ?></td>
                    <form method="POST">
                    <td>
                        <input type="hidden" name="id_a" id="id_a" value="<?php echo $array["id_autor"]; ?>">
                        <input type="button" value="modificar" class="btn btn-warning" onclick="this.form.action='autor_modificar.php'; this.form.submit()">
                        <input type="button" value="eliminar" class="btn btn-danger" onclick="this.form.submit()">
                    </td>
                    </form>
                </tr>
            <?php }
        ?>
        </tbody>
    </table>
</div>
<?php
    $resultado=$autor->eliminar();
?>