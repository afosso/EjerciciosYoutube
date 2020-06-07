<?php

    require 'conexion.php';

    class Persona{

        public function ConsultarTodo(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("SELECT * FROM persona");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function ConsultarPorId($idPersona){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("SELECT * FROM persona where idPersona = :idPersona");
            $stmt->bindValue(":idPersona", $idPersona, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function Guardar($nombres, $apellidos, $fechaNacimiento, $direccion, $telefono){

            $conexion = new Conexion();
            $stmt = $conexion->prepare("INSERT INTO `persona`
                                                (`nombres`,
                                                `apellidos`,
                                                `fechaNacimiento`,
                                                `direccion`,
                                                `telefono`)
                                    VALUES (:nombres,
                                            :apellidos,
                                            :fechaNacimiento,
                                            :direccion,
                                            :telefono);");
            $stmt->bindValue(":nombres", $nombres, PDO::PARAM_STR);
            $stmt->bindValue(":apellidos", $apellidos, PDO::PARAM_STR);
            $stmt->bindValue(":fechaNacimiento", $fechaNacimiento, PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $telefono, PDO::PARAM_STR);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al guardar la información";
            }

        }

        public function Modificar($idPersona, $nombres, $apellidos, $fechaNacimiento, $direccion, $telefono){

            $conexion = new Conexion();
            $stmt = $conexion->prepare("UPDATE `persona`
                                        SET `nombres` = :nombres,
                                        `apellidos` = :apellidos,
                                        `fechaNacimiento` = :fechaNacimiento,
                                        `direccion` = :direccion,
                                        `telefono` = :telefono
                                        WHERE `idPersona` = :idPersona;");
            $stmt->bindValue(":nombres", $nombres, PDO::PARAM_STR);
            $stmt->bindValue(":apellidos", $apellidos, PDO::PARAM_STR);
            $stmt->bindValue(":fechaNacimiento", $fechaNacimiento, PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindValue(":idPersona", $idPersona, PDO::PARAM_INT);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al modificar la información";
            }

        }

        public function Eliminar($idPersona){

            $conexion = new Conexion();
            $stmt = $conexion->prepare("DELETE FROM persona WHERE idPersona = :idPersona");
            $stmt->bindValue(":idPersona", $idPersona, PDO::PARAM_INT);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al eliminar la información";
            }

        }

    }

?>