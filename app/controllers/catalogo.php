<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo extends CI_Controller {

	private $main_menu;
	private $footer_menu;

	public function __construct(){
		parent::__construct();
		$this->load->model('manager_model','manager');
        $this->load->library('pagination');

		$this->main_menu = array(
			'home' => array(
				'id' => 'home',
				'title' => '',
				'link' => base_url().'home'
				),
			'nosotros' => array(
				'id' => 'nosotros',
				'title' => 'NOSOTROS',
				'link' => base_url().'nosotros'
				),
			'ventas' => array(
				'id' => 'ventas',
				'title' => 'VENTAS',
				'link' => base_url().'ventas'
				),
			'licitaciones' => array(
				'id' => 'licitaciones',
				'title' => 'LICITACIONES',
				'link' => base_url().'licitaciones'
				),
			'catalogo' => array(
				'id' => 'catalogo',
				'title' => 'CATÁLOGO',
				'link' => base_url().'catalogo'
				),
			'contacto' => array(
				'id' => 'contacto',
				'title' => 'CONTACTO',
				'link' => base_url().'contacto'
				),
		);

		$this->footer_menu = array(
            'home' => array(
                'id' => 'home',
                'title' => 'Home',
                'link' => base_url() . 'home'
            ),
            'nosotros' => array(
                'id' => 'nosotros',
                'title' => 'Nosotros',
                'link' => base_url() . 'nosotros'
            ),
            'ventas' => array(
                'id' => 'ventas',
                'title' => 'Ventas',
                'link' => base_url() . 'ventas'
            ),
            'licitaciones' => array(
				'id' => 'licitaciones',
				'title' => 'LICITACIONES',
				'link' => base_url().'licitaciones'
			),
            'catalogo' => array(
                'id' => 'catalogo',
                'title' => 'Catálogo',
                'link' => base_url() . 'catalogo'
            ),
            'contacto' => array(
                'id' => 'contacto',
                'title' => 'Contacto',
                'link' => base_url() . 'contacto'
            ),
        );
	}

	public function index(){
		// $this->output->cache(1);
		$data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
		$data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
		$data['categorias']	= $this->manager->categorias(1,0,0);
		$data['productos'] 	= $this->manager->randproductos(12);
		$this->load->view('site/catalogo', $data);
	}

	public function listado(){
		// $this->output->cache(1440);
		$config['base_url'] = base_url().'catalogo/'.$this->uri->segment(2).'/pages/';
		$config['per_page'] = 12;
		$config['num_links'] = 5;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<span>';
		$config['full_tag_close'] = '</span>';
		$config['first_link'] = 'Primero';
		$config['last_link'] = 'Último';
		$config['next_link'] = 'Siguiente';
		$config['prev_link'] = 'Anterior';
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
        $category = $this->manager->category_cid($this->uri->segment(2));
		$config['total_rows'] = $this->manager->filas($category);
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['paginacion'] = $this->pagination->create_links();
		$data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
		$data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
		$data['categorias'] = $this->manager->categorias(1,0,0);
		$data['productos'] 	= $this->manager->lista_productos($config['per_page'], $page, $category);
		$this->load->view('site/listado', $data);
	}

	public function detalle(){
		// $this->output->cache(1440);
		if($this->uri->segment(3)){
			$data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
			$data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
			$data['categorias'] = $this->manager->categorias(1,0,0);
            if ( $this->uri->segment(4) ) {
                $puid = $this->manager->producto_puid_modelo($this->uri->segment(4));
            }else{
                $puid = $this->manager->producto_puid_slug($this->uri->segment(3));
            }
            $category = $this->manager->category_cid($this->uri->segment(2));
			$data['producto'] 	= $this->manager->detalle($puid->puid, $category->cid);
			$data['destacados']	= $this->manager->productos_destacados(3);
			$evaluacion = $this->manager->evaluacion($puid->puid, $category->cid);
			if (!($evaluacion)){
				redirect('catalogo/'.$this->uri->segment(2));
			}else{
				$this->load->view('site/detalle', $data);
			}			}else{
			redirect('catalogo/'.$this->uri->segment(2));
		}
	}

	public function buscador(){
		//$this->output->cache(1440);
		$config['page_query_string'] = TRUE;
		$config['base_url'] = site_url('busqueda').'?buscar='.$this->input->get('buscar');
		$config['per_page'] = 12;
		$config['num_links'] = 3;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<span>';
		$config['full_tag_close'] = '</span>';
		$config['first_link'] = 'Primero';
		$config['last_link'] = 'Último';
		$config['next_link'] = 'Siguiente';
		$config['prev_link'] = 'Anterior';
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		$config['total_rows'] = $this->manager->total_productos($this->input->get('buscar'));
		$this->pagination->initialize($config);
		$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$data['paginacion'] = $this->pagination->create_links();
		$data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
		$data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
		$data['categorias'] = $this->manager->categorias(1,0,0);
		$data['productos'] 	= $this->manager->buscador($config['per_page'], $page, $this->input->get('buscar'));
		$this->load->view('site/resultados_busqueda', $data);
	}

	public function galerias(){
		// $this->output->cache(1440);
		$data['pid'] = $this->input->post('pid');
		$galerias 	= $this->manager->galerias_productos($data);
		if($galerias != FALSE){
			$data['imagenes'] = json_decode($galerias->galeria_producto);
			return $this->load->view('site/inc/galeria_producto', $data);
		}else{
			echo "<p>No se ha encontrado una galería para este producto";
		}
	}

    public function solicitud_catalogo() {
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1,0,0);
        $this->load->view('site/catalogo_impreso', $data);
    }
}

?>