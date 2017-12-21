<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Image_lib extends CI_Image_lib {

	function __construct(){
		parent::__construct();
	}

	public function thumb($config, $base_path){

		/**
		* Redimension de una imagen
		* @param array $config
		* @param string $base_path
		* @return void
		* @author Eric Bravo (IT Citrus)
		*/

		//Asignando valores por defecto
		$config['source_image'] = $config['source_image'];
		$config['new_image'] = isset($config['new_image']) ? $base_path . $config['new_image'] : $config['source_image'];
		isset($config['width']) || $config['width'] = 245;
		isset($config['height']) || $config['height'] = 245;
		isset($config['maintain_ratio']) || $config['maintain_ratio'] = TRUE;
		
		//Cambiar el aspect ratio si es necesario
		if($config['maintain_ratio'] == FALSE){
			$source_image_data = getimagesize($config['source_image']);
			$source_image_data['width'] = $source_image_data[0];
			$source_image_data['height'] = $source_image_data[1];

			$source_ratio = $source_image_data['width'] / $source_image_data['height'];
			$new_ratio = $config['width'] / $config['height'];

			$conf = array('source_image' => $config['source_image'], 'new_image' => $config['new_image'], 'maintain_ratio' => FALSE);

			if($new_ratio == $source_ratio){
				$conf['width'] = $source_image_data['width'];
				$conf['height'] = $source_image_data['height'];
			}
			elseif($new_ratio > $source_ratio || ($new_ratio == 1 && $source_ratio < 1)){
				$conf['width'] = $source_image_data['width'];
				$conf['height'] = round($source_image_data['width'] / $new_ratio);
				$conf['y_axis'] = ($source_image_data['height'] - $conf['height']) / 2;
			}
			else{
				$conf['width'] = round($source_image_data['height'] * $new_ratio);
				$conf['height'] = $source_image_data['height'];
				$conf['x_axis'] = ($source_image_data['width'] - $conf['width']) / 2;
			}

			$this->initialize($conf);
			$this->crop();
			$this->clear();
			$config['source_image'] = $conf['new_image'];
		}

		//Redimensionando la imagen
		$conf = array(
			'source_image' => $config['source_image'],
			'new_image' => $config['new_image'],
			'maintain_ratio' => TRUE,
			'width' => $config['width'],
			'height' => $config['height']
		);
		$this->initialize($conf);
		$this->resize();
		$this->clear();

	}
}

?>