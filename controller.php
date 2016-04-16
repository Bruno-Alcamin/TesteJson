<?php
class Recursos{
    //VEM DA URL
    private $arg1, $arg2;
    
    public function __construct($arg1=0,$arg2=0){
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
    }
    
    public function __call($m,$e){
        http_response_code(400);
        echo "Erro: chamada invalida<br>";
    }
    
    public function all(){
        foreach($_SERVER as $key => $value) {
            echo "$key => $value <br>";
        }
    }
   
    public function listar(){
        switch ($_SERVER["REQUEST_METHOD"]) {
        case "OPTIONS":
            header('allow: GET, OPTIONS');
            http_response_code(200);
            break;
        case "GET":
            header('content-type: application/json');
            require_once('models/usuario.php');
            $l = new Usuario();
            echo $l->listaUsuario();
            break;
        default:
            http_response_code(405);
            echo "Method not allowed";
            break;
        }
    }
    
    public function index(){
        switch ($_SERVER["REQUEST_METHOD"]) {
        case "OPTIONS":
            header('allow: GET, OPTIONS');
            http_response_code(200);
            break;
        case "GET":
            require_once('index.html');
            break;
        default:
            http_response_code(405);
            echo "Method not allowed";
            break;
        }
    }
    
    public function insert(){
        switch ($_SERVER["REQUEST_METHOD"]) {
        case "OPTIONS":
            header('allow: POST, OPTIONS');
            http_response_code(200);
            break;
        case "POST":
            header('content-type: application/json');
            require_once('models/usuario.php');
            $i = new Usuario();
            echo $i->insertUsurario();
            break;
        default:
            http_response_code(405);
            echo "Method not allowed";
            break;
        }
    }
    
     public function deletar(){
        switch ($_SERVER["REQUEST_METHOD"]) {
        case "OPTIONS":
            header('allow: POST, OPTIONS');
            http_response_code(200);
            break;
        case "POST":
            require_once('models/excluir.php');
            $i = new Excluir();
            $i->deletetUser();
            break;
        default:
            http_response_code(405);
            echo "Method not allowed";
            break;
        }
    }
    
}

$met = $_GET["metodo"];
$arg1 = $_GET["arg1"];
$arg2 = $_GET["arg2"];

if(isset($met) && isset($arg1) && isset($arg2)){
    $r = new Recursos($arg1,$arg2);
}elseif (isset($met) && isset($arg1)){
    $r = new Recursos($arg1);
}elseif (isset($met)) {
    $r = new Recursos();
}

$r->$met();

?>