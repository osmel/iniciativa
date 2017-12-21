<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manager extends CI_Controller {

    private $navegacion;
    private $gallery_path;

    /* Método contructor */

    public function __construct() {
        parent::__construct();
        $this->load->model('manager_model', 'manager');
        $this->load->library(array('upload', 'encrypt', 'pagination'));

        $this->navegacion = array(
            'index' => array(
                'id' => 'admin',
                'title' => 'Catálogo',
                'link' => base_url() . 'admin'
            ),
            'categorias' => array(
                'id' => 'categorias',
                'title' => 'Categorías',
                'link' => base_url() . 'admin/categorias'
            ),
            'colores' => array(
                'id' => 'colores',
                'title' => 'Colores',
                'link' => base_url() . 'admin/colores'
            ),
            'banners' => array(
                'id' => 'banners',
                'title' => 'Banners',
                'link' => base_url() . 'admin/banners'
            ),
            'logout' => array(
                'id' => 'logout',
                'title' => 'Salir',
                'link' => base_url() . 'logout'
            ),
        );
    }

    /* Método para mostrar la vista del index */
    public function index() {
        if ($this->session->userdata('session') != TRUE) {
            redirect('login');
        } else {
            //$this->output->cache(1440);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $busqueda = ($this->uri->segment(4)) ? $this->uri->segment(4) : $this->input->post('search');
            $config['suffix'] = "/" . $busqueda;
            $config['base_url'] = base_url() . 'admin/index/';
            $config['per_page'] = 20;
            $config['num_links'] = 4;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<span>';
            $config['full_tag_close'] = '</span>';
            $config['first_link'] = 'Primero';
            $config['last_link'] = 'Último';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['cur_tag_open'] = '<b>';
            $config['cur_tag_close'] = '</b>';
            $config['total_rows'] = $this->manager->total_productos_admin($busqueda);
            $this->pagination->initialize($config);
            $data['paginacion'] = $this->pagination->create_links();
            $data['menu'] = menu_ul('admin', $this->navegacion);
            $data['productos'] = $this->manager->productos($config['per_page'], $page, $busqueda);
            $this->load->view('admin/index', $data);
        }
    }

    /* Método para mostrar la vista de logueo */
    public function login() {
        if ($this->session->userdata('session') != TRUE) {
            //$this->output->cache(43200);
            $this->load->view('admin/login');
        } else {
            redirect('admin');
        }
    }

    /* Métoro para procesar los datos del formulario de login */
    public function login_process() {
        $this->form_validation->set_rules('username', 'Usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('passwd', 'Contraseña', 'trim|required|min_lenght[3]|max_length[16]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $user['usuario'] = $this->input->post('username');
            $user['password'] = $this->input->post('passwd');
            $user = $this->security->xss_clean($user);
            $login = $this->manager->login($user);
            if ($login != FALSE) {
                $login = json_decode($login, TRUE);
                $session = array(
                    'session' => TRUE,
                    'uid' => $login['id'],
                    'auth' => $login['auth']
                );
                $this->session->set_userdata($session);
                echo TRUE;
            } else {
                echo '<span class="error">Tu nombre de <b>Usuario</b> o <b>Contraseña</b> son incorrectos, intenta nuevamente.</span>';
            }
        }
    }

    public function productos() {
        if ($this->session->userdata('session') != TRUE) {
            redirect('login');
        } else {
            //$this->output->cache(1440);
            $data['menu'] = menu_ul('index', $this->navegacion);
            $data['lista_categorias'] = $this->manager->lista_categorias(0, 0);
            $this->load->view('admin/productos', $data);
        }
    }

    public function categorias() {
        if ($this->session->userdata('session') != TRUE) {
            redirect('login');
        } else {
            //$this->output->cache(1440);
            $config['base_url'] = base_url() . 'admin/categorias/';
            $config['per_page'] = 20;
            $config['num_links'] = 4;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<span>';
            $config['full_tag_close'] = '</span>';
            $config['first_link'] = 'Primero';
            $config['last_link'] = 'Último';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['cur_tag_open'] = '<b>';
            $config['cur_tag_close'] = '</b>';
            $config['total_rows'] = $this->manager->total_categorias_admin();
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['paginacion'] = $this->pagination->create_links();
            $data['menu'] = menu_ul('categorias', $this->navegacion);
            $data['categorias'] = $this->manager->categorias(0, $config['per_page'], $page);
            $data['lista_categorias'] = $this->manager->lista_categorias(0, 0);
            $this->load->view('admin/categorias', $data);
        }
    }

    public function coloresAjax() {
        $indice = (strlen($this->input->post('indiceColor')) != 0) ? $this->input->post('indiceColor') : 0;
        $data = $this->manager->lista_colores_ajax($indice);
        echo json_encode($data);
    }

    public function colores() {
        if ($this->session->userdata('session') != TRUE) {
            redirect('login');
        } else {
            //$this->output->cache(1440);
            $config['base_url'] = base_url() . 'admin/colores/';
            $config['per_page'] = 20;
            $config['num_links'] = 4;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<span>';
            $config['full_tag_close'] = '</span>';
            $config['first_link'] = 'Primero';
            $config['last_link'] = 'Último';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['cur_tag_open'] = '<b>';
            $config['cur_tag_close'] = '</b>';
            $config['total_rows'] = $this->manager->total_colores_admin();
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['paginacion'] = $this->pagination->create_links();
            $data['menu'] = menu_ul('colores', $this->navegacion);
            $data['colores'] = $this->manager->lista_colores($config['per_page'], $page);
            $this->load->view('admin/colores', $data);
        }
    }

    public function banners() {
        if ($this->session->userdata('session') != TRUE) {
            redirect('login');
        } else {
            //$this->output->cache(1440);
            $config['base_url'] = base_url() . 'admin/banners/';
            $config['per_page'] = 20;
            $config['num_links'] = 4;
            $config['uri_segment'] = 3;
            $config['full_tag_open'] = '<span>';
            $config['full_tag_close'] = '</span>';
            $config['first_link'] = 'Primero';
            $config['last_link'] = 'Último';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['cur_tag_open'] = '<b>';
            $config['cur_tag_close'] = '</b>';
            $config['total_rows'] = $this->manager->total_banners_admin();
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['paginacion'] = $this->pagination->create_links();
            $data['menu'] = menu_ul('banners', $this->navegacion);
            $data['banners'] = $this->manager->banners($config['per_page'], $page);
            $this->load->view('admin/banners', $data);
        }
    }

    public function usuarios() {
        if ($this->session->userdata('session') != TRUE) {
            redirect('login');
        } else {
            $data['menu'] = menu_ul('usuarios', $this->navegacion);
            $this->load->view('admin/usuarios', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function nueva_categoria() {
        $this->form_validation->set_rules('nombre_categoria', 'Nombre', 'trim|required|min_lenght[3]|max_length[140]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $data['nombre_categoria'] = $this->input->post('nombre_categoria');
            $data['orden_categoria'] = $this->input->post('orden_categoria');
            $data['parent'] = $this->input->post('categoria_padre');
            $data['descripcion_categoria'] = $this->input->post('descripcion_categoria');
            $mismo_nombre = $this->manager->mismo_nombre_categoria( $data['nombre_categoria'] );
            if ( $mismo_nombre > 0 ){
                $slug = $this->input->post( 'nombre_categoria' ) . '-' . ( $mismo_nombre + 1 );
                $data['slug'] = url_title( $slug, 'dash', TRUE );
            } else {
                $data['slug'] = url_title($this->input->post('nombre_categoria'), 'dash', TRUE);
            }
            $data = $this->security->xss_clean($data);
            $registro = $this->manager->nueva_categoria($data);
            if ($registro != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar dar de alta tu categoría, vuelve a intentarlo.</span>';
            }
        }
    }

    public function nuevo_producto() {
        $this->form_validation->set_rules('nombre_producto', 'Nombre', 'trim|required|min_lenght[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('categoria', 'Categoría', 'required|callback_category_validate|xss_clean');
        $this->form_validation->set_rules('descripcion_producto', 'Descripción', 'trim|min_lenght[3]|max_length[200]');
        $this->form_validation->set_rules('precio_metro_producto', 'Precio por metro', 'trim|required|callback_is_money|xss_clean');
        $this->form_validation->set_rules('precio_rollo_producto', 'Precio por rollo', 'trim|required|callback_is_money|xss_clean');
        $this->form_validation->set_rules('metros_rollo_producto', 'Metros por rollo', 'trim|xss_clean');
        $this->form_validation->set_rules('modelo_producto', 'Modelo del producto', 'trim|max_length[150]|xss_clean');
        $this->form_validation->set_rules('colores_seleccionados[]', 'Colores', 'trim|xss_clean');
        $this->form_validation->set_rules('lavado', 'Caracteristicas de Lavado', 'callback_care_validate|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            if (isset($_FILES['imagen_producto']) && !empty($_FILES['imagen_producto']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '5120';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                /*$config['x_axis'] = '800';
                $config['y_axis'] = '550';*/

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('imagen_producto')) {
                    echo $this->upload->display_errors('<span class="error">', '</span>');
                } else {
                    $data['imagen_producto'] = $this->upload->data();
                }

                $this->load->library('image_lib');
                $configs = array();
                $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '50x50_' . $data['imagen_producto']['file_name'], 'width' => 50, 'height' => 50, 'maintain_ratio' => FALSE);
                $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '80x80_' . $data['imagen_producto']['file_name'], 'width' => 80, 'height' => 80, 'maintain_ratio' => FALSE);
                $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '140x140_' . $data['imagen_producto']['file_name'], 'width' => 140, 'height' => 140, 'maintain_ratio' => FALSE);
                $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '200x200_' . $data['imagen_producto']['file_name'], 'width' => 200, 'height' => 200, 'maintain_ratio' => FALSE);
                $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '245x245_' . $data['imagen_producto']['file_name'], 'width' => 245, 'height' => 245, 'maintain_ratio' => FALSE);
                $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '450x450_' . $data['imagen_producto']['file_name'], 'width' => 450, 'height' => 450, 'maintain_ratio' => FALSE);
                $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '800x600_' . $data['imagen_producto']['file_name'], 'width' => 800, 'height' => 600, 'maintain_ratio' => TRUE);

                $thumbnails = array();
                $tamanos = array();
                $rutas = array();

                foreach ($configs as $config) {
                    $this->image_lib->thumb($config, FCPATH . 'uploads/');
                    array_push($tamanos, $config['width']);
                    array_push($rutas, $config['new_image']);
                }
                $thumbnails = array_combine($tamanos, $rutas);

                $data['thumbnails_producto'] = json_encode($thumbnails);
                $data['imagen_producto'] = $data['imagen_producto']['file_name'];
            }

            if (isset($_FILES['galeria_producto_files']) && !empty($_FILES['galeria_producto_files']['name'])) {
                $cpt = count($_FILES['galeria_producto_files']['name']);
                if ($cpt <= 20) {
                    /** Se configura los parámetros de subida * */
                    $config2['upload_path'] = './uploads/galerias/';
                    $config2['allowed_types'] = 'jpg|jpeg|gif|png';
                    $config2['max_size'] = '5120';
                    $config2['remove_spaces'] = TRUE;
                    $config2['encrypt_name'] = TRUE;
                    $config2['overwrite'] = TRUE;
                    /* $config['max_width']  = '800';
                      $config['max_height']  = '550'; */
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_multi_upload('galeria_producto_files')) {
                        echo $this->upload->display_errors('<span class="error">', '</span>');
                    } else {
                        $upload_data = $this->upload->get_multi_upload_data();
                        $galeria = array();
                        for ($i = 0; $i < $cpt; $i++) {
                            $this->load->library('image_lib');
                            $configs = array();
                            $configs[] = array('source_image' => $upload_data[$i]['full_path'], 'new_image' => $upload_data[$i]['file_name'], 'width' => 800, 'height' => 600, 'maintain_ratio' => TRUE);
                            $configs[] = array('source_image' => $upload_data[$i]['full_path'], 'new_image' => '80x80_' . $upload_data[$i]['file_name'], 'width' => 80, 'height' => 80, 'maintain_ratio' => FALSE);
                            $tamanos = array();
                            $rutas = array();

                            foreach ($configs as $config) {
                                $this->image_lib->thumb($config, FCPATH . 'uploads/galerias/');
                                array_push($tamanos, $config['width']);
                                array_push($rutas, $config['new_image']);
                            }
                            $galeria_imagen = array_combine($tamanos, $rutas);
                            array_push($galeria, $galeria_imagen);
                        }
                        $data['galeria_producto'] = json_encode($galeria);
                    }
                } else {
                    echo '<span class="error">¡Ups! el servidor no permite subir más de 20 archivos, intenta con menos nuevamente.</span>';
                }
            }

            $data['nombre_producto']        = $this->input->post('nombre_producto');
            $data['categoria']              = json_encode($this->input->post('categoria'));
            $data['descripcion_producto']   = $this->input->post('descripcion_producto');
            $data['precio_metro_producto']  = $this->input->post('precio_metro_producto');
            $data['precio_rollo_producto']  = $this->input->post('precio_rollo_producto');
            $data['metros_rollo_producto']  = $this->input->post('metros_rollo_producto');
            $data['producto_destacado']     = $this->input->post('producto_destacado');
            $data['tipo_producto']          = $this->input->post('tipo_producto');
            $data['colores']                = json_encode($this->input->post('colores_seleccionados'));
            $mismo_nombre = $this->manager->mismo_nombre_producto( $data['nombre_producto'] );
            if ( $mismo_nombre > 0 ){
                $slug = $this->input->post( 'nombre_producto' ) . '-' . ( $mismo_nombre + 1 );
                $data['slug_producto'] = url_title( $slug, 'dash', TRUE );
            } else {
                $data['slug_producto'] = url_title($this->input->post('nombre_producto'), 'dash', TRUE);
            }
            $data['modelo_producto']        = $this->input->post('modelo_producto');
            if ( ! empty ( $data['modelo_producto'] ) ){
                $mismo_modelo = $this->manager->mismo_modelo_producto( $data['modelo_producto'] );
                if ( $mismo_nombre > 0 ){
                    $slug = $this->input->post( 'modelo_producto' ) . '-' . ( $mismo_nombre + 1 );
                    $data['slug_modelo_producto'] = url_title( $slug, 'dash', TRUE );
                } else {
                    $data['slug_modelo_producto'] = url_title($this->input->post('modelo_producto'), 'dash', TRUE);
                }
            } else {
                $data['slug_modelo_producto'] = url_title($this->input->post('modelo_producto'), 'dash', TRUE);
            }
            $data['cuidados']               = json_encode($this->input->post('lavado'));
            $data['autor']                  = $this->session->userdata('uid');
            $data = $this->security->xss_clean($data);
            $registro = $this->manager->nuevo_producto($data);
            if ($registro != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar guardar el producto, vuelve a intentarlo.</span>';
            }
        }
    }

    public function nuevo_color() {
        $this->form_validation->set_rules('nombre_color', 'Nombre', 'trim|required|min_lenght[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('hex_color', 'Color', 'trim|required|min_lenght[3]|max_length[6]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $data['nombre_color'] = $this->input->post('nombre_color');
            $data['hex_color'] = $this->input->post('hex_color');
            $data = $this->security->xss_clean($data);
            $registro = $this->manager->nuevo_color($data);
            if ($registro != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar agregar tu color, vuelve a intentarlo.</span>';
            }
        }
    }

    public function nuevo_banner() {
        $this->form_validation->set_rules('nombre_banner', 'Nombre', 'trim|required|min_lenght[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('link_banner', 'Link', 'trim|min_lenght[10]|xss_clean|callback_valid_url_format');
        $this->form_validation->set_rules('descripcion_banner', 'Descripción', 'trim|min_lenght[3]|max_length[140]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $config['upload_path'] = './uploads/banners';
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['max_size'] = '5120';
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img_banner')) {
                echo $this->upload->display_errors('<span class="error">', '</span>');
                die;
            } else {
                $data['img_banner'] = $this->upload->data();
            }

            $this->load->library('image_lib');
            $configs = array();
            $configs[] = array('source_image' => $data['img_banner']['full_path'], 'new_image' => $data['img_banner']['file_name'], 'width' => 1170, 'height' => 350, 'maintain_ratio' => FALSE);

            $thumbnails = array();
            $tamanos = array();
            $rutas = array();

            foreach ($configs as $config) {
                $this->image_lib->thumb($config, FCPATH . 'uploads/banners/');
                array_push($tamanos, $config['width']);
                array_push($rutas, $config['new_image']);
            }
            $thumbnails = array_combine($tamanos, $rutas);

            $data['thumbnails_banner']  = json_encode($thumbnails);
            $data['nombre_banner']      = $this->input->post( 'nombre_banner' );
            $data['link_banner']        = $this->input->post( 'link_banner' );
            $data['descripcion_banner'] = $this->input->post('descripcion_banner');
            $mismo_nombre               = $this->manager->mismo_nombre_banner( $data['nombre_banner'] );
            if ( $mismo_nombre > 0 ){
                $slug                   = $this->input->post( 'nombre_banner' ) . '-' . ( $mismo_nombre + 1 );
                $data['slug_banner']    = url_title( $slug, 'dash', TRUE );
            } else {
                $data['slug_banner']    = url_title($this->input->post('nombre_banner'), 'dash', TRUE);
            }
            $data['codigo_promocion']   = random_string('alnum', 4) . 'iTXTL' . random_string('numeric', 3);
            $data                       = $this->security->xss_clean($data);
            $banner                     = $this->manager->nuevo_banner($data);
            if ($banner != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar guardar el banner, vuelve a intentarlo.</span>';
            }
        }
    }

    public function editar_producto() {
        if ($this->encrypt->sha1($this->input->get('pid')) == $this->input->get('hash')) {
            $producto = $this->manager->atributos_producto($this->input->get('pid'));
            if ($producto != NULL) {
                $data['menu'] = menu_ul('index', $this->navegacion);
                $data['lista_categorias'] = $this->manager->lista_categorias(0, 0);
                $data['producto'] = $producto;
                $this->load->view('admin/editar-producto', $data);
            } else {
                redirect('admin/index');
            }
        } else {
            redirect('admin/index');
        }
    }

    public function editar_banner() {
        if ($this->encrypt->sha1($this->input->get('buid')) == $this->input->get('hash')) {
            $banner = $this->manager->atributos_banner($this->input->get('buid'));
            if ($banner != NULL) {
                $data['menu'] = menu_ul('index', $this->navegacion);
                $data['banner'] = $banner;
                $this->load->view('admin/editar-banner', $data);
            } else {
                redirect('admin/index');
            }
        } else {
            redirect('admin/index');
        }
    }

    public function editar_color() {
        if ($this->encrypt->sha1($this->input->get('col_id')) == $this->input->get('hash')) {
            $color = $this->manager->atributos_color($this->input->get('col_id'));
            if ($color != NULL) {
                $data['menu'] = menu_ul('index', $this->navegacion);
                $data['color'] = $color;
                $this->load->view('admin/editar-color', $data);
            } else {
                redirect('admin/colores');
            }
        } else {
            redirect('admin/colores');
        }
    }

    public function editar_categoria() {
        if ($this->encrypt->sha1($this->input->get('cid')) == $this->input->get('hash')) {
            $categoria = $this->manager->atributos_categoria($this->input->get('cid'));
            if ($categoria != NULL) {
                $data['menu'] = menu_ul('index', $this->navegacion);
                $data['lista_categorias'] = $this->manager->lista_categorias(0, 0);
                $hijas = $this->manager->categorias_hijas($this->input->get('cid'));
                $data['categoria'] = $categoria;
                $data['hijas'] = $hijas;
                $this->load->view('admin/editar-categoria', $data);
            } else {
                redirect('admin/index');
            }
        } else {
            redirect('admin/index');
        }
    }

    public function guardar_producto_editado() {
        $this->form_validation->set_rules('nombre_producto', 'Nombre', 'trim|required|min_lenght[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('categoria', 'Categoría', 'required|callback_category_validate|xss_clean');
        $this->form_validation->set_rules('descripcion_producto', 'Descripción', 'trim|min_lenght[3]|max_length[200]');
        $this->form_validation->set_rules('precio_metro_producto', 'Precio por metro', 'trim|required|callback_is_money|xss_clean');
        $this->form_validation->set_rules('precio_rollo_producto', 'Precio por rollo', 'trim|required|callback_is_money|xss_clean');
        $this->form_validation->set_rules('metros_rollo_producto', 'Metros por rollo', 'trim|xss_clean');
        $this->form_validation->set_rules('modelo_producto', 'Modelo del producto', 'trim|max_length[150]|xss_clean');
        $this->form_validation->set_rules('colores_seleccionados[]', 'Colores', 'trim|xss_clean');
        $this->form_validation->set_rules('lavado', 'Caracteristicas de Lavado', 'callback_care_validate|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            if (isset($_FILES['imagen_producto']) && !empty($_FILES['imagen_producto']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '5120';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $config['overwrite'] = TRUE;
                if ($this->input->post('imagen_producto')) {
                    $config['file_name'] = $this->input->post('imagen_producto');
                }

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('imagen_producto')) {
                    echo $this->upload->display_errors('<span class="error">', '</span>');
                } else {
                    $data['imagen_producto'] = $this->upload->data();
                    $this->load->library('image_lib');
                    $configs = array();
                    $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '50x50_' . $data['imagen_producto']['file_name'], 'width' => 50, 'height' => 50, 'maintain_ratio' => FALSE);
                    $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '80x80_' . $data['imagen_producto']['file_name'], 'width' => 80, 'height' => 80, 'maintain_ratio' => FALSE);
                    $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '140x140_' . $data['imagen_producto']['file_name'], 'width' => 140, 'height' => 140, 'maintain_ratio' => FALSE);
                    $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '200x200_' . $data['imagen_producto']['file_name'], 'width' => 200, 'height' => 200, 'maintain_ratio' => FALSE);
                    $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '245x245_' . $data['imagen_producto']['file_name'], 'width' => 245, 'height' => 245, 'maintain_ratio' => FALSE);
                    $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '450x450_' . $data['imagen_producto']['file_name'], 'width' => 450, 'height' => 450, 'maintain_ratio' => FALSE);
                    $configs[] = array('source_image' => $data['imagen_producto']['full_path'], 'new_image' => '800x600_' . $data['imagen_producto']['file_name'], 'width' => 800, 'height' => 600, 'maintain_ratio' => TRUE);

                    $thumbnails = array();
                    $tamanos = array();
                    $rutas = array();

                    foreach ($configs as $config) {
                        $this->image_lib->thumb($config, FCPATH . 'uploads/');
                        array_push($tamanos, $config['width']);
                        array_push($rutas, $config['new_image']);
                    }
                    $thumbnails = array_combine($tamanos, $rutas);

                    $data['thumbnails_producto'] = json_encode($thumbnails);
                    $data['imagen_producto'] = $data['imagen_producto']['file_name'];
                }
            }

            if (isset($_FILES['galeria_producto_files']) && !empty($_FILES['galeria_producto_files']['name'])) {

                $cpt = count($_FILES['galeria_producto_files']['name']);
                if ($cpt <= 20) {
                    /** Se configura los parámetros de subida * */
                    $config2['upload_path'] = './uploads/galerias/';
                    $config2['allowed_types'] = 'jpg|jpeg|gif|png';
                    $config2['max_size'] = '5120';
                    $config2['remove_spaces'] = TRUE;
                    $config2['encrypt_name'] = TRUE;
                    $config2['overwrite'] = TRUE;
                    /* $config['max_width']  = '800';
                      $config['max_height']  = '550'; */
                    $this->upload->initialize($config2);
                    if (!$this->upload->do_multi_upload('galeria_producto_files')) {
                        echo $this->upload->display_errors('<span class="error">', '</span>');
                    } else {
                        $upload_data = $this->upload->get_multi_upload_data();
                        if ($this->input->post('group2') == 'Agregar') {
                            $producto1 = $this->manager->atributos_producto($this->input->post('uuid_producto'));
                            if ($producto1->galeria_producto) {
                                $galeria = json_decode($producto1->galeria_producto);
                            }
                        } else {
                            $galeria = array();
                        }
                        for ($i = 0; $i < $cpt; $i++) {
                            $this->load->library('image_lib');
                            $configs = array();
                            $configs[] = array('source_image' => $upload_data[$i]['full_path'], 'new_image' => $upload_data[$i]['file_name'], 'width' => 800, 'height' => 600, 'maintain_ratio' => TRUE);
                            $configs[] = array('source_image' => $upload_data[$i]['full_path'], 'new_image' => '80x80_' . $upload_data[$i]['file_name'], 'width' => 80, 'height' => 80, 'maintain_ratio' => FALSE);

                            $tamanos = array();
                            $rutas = array();

                            foreach ($configs as $config) {
                                $this->image_lib->thumb($config, FCPATH . 'uploads/galerias/');
                                array_push($tamanos, $config['width']);
                                array_push($rutas, $config['new_image']);
                            }
                            $galeria_imagen = array_combine($tamanos, $rutas);
                            array_push($galeria, $galeria_imagen);
                        }
                        $data['galeria_producto'] = json_encode($galeria);
                    }
                } else {
                    echo '<span class="error">¡Ups! el servidor no permite subir más de 20 archivos, intenta con menos nuevamente.</span>';
                }
            }

            $data['puid']                   = $this->input->post('uuid_producto');
            $data['nombre_producto']        = $this->input->post('nombre_producto');
            $data['categoria']              = json_encode($this->input->post('categoria'));
            $data['descripcion_producto']   = $this->input->post('descripcion_producto');
            $data['precio_metro_producto']  = $this->input->post('precio_metro_producto');
            $data['precio_rollo_producto']  = $this->input->post('precio_rollo_producto');
            $data['metros_rollo_producto']  = $this->input->post('metros_rollo_producto');
            $data['producto_destacado']     = $this->input->post('producto_destacado');
            $data['tipo_producto']          = $this->input->post('tipo_producto');
            $data['colores']                = json_encode($this->input->post('colores_seleccionados'));
            $mismo_nombre = $this->manager->mismo_nombre_producto( $data['nombre_producto'] );
            if ( $mismo_nombre > 0 ){
                $slug = $this->input->post( 'nombre_producto' ) . '-' . ( $mismo_nombre + 1 );
                $data['slug_producto'] = url_title( $slug, 'dash', TRUE );
            } else {
                $data['slug_producto'] = url_title($this->input->post('nombre_producto'), 'dash', TRUE);
            }
            
            $data['modelo_producto']        = $this->input->post('modelo_producto');
            $mismo_modelo = $this->manager->mismo_modelo_producto( $data['modelo_producto'] );
            if ( ! empty ( $data['modelo_producto'] ) ){
                $mismo_modelo = $this->manager->mismo_modelo_producto( $data['modelo_producto'] );
                if ( $mismo_nombre > 0 ){
                    $slug = $this->input->post( 'modelo_producto' ) . '-' . ( $mismo_nombre + 1 );
                    $data['slug_modelo_producto'] = url_title( $slug, 'dash', TRUE );
                } else {
                    $data['slug_modelo_producto'] = url_title($this->input->post('modelo_producto'), 'dash', TRUE);
                }
            } else {
                $data['slug_modelo_producto'] = url_title($this->input->post('modelo_producto'), 'dash', TRUE);
            }
            $data['cuidados']              = json_encode($this->input->post('lavado'));
            $data['autor']                  = $this->session->userdata('uid');
            $data = $this->security->xss_clean($data);
            $registro = $this->manager->actualizar_producto($data);
            if ($registro != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar actualizar el producto, vuelve a intentarlo.</span>';
            }
        }
    }

    public function guardar_banner_editado() {
        $this->form_validation->set_rules('nombre_banner', 'Nombre', 'trim|required|min_lenght[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('link_banner', 'Link', 'trim|min_lenght[10]|xss_clean|callback_valid_url_format');
        $this->form_validation->set_rules('descripcion_banner', 'Descripción', 'trim|min_lenght[3]|max_length[140]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            if (!empty($_FILES)) {
                $config['upload_path'] = './uploads/banners';
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '5120';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                if ($this->input->post('img_banner')) {
                    $config['file_name'] = $this->input->post('img_banner');
                }

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('img_banner')) {
                    echo $this->upload->display_errors('<span class="error">', '</span>');
                } else {
                    $data['img_banner'] = $this->upload->data();
                }

                $this->load->library('image_lib');
                $configs = array();
                $configs[] = array('source_image' => $data['img_banner']['full_path'], 'new_image' => $data['img_banner']['file_name'], 'width' => 1170, 'height' => 350, 'maintain_ratio' => FALSE);

                $thumbnails = array();
                $tamanos = array();
                $rutas = array();

                foreach ($configs as $config) {
                    $this->image_lib->thumb($config, FCPATH . 'uploads/banners/');
                    array_push($tamanos, $config['width']);
                    array_push($rutas, $config['new_image']);
                }
                $thumbnails = array_combine($tamanos, $rutas);
                $data['thumbnails_banner'] = json_encode($thumbnails);
            }

            $data['buid']               = $this->input->post('banner_id');
            $data['nombre_banner']      = $this->input->post('nombre_banner');
            $data['link_banner']        = $this->input->post( 'link_banner' );
            $data['descripcion_banner'] = $this->input->post('descripcion_banner');
            $mismo_nombre               = $this->manager->mismo_nombre_banner( $data['nombre_banner'] );
            if ( $mismo_nombre > 0 ){
                $slug                   = $this->input->post( 'nombre_banner' ) . '-' . ( $mismo_nombre + 1 );
                $data['slug_banner']    = url_title( $slug, 'dash', TRUE );
            } else {
                $data['slug_banner']    = url_title( $this->input->post( 'nombre_banner' ), 'dash', TRUE );
            }
            $data                       = $this->security->xss_clean($data);
            $banner                     = $this->manager->actualizar_banner($data);
            if ($banner != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar editar el banner, vuelve a intentarlo.</span>';
            }
        }
    }

    public function guardar_categoria_editada() {
        $this->form_validation->set_rules('nombre_categoria', 'Nombre', 'trim|required|min_lenght[3]|max_length[140]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $data['cid'] = $this->input->post('catid');
            $data['nombre_categoria'] = $this->input->post('nombre_categoria');
            $data['orden_categoria'] = $this->input->post('orden_categoria');
            $data['parent'] = $this->input->post('categoria_padre');
            $data['descripcion_categoria'] = $this->input->post('descripcion_categoria');
            $mismo_nombre = $this->manager->mismo_nombre_categoria( $data['nombre_categoria'] );
            if ( $mismo_nombre > 0 ){
                $slug = $this->input->post( 'nombre_categoria' ) . '-' . ( $mismo_nombre + 1 );
                $data['slug'] = url_title( $slug, 'dash', TRUE );
            } else {
                $data['slug'] = url_title($this->input->post('nombre_categoria'), 'dash', TRUE);
            }
            $data = $this->security->xss_clean($data);
            $registro = $this->manager->actualizar_categoria($data);
            if ($registro != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar dar de alta tu categoría, vuelve a intentarlo.</span>';
            }
        }
    }

    public function guardar_color_editado() {
        $this->form_validation->set_rules('nombre_color', 'Nombre', 'trim|required|min_lenght[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('hex_color', 'Color', 'trim|required|min_lenght[3]|max_length[6]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $data['nombre_color'] = $this->input->post('nombre_color');
            $data['hex_color'] = $this->input->post('hex_color');
            $data['color_id'] = $this->input->post('color_uid');
            $data = $this->security->xss_clean($data);
            $registro = $this->manager->actualizar_color($data);
            if ($registro != FALSE) {
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al intentar agregar tu color, vuelve a intentarlo.</span>';
            }
        }
    }

    public function activar_banner() {
        $data['buid'] = $this->input->post('banner_id');
        switch ($this->input->post('status_banner')) {
            case 0:
                $data['status_banner'] = 1;
                break;
            case 1:
                $data['status_banner'] = 0;
                break;
        }
        $data = $this->security->xss_clean($data);
        $activar = $this->manager->activar_banner($data);
        if ($activar != FALSE) {
            echo $activar;
        } else {
            echo '<span class="error">¡Ups! Ocurrió un problema y no se ha podido activar el banner, vuelve a intentarlo.</span>';
        }
    }

    public function activar_producto() {
        $data['puid'] = $this->input->post('product_uid');
        switch ($this->input->post('status_producto')) {
            case 0:
                $data['status_producto'] = 1;
                break;
            case 1:
                $data['status_producto'] = 0;
                break;
        }
        $data = $this->security->xss_clean($data);
        $activar = $this->manager->activar_producto($data);
        if ($activar != FALSE) {
            echo $activar;
        } else {
            echo '<span class="error">¡Ups! Ocurrió un problema y no se ha podido activar el producto, vuelve a intentarlo.</span>';
        }
    }

    public function activar_categoria() {
        $data['cid'] = $this->input->post('category_id');
        switch ($this->input->post('status_category')) {
            case 0:
                $data['status_categoria'] = 1;
                break;
            case 1:
                $data['status_categoria'] = 0;
                break;
        }
        $data = $this->security->xss_clean($data);
        $activar = $this->manager->activar_categoria($data);
        if ($activar != FALSE) {
            echo $activar;
        } else {
            echo '<span class="error">¡Ups! Ocurrió un problema y no se ha podido activar el banner, vuelve a intentarlo.</span>';
        }
    }

    public function borrar_banner() {
        $data['buid'] = $this->input->post('buid');
        if ($this->input->post('hash') == $this->encrypt->sha1($data['buid'])) {
            $data = $this->security->xss_clean($data);
            $graficos = $this->manager->imagenes_banners($data);
            $graficos->img_banner = json_decode($graficos->img_banner);
            $borrar = $this->manager->eliminar_banner($data);
            if ($borrar != FALSE) {
                foreach ($graficos->img_banner as $img) {
                    unlink('./uploads/banners/' . $img);
                }
                echo $borrar;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema y no se ha eliminado el banner, vuelve a intentarlo.</span>';
            }
        } else {
            echo '<span class="error">¡Ups! no tienes los suficientes permisos para realizar esta acción.</span>';
        }
    }

    public function borrar_producto() {
        $data['puid'] = $this->input->post('puid');
        if ($this->input->post('hash') == $this->encrypt->sha1($data['puid'])) {
            $data = $this->security->xss_clean($data);
            $graficos = $this->manager->imagenes_producto($data);
            $graficos->thumbs_producto = json_decode($graficos->thumbs_producto);
            $borrar = $this->manager->eliminar_producto($data);
            if ($borrar != FALSE) {
                if($graficos->imagen_producto != ""){
                    @unlink('./uploads/' . $graficos->imagen_producto);
                    if($graficos->thumbs_producto != "") {
                        foreach ($graficos->thumbs_producto as $thumb) {
                            @unlink('./uploads/' . $thumb);
                        }
                    }
                }
                echo $borrar;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema y no se ha podido eliminar el producto, vuelve a intentarlo.</span>';
            }
        } else {
            echo '<span class="error">¡Ups! no tienes los suficientes permisos para realizar esta acción.</span>';
        }
    }

    public function borrar_categoria() {
        $data['cid'] = $this->input->post('cid');
        if ($this->input->post('hash') == $this->encrypt->sha1($data['cid'])) {
            $data = $this->security->xss_clean($data);
            $borrar = $this->manager->eliminar_categoria($data);
            if ($borrar != FALSE) {
                echo $borrar;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema y no se ha eliminado la categoría, vuelve a intentarlo.</span>';
            }
        } else {
            echo '<span class="error">¡Ups! no tienes los suficientes permisos para realizar esta acción.</span>';
        }
    }

    public function borrar_color() {
        $data['cuid'] = $this->input->post('cuid');
        if ($this->input->post('hash') == $this->encrypt->sha1($data['cuid'])) {
            $data = $this->security->xss_clean($data);
            $borrar = $this->manager->eliminar_color($data);
            if ($borrar != FALSE) {
                echo $borrar;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema y no se ha eliminado la categoría, vuelve a intentarlo.</span>';
            }
        } else {
            echo '<span class="error">¡Ups! no tienes los suficientes permisos para realizar esta acción.</span>';
        }
    }

    function valid_option($str) {
        if ($str == 0) {
            $this->form_validation->set_message('valid_option', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function is_money($str) {
        if (is_int($str) || is_float($str)) {
            $this->form_validation->set_message('is_money', '<b class="requerido">*</b> Es necesario que ingreses una cantidad válida para <b>%s</b>.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function category_validate($array) {
        $totcats = count($array);
        if($totcats > 1) {
            foreach($array as $element){
                if ($element == 0) {
                    $this->form_validation->set_message('category_validate', '<b class="requerido">*</b> Al seleccionar varias categorías, no puede estar seleccionada "Sin categoría" en el campo <b>%s</b>.');
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }else{
            return TRUE;
        }
    }

    function care_validate($array) {
        $totcats = count($array);
        if($totcats > 1) {
            foreach($array as $element){
                if ($element == "0") {
                    $this->form_validation->set_message('care_validate', '<b class="requerido">*</b> Al seleccionar varias tipos de cuidado, no puede estar seleccionado "Ninguno" en el campo <b>%s</b>.');
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }else{
            return TRUE;
        }
    }

    function valid_url_format($str){
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $str)){
            $this->form_validation->set_message('valid_url_format', 'La <b>URL</b> que has introducido no tiene un formato válido.');
            return FALSE;
        }
        return TRUE;
    }
}
