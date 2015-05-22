<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	public $correo;
	public $password;
	public $es_admin;
	const ERROR_STATUS = 4;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	public function __construct($correo, $password)
	{
		$this->correo 	= $correo;
		$this->password = $password;

	}

	public function authenticate()
	{
		$correo = strtolower($this->correo);
		$usuario = Usuario::model()->find('LOWER(correo)=?',array($correo));

		if($usuario === null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$usuario->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if($usuario->estado == 0)
            $this->errorCode=self::ERROR_STATUS;
        else
        {
            $this->_id 			= $usuario->id;
            $this->correo 	= $usuario->correo;
            $this->es_admin	= $usuario->es_admin;
            $this->errorCode = self::ERROR_NONE;

						Yii::app()->user->setState('es_admin', $usuario->es_admin);

						if( $usuario->es_admin == 1)
						{
							Yii::app()->user->setState('user_type','Admin');
						}

        }
        return $this->errorCode == self::ERROR_NONE;

	}

	public function getId()
  {
    return $this->_id;
  }

  public function getCorreo()
  {
      return $this->correo;
  }


}
