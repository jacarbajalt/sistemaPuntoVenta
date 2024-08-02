<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $usuario_id
 * @property string $usuario_nombre
 * @property string $usuario_apellido
 * @property string $usuario_email
 * @property string $usuario_usuario
 * @property string $usuario_clave
 * @property string $usuario_foto
 * @property int $caja_id
 * @property int|null $usuario_estatus
 * @property string|null $usuario_ultimo_acceso
 * @property int|null $usuario_activo
 *
 * @property Cotizacion[] $cotizacions
 * @property Rol[] $rols
 * @property UsuarioRol[] $usuarioRols
 * @property Venta[] $ventas
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_nombre', 'usuario_apellido', 'usuario_email', 'usuario_usuario', 'usuario_clave', 'caja_id'], 'required'],
            [['caja_id', 'usuario_estatus'], 'integer'],
            [['usuario_ultimo_acceso'], 'safe'],
            [['usuario_nombre', 'usuario_apellido', 'usuario_email'], 'string', 'max' => 50],
            [['usuario_usuario'], 'string', 'max' => 30],
            [['usuario_clave'], 'string', 'max' => 535],
            [['usuario_foto'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => 'Usuario ID',
            'usuario_nombre' => 'Usuario Nombre',
            'usuario_apellido' => 'Usuario Apellido',
            'usuario_email' => 'Usuario Email',
            'usuario_usuario' => 'Usuario Usuario',
            'usuario_clave' => 'Usuario Clave',
            'usuario_foto' => 'Usuario Foto',
            'caja_id' => 'Caja ID',
            'usuario_estatus' => 'Usuario Estatus',
            'usuario_ultimo_acceso' => 'Usuario Ultimo Acceso',
        ];
    }

    /**
     * Gets query for [[Cotizacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::class, ['usuario_id' => 'usuario_id']);
    }

    /**
     * Gets query for [[Rols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRols()
    {
        return $this->hasMany(Rol::class, ['rol_id' => 'rol_id'])->viaTable('usuario_rol', ['usuario_id' => 'usuario_id']);
    }

    /**
     * Gets query for [[UsuarioRols]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioRols()
    {
        return $this->hasMany(UsuarioRol::class, ['usuario_id' => 'usuario_id']);
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::class, ['usuario_id' => 'usuario_id']);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * Finds user by username with estatus 1 (An Active User)
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['usuario_usuario' => $username, 'usuario_estatus' => 1]);
    }
    #Métodos no utilizados, Yii recomienda dejar el cuerpo vacío en ellos
    public function getAuthKey()
    {
    }
    public function validateAuthKey($authKey)
    {
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $expirado= strtotime(Date('Y-m-d H:i:s').'- 1 days');
        $token= AccessToken::find()
        ->where(['access_token' => $token])
        ->andWhere(['>=','token_expires', $expirado])
        ->one();
        /*$token= AccessToken::find()
        ->where(['access_token' => $token])
        ->andWhere(['>=','token_expires', $expirado])
        ->createCommand()->getRawSql();*/ 
        $user= $token ? static::findOne(['id' => $token->user_id]) : false;

        if($user){
            #$expires= $user->token_expires + 1800; #30 Minutos
            $expires= $token->token_expires + 1800; #30 Minutos

            $fecha_actual= time();
            if($expires > $fecha_actual){
                $token->token_expires= $fecha_actual; #Al ser válido el token es aumentada su vigencia
                $token->save();
                return $user;
            } else{#Si el token no es válido (Sin vigencia) es borrado cualquier valor para el atributo access_token dentro de la tabla User, y al usuario lanzado error de credenciales fallidas al querer consumir cualquier recurso del sistema
                $token->access_token= '';
                $token->save();
            }
        }
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->usuario_id;
    }

    public function validatePassword($password)
    {
        return $this->usuario_clave === sha1($password);
    }

    public function getNombreCompleto(){
        return $this->usuario_nombre." ".$this->usuario_apellido;
    }
}
