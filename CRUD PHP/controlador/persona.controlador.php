<?php

    require '../modelo/persona.modelo.php';

    if($_POST){
        $persona = new Persona();

        switch($_POST["accion"]){
            case "CONSULTAR":
                echo json_encode($persona->ConsultarTodo());
            break;
            case "CONSULTAR_ID":
                echo json_encode($persona->ConsultarPorId($_POST["idPersona"]));
            break;
            case "GUARDAR":
                $nombres = $_POST["nombres"];
                $apellidos = $_POST["apellidos"];
                $fechaNacimiento = $_POST["fechaNacimiento"];
                $direccion = $_POST["direccion"];
                $telefono = $_POST["telefono"];

                if($nombres == ""){
                    echo json_encode("Debe ingresar los nombres de la persona");
                    return;
                }

                if($apellidos == ""){
                    echo json_encode("Debe ingresar los apellidos de la persona");
                    return;
                }

                if($fechaNacimiento == ""){
                    echo json_encode("Debe ingresar la Fecha Nacimiento de la persona");
                    return;
                }

                if($direccion == ""){
                    echo json_encode("Debe ingresar la dirección de la persona");
                    return;
                }

                if($telefono == ""){
                    echo json_encode("Debe ingresar el teléfono de la persona");
                    return;
                }

                $respuesta = $persona->Guardar($nombres, $apellidos, $fechaNacimiento, $direccion, $telefono);
                echo json_encode($respuesta);
            break;
            case "MODIFICAR":
                $nombres = $_POST["nombres"];
                $apellidos = $_POST["apellidos"];
                $fechaNacimiento = $_POST["fechaNacimiento"];
                $direccion = $_POST["direccion"];
                $telefono = $_POST["telefono"];
                $idPersona = $_POST["idPersona"];

                if($nombres == ""){
                    echo json_encode("Debe ingresar los nombres de la persona");
                    return;
                }

                if($apellidos == ""){
                    echo json_encode("Debe ingresar los apellidos de la persona");
                    return;
                }

                if($fechaNacimiento == ""){
                    echo json_encode("Debe ingresar la Fecha Nacimiento de la persona");
                    return;
                }

                if($direccion == ""){
                    echo json_encode("Debe ingresar la dirección de la persona");
                    return;
                }

                if($telefono == ""){
                    echo json_encode("Debe ingresar el teléfono de la persona");
                    return;
                }

                $respuesta = $persona->Modificar($idPersona, $nombres, $apellidos, $fechaNacimiento, $direccion, $telefono);
                echo json_encode($respuesta);
            break;
            case "ELIMINAR":
                $idPersona = $_POST["idPersona"];
                $respuesta = $persona->Eliminar($idPersona);
                echo json_encode($respuesta);
            break;
        }
    }

?>