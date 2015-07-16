<?php 

/**
 * Class PalilloUpload
 * Clase para validar y subir imagenes
 * a una path del servidor.
 * Debes tener permisos 777 para escritura en el $path
 * Funcional para el Upload del CKeditor.
 * @var path: ruta absoluta del Directorio de subidas
 * @var publicUrl: ruta url de la carpeta de subida
 * @var file: Array tipo file, subida desde el formulario.
 * @var status: estado del archivo.
 * @var ext : array , array con extenciones validas para la subida.
 * @author Pablo Martínez
 * @version 1.0
 **/
public class PalilloUpload 
{

	private $path;
	private $publicUrl;
	private $file;
	private $ext;
	private $status;


	public function __construct()
	{
		$this->path 		= "/var/www/puntos/uploads/";
		$this->publicUrl 	= "http://localhost/puntos/uploads/";
		$this->file 		= $_FILES["upload"];
		$this->ext 			= array('jpg', 'png', 'gif', 'jpeg','doc','csv','odt','xls','pdf');
		$this->status 		= "";
	}

	public function getPath()
	{
		return $this->path;
	}

	public function setPath($path)
	{
		$this->path 	= $path;
	}

	public function getPublicUrl()
	{
		return $this->publicUrl;
	}

	public function setPublicUrl($url)
	{
		$this->publicUrl 	= $url;
	}

	public function getExt()
	{
		return $this->ext;
	}

	/**
	*
	* Array con las extenciones permitidas
	**/
	public function setExt($ext)
	{
		$this->ext = $ext;
	}

	/**
 	* Funcion que valida si un archivo verdaderamente es una imagen.
	*
 	* @return boolean
 	* @author 
 	**/
	private function validateImg()
	{
		$imageinfo = getimagesize( $this->file['tmp_name'] );

		if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg'  && $imageinfo['mime'] != 'image/png' && isset($imageinfo))
		{
			return true;
		}

		return false;
	}

	private function validateExt()
	{
		$filename = strtolower($this->file["name"]);

		if(!in_array(end(explode('.', $filename)), $this->ext))
		{
		    return true;
		}

		return false;
	}

	/**
	 * Function de la subida de archivos,
	 * valida las extenciones.
	 * y al final retorna su extado.
	 *
	 * @return 	boolean
	 * @param 	img : boolean , permite validar si en realidad es una imagen.
	 *			Default: false
	 **/
	public function upload($imgVal = false) 
	{
		if( $this->validateExt() )
		{
			// en caso de que haya preferido opciones de img
			if($imgVal)
			{
				if(	!$this->validateImg() )
				{
					$this->status = "Image no valid.";
					return false;
				}
			}

			if ( file_exists($this->path . $this->file['name']) )
			{
			 	$this->status = $this->file['name'] . " already exists. ";
			 	return false;
			}
			else
			{

				try {
						if( move_uploaded_file($this->file["tmp_name"],$this->path . $this->file["name"]) )
						{
							$this->status = "File Upload ".$file["name"].", Done ";
							return true;
						}
										
				} catch (Exception $e) 
				{
					$this->status =  'Error Exception :'. $e->getMessage()."\n";
					return false;
				}

			}			
		}
		else
		{
			$this->status 	= "Image ext no valid.";		
			return false;		
		}

	
	}

}  


?>