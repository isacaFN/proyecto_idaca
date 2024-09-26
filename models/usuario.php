<?php
namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'nivel', 'correo', 'password', 'permiso', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $nivel;
    public $correo;
    public $password;
    public $permiso;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->nivel = $args['nivel'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->permiso = $args['permiso'] ?? '0';
        $this->token = $args['token'] ?? '0';
    }

    // mensaje de validacion de campos
    public function validarNuevoUsuario(){
        if(!$this->nombre){
            self::$alertas['error'][] = "El nombre del usuario es obligatorio";
        }

        if(!$this->apellido){
            self::$alertas['error'][] = "El apellido del usuario es obligatorio";
        }

        if(!$this->correo){
            self::$alertas['error'][] = "El correo electronico es obligatorio";
        }

        if(!$this->password){
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }

        if(strlen($this->password) < 6){
            self::$alertas['error'][] = "La contraseña debe tener al menos 6 caracteres";
        }

    return self::$alertas;
    }

    public function validarLogin(){
        if(!$this->correo){
            self::$alertas['error'][] = "El correo electronico es obligatorio";
        }

        if(!$this->password){
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }

        return self::$alertas;
    }

    public function validarCorreo(){
        if(!$this->correo){
            self::$alertas['error'][] = "El correo electronico es obligatorio";
        }
        
        return self::$alertas;
    }


    public function extisteUsuario(){
        $query = "SELECT * FROM " .self::$tabla. " WHERE correo = '{$this->correo}' limit 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows > 0){
            self::$alertas['error'][] = "El usuario ya esta registrado";

        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function comprobarPasswordANDpermiso($password){
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->permiso){
            self::$alertas['error'][] = "contraseña incorrecta o no haz confirmado tu cuenta";
        }else{
            return true;
        }
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }

        if(strlen($this->password) < 6){
            self::$alertas['error'][] = "La contraseña debe tener al menos 6 caracteres";
        }

        return self::$alertas;
    }
}
?>