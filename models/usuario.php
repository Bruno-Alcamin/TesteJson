<?php
    class Usuario{
    
        public function listaUsuario(){
            $mysqli = new mysqli("127.0.0.1", "bruno_alcamin", "", "Teste");
                
            $stmt = $mysqli->query("SELECT * FROM User");
            
            $dados = [];
            
            for ($count=0; $row = $stmt->fetch_assoc(); $count++){
                $dados[$count] = $row;
            } 
            
            return json_encode($dados);
        }
        
        public function insertUsurario(){
            $mysqli = new mysqli("127.0.0.1", "bruno_alcamin", "", "Teste");
            $nome = $_POST["nome"];
            $stmt = $mysqli->prepare("INSERT INTO User(nm_Usuario) VALUES (?)");
            $stmt->bind_param("s",$nome);
            $stmt->execute();
            $stmt = $mysqli->query("SELECT * FROM User order by cd_User DESC LIMIT 1")->fetch_assoc();
            return json_encode($stmt);
        }
    }
?>