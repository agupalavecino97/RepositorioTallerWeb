<?php

    require_once "modelos/autor.php";
    
    class AutorController{

        public function ListarAutores(){
            $respuesta = Autor::buscar();//si tira error 'deprecated' usar flechita
            if($respuesta!=NULL){
                return $respuesta;
            }else{
                echo "<script language='javascript'>alert('No existen autores')</script>";
            }
        }

        public function guardarAutor(){
            if(isset($_POST["nomAutor"]) && isset($_POST["apelAutor"])){
                
                $nombre = $_POST["nomAutor"]; 
                $apellido = $_POST["apelAutor"]; 
                $datos = array("nombre"=>$nombre, "apellido"=>$apellido);
                //var_dump($datos);die();
                $res = Autor::agregar($datos);
                if($res>=0){
                    if($res==0){
                            //ya existe
                        echo "<script language='javascript'>alert('El autor ya existe, no se puede ingresar un autor ya existente.');</script>";
                        echo "<script language='javascript'>window.location='index.php'</script>";
                    }
                    else{
                        //=1
                        echo "<script language='javascript'>alert('El autor se añadió correctamente.')</script>";
                        echo "<script language='javascript'>window.location='index.php'</script>";
                    }
                }else{
                    // = -1
                    echo "<script language='javascript'>alert('Error al añadir autor, intente nuevamente...')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }
            }

        }

        public function buscarAutor(){
            if(isset($_POST["id_a"])){
                $id = $_POST["id_a"];
                $res = Autor::buscarX($id);
                $array = $res->fetch_assoc();
                if($res===0){
                    echo "<script language='javascript'>alert('No existe')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }else{
                    return $array;
                }
            }
        }

        /*public function mostrarAutor(){

        }*/
        //no se usa porque no lo pude hacer andar llamando a la funcion desde la vista,
        //funciona con ajax y actualizarAutorX


        public function actualizarAutor(){
           // var_dump($_POST["nomAutor"]);
           // die();
            if(isset($_POST["id_modificar"])){
                //echo 'actualizarAutor';
                $id = $_POST["id_modificar"];
                $nombre = $_POST["nomAutor"]; 
                $apellido = $_POST["apelAutor"]; 
                $autorNuevo = array("id"=> $id,"nombre"=>$nombre, "apellido"=>$apellido);
                $res = Autor::actualizar($autorNuevo);
                //echo $res;
                if($res===0){
                    echo "<script language'javascript'>alert('Error al actualizar, se redireccionará al inicio :(')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }else{
                    echo "<script language='javascript'>alert('Autor actualizado, se redireccionará al inicio :) ')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }  
            } 
        }


        public function eliminar(){
            if(isset($_POST['id_a'])){
                $idAutor = $_POST['id_a'];
                // echo $idAutor;die();exit();
                $res = Autor::eliminar($idAutor);
                if($res>0){
                    echo "<script language='javascript'>alert('Se elimino correctamente el autor, se redireccionará a la página principal')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }else{
                    echo "<script language='javascript'>alert('No se pudo eliminar el autor, intente nuevamente')</script>";
                    echo "<script language='javascript'>window.location='index.php'</script>";
                }
            }
        }

    }

?>

