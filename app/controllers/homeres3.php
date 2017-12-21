<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    private $main_menu;
    private $footer_menu;

    public function __construct() {
        parent::__construct();
        $this->load->model('manager_model', 'manager');
        
        $this->main_menu = array(
            'home' => array(
                'id' => 'home',
                'title' => '',
                'link' => base_url() . 'home'
            ),
            'nosotros' => array(
                'id' => 'nosotros',
                'title' => 'NOSOTROS',
                'link' => base_url() . 'nosotros'
            ),            
            'ventas' => array(
                'id' => 'ventas',
                'title' => 'VENTAS',
                'link' => base_url() . 'ventas'
            ),
            'licitaciones' => array(
                'id' => 'licitaciones',
                'title' => 'LICITACIONES',
                'link' => base_url() . 'licitaciones'
            ),
            'catalogo' => array(
                'id' => 'catalogo',
                'title' => 'CATÁLOGO',
                'link' => base_url() . 'catalogo'
            ),
            'contacto' => array(
                'id' => 'contacto',
                'title' => 'CONTACTO',
                'link' => base_url() . 'contacto'
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
                'title' => 'Licitaciones',
                'link' => base_url() . 'licitaciones'
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

    public function index() {
        // $this->output->cache(1);
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1, 0, 0);
        $data['productos'] = $this->manager->productos_destacados(12);
        $this->load->view('site/home', $data);
    }

    public function nosotros() {
        // $this->output->cache(43200);
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1, 0, 0);
        $this->load->view('site/nosotros', $data);
    }

    public function ventas() {
        // $this->output->cache(43200);
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1, 0, 0);
        $this->load->view('site/ventas', $data);
    }

    public function catalogo() {
        // $this->output->cache(1);
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $this->load->view('site/catalogo', $data);
        $data['carrito'] = $this->carrito;
    }

    public function contacto() {
        // $this->output->cache(43200);
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1, 0, 0);
        $this->load->view('site/contacto', $data);
    }

    public function licitaciones() {
        // $this->output->cache(43200);
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1, 0, 0);
        $this->load->view('site/licitaciones', $data);
    }

    public function newsletter() {
        $this->form_validation->set_rules('email_newsletter', 'Newsletter', 'trim|required|valid_email|xss_clean');
        if ($this->form_validation->run() === FALSE){
            echo validation_errors('<span class="error">', '</span>');
        }else{
            $verifica = $this->manager->validar_suscriptor($this->input->post('email_newsletter'));
            if ($verifica == FALSE){
                $data['suscriptor'] = $this->input->post('email_newsletter');
                $data['ip']         = $this->input->ip_address();
                $data['user_agent'] = $this->input->user_agent();
                $data = $this->security->xss_clean($data);
                if($this->manager->suscribir($data)){
                    echo TRUE;
                }else{
                    echo '<span class="error">Ocurrió un problema al intentar registrarte a nuestro newsletter, intenta más tarde.</span>';    
                }
            }else{
                echo '<span class="error">Ya te encuentras registrado a nuestro newsletter.</span>';
            }
        }
    }

    public function carrito() {
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1, 0, 0);
        $this->load->view('site/carrito', $data);
    }

    public function agregar_carrito() {
        function convertirCadena($cadena) {
            $cad = preg_replace("/á/", "a", $cadena);
            $cad = preg_replace("/é/", "e", $cad);
            $cad = preg_replace("/í/", "i", $cad);
            $cad = preg_replace("/ó/", "o", $cad);
            $cad = preg_replace("/ú/", "u", $cad);
            $cad = preg_replace("/Á/", "A", $cad);
            $cad = preg_replace("/É/", "E", $cad);
            $cad = preg_replace("/Í/", "I", $cad);
            $cad = preg_replace("/Ó/", "O", $cad);
            $cad = preg_replace("/Ú/", "U", $cad);
            return $cad;
        }

        switch ($this->input->post('tipo_venta')) {
            case 1:
                $precio = $this->input->post('p_metro');
                $tipo_venta = "Metro";
                break;
            case 2:
                $precio = $this->input->post('p_rollo');
                $tipo_venta = "Rollo";
                break;
        }

        if ($this->input->post('colours') == "true") {
            if ($this->input->post('tipo_color')) {
                $propiedades_color = $this->manager->propiedades_color($this->input->post('tipo_color'));

                $producto = array(
                    'id' => $this->input->post('product_id'),
                    'qty' => $this->input->post('cantidad_venta'),
                    'price' => $precio,
                    'name' => convertirCadena($this->input->post('nombre_producto')),
                    'options' => array(
                        'img_product' => $this->input->post('img_product'),
                        'tipo_venta' => $tipo_venta,
                        'modelo' => $this->input->post('modelo_producto'),
                        'color' => $this->input->post('tipo_color'),
                        'nombre_color' => $propiedades_color->nombre_color,
                        'hex_color' => $propiedades_color->hexadecimal_color,
                        'metros_rollo' => $this->input->post('m_rollo')
                    ),
                );

                if ($this->cart->insert($producto)) {
                    echo 1;
                } else {
                    echo '<span class="error">¡Ups! Ocurrió un problema y no se pudo agregar el producto al carrito, intentalo nuevamente.</span>';
                }
            } else {
                echo '<span class="error">Es necesario seleccionar un color para el producto.</span>';
            }
        } else {
            $producto = array(
                'id' => $this->input->post('product_id'),
                'qty' => $this->input->post('cantidad_venta'),
                'price' => $precio,
                'name' => convertirCadena($this->input->post('nombre_producto')),
                'options' => array(
                    'img_product' => $this->input->post('img_product'),
                    'tipo_venta' => $tipo_venta,
                    'modelo' => $this->input->post('modelo_producto'),
                    'metros_rollo' => $this->input->post('m_rollo')
                ),
            );

            if ($this->cart->insert($producto)) {
                echo 1;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema y no se pudo agregar el producto al carrito, intentalo nuevamente.</span>';
            }
        }
    }

    public function actualizar_carrito() {
        if ($this->input->post('update_cart')) {
            unset($_POST['update_cart']);
            $contents = $this->input->post();
            foreach ($contents as $content) {
                $producto = array(
                    'rowid' => $content['rowid'],
                    'qty' => $content['qty']
                );
                $this->cart->update($producto);
            }
        }

        redirect('ver-carrito');
    }

    public function vaciar_carrito() {
        if ($this->cart->destroy() == false) {
            echo 1;
        } else {
            echo '<span class="error">Ocurrió un problema con el servidor, vuelve a intentarlo.</span>';
        }
    }

    public function enviar_contacto() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_lenght[180]|callback_valid_name|xss_clean');
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|callback_valid_phone|xss_clean');
        $this->form_validation->set_rules('telefono_celular', 'Teléfono Celular', 'trim|required|callback_valid_phone|xss_clean');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'trim|required|min_length[10]|max_lenght[2000]|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $data['nombre']             = $this->input->post('nombre');
            $data['email']              = $this->input->post('email');
            $data['telefono']           = $this->input->post('telefono');
            $data['telefono_celular']   = $this->input->post('telefono_celular');
            $data['mensaje']            = $this->input->post('mensaje');
            $data['ip']                 = $this->input->ip_address();
            $data['navegador']          = $this->input->user_agent();
            $data                       = $this->security->xss_clean($data);
            $contacto = $this->manager->contacto($data);
            if ($contacto != FALSE) {
                $this->email->from($data['email'], $data['nombre']);
                $this->email->to( 'contacto@iniciativatextil.com' );
                $this->email->bcc( 'ventas@iniciativatextil.com' );
                $this->email->bcc( 'joboraz@gmail.com' );
                $this->email->bcc( 'mail.pruebas.ed@gmail.com' );
                $this->email->subject('Contacto Iniciativa Textil');
                $this->email->message($this->load->view('mail/contacto', $data, true));
                $this->email->send();
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema con tu registro, vuelve a intentarlo.</span>';
            }
        }
    }

    public function aviso_privacidad() {
        // $this->output->cache(43200);
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $data['categorias'] = $this->manager->categorias(1, 0, 0);
        $data['in_basket'] = $this->session->userdata('productos');
        $this->load->view('site/aviso_privacidad', $data);
    }

    public function confirmar() {
        if ($this->cart->total_items() > 0) {
            return $this->load->view('site/confirmar_form');
        } else {
            echo FALSE;
        }
    }

    public function datos_envio() {
        return $this->load->view('site/inc/confirmacion_datos_domicilio');
    }

    public function procesar_pedido() {
        $this->form_validation->set_rules('nombre_completo', 'Nombre completo', 'trim|required|min_length[3]|max_lenght[180]|callback_valid_name|xss_clean');
        $this->form_validation->set_rules('correo_electronico', 'Correo electrónico', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|callback_valid_phone|xss_clean');
        $this->form_validation->set_rules('telefono_celular', 'Celular', 'trim|callback_valid_phone|xss_clean');
        $this->form_validation->set_rules('entrega_pedido', 'Tipo de entrega', 'trim|required|is_natural_no_zero|xss_clean');
        if ($this->input->post('entrega_pedido') == 2) {
            $this->form_validation->set_rules('calle_envio', 'Calle', 'trim|required|min_length[3]|max_lenght[200]|callback_valid_name|xss_clean');
            $this->form_validation->set_rules('numero_envio', 'Número', 'trim|required|alpha_numeric|xss_clean');
            $this->form_validation->set_rules('colonia_envio', 'Colonia', 'trim|required|min_length[3]|max_lenght[180]|callback_valid_name|xss_clean');
            $this->form_validation->set_rules('provincia_envio', 'Delegación / Municipio', 'trim|required|min_length[3]|max_lenght[180]|callback_valid_name|xss_clean');
            $this->form_validation->set_rules('estado_envio', 'Estado', 'trim|required|min_length[3]|max_lenght[180]|callback_valid_name|xss_clean');
            $this->form_validation->set_rules('cpostal_envio', 'Código Postal', 'trim|required|min_length[3]|max_lenght[10]|is_natural|xss_clean');
            $this->form_validation->set_rules('telefono_envio', 'Teléfono', 'trim|xss_clean');
        }
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $datestring = "%Y";
            $data['nombre_completo'] = $this->input->post('nombre_completo');
            $data['correo_electronico'] = $this->input->post('correo_electronico');
            $data['telefono'] = $this->input->post('telefono');
            $data['telefono_celular'] = $this->input->post('telefono_celular');
            $data['num_pedido'] = 'iTXTL' . mdate($datestring) . '-' . random_string('numeric', 5);
            $data['tipo_entrega'] = $this->input->post('entrega_pedido');
            switch ($this->input->post('entrega_pedido')) {
                case 1:
                    $data['entrega_pedido'] = "Recoger en sucursal";
                    break;
                case 2:
                    $data['entrega_pedido'] = "Envío a domicilio";
                    $data['calle_envio'] = $this->input->post('calle_envio');
                    $data['numero_envio'] = $this->input->post('numero_envio');
                    $data['colonia_envio'] = $this->input->post('colonia_envio');
                    $data['provincia_envio'] = $this->input->post('provincia_envio');
                    $data['estado_envio'] = $this->input->post('estado_envio');
                    $data['cpostal_envio'] = $this->input->post('cpostal_envio');
                    $data['telefono_envio'] = $this->input->post('telefono_envio');
                    break;
            }
            $data['contenido_pedido'] = $this->cart->contents();
            $data['total_pedido'] = $this->cart->total();
            $data = $this->security->xss_clean($data);
            $compra = $this->manager->pedido($data);
            if ($compra != FALSE) {
                $this->email->from($data['correo_electronico'], $data['nombre_completo']);
                $this->email->to('pedidos@iniciativatextil.com');
                $this->email->bcc( 'joboraz@gmail.com' );
                $this->email->bcc( 'mail.pruebas.ed@gmail.com' );
                $this->email->subject('Pedido: ' . $data['num_pedido'] . ' confirmado');
                $this->email->message($this->load->view('mail/pedido_confirmado', $data, true));
                if ($this->email->send()) {
                    $this->email->from('ventas@iniciativatextil.com', 'Iniciativa Textil');
                    $this->email->to($data['correo_electronico']);
                    $this->email->subject('Se ha confirmado tu pedido con el número: ' . $data['num_pedido']);
                    $this->email->message($this->load->view('mail/tu_pedido', $data, true));
                    $this->email->send();
                    echo TRUE;
                }
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema con tu registro, vuelve a intentarlo.</span>';
            }
        }
    }

    public function enviar_solicitud_catalogo() {
        $this->form_validation->set_rules('inpt_catalogo_nombre', 'Nombres', 'trim|required|min_length[3]|max_lenght[180]|callback_valid_name|xss_clean');
        $this->form_validation->set_rules('inpt_catalogo_apellidos', 'Apellidos', 'trim|required|min_length[3]|max_lenght[180]|callback_valid_name|xss_clean');
        $this->form_validation->set_rules('inpt_catalogo_email', 'E-Mail', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('inpt_catalogo_direccion', 'Dirección', 'trim|required|min_length[3]|max_lenght[250]xss_clean');
        $this->form_validation->set_rules('inpt_catalogo_telefono', 'Teléfono', 'trim|callback_valid_phone|xss_clean');
        $this->form_validation->set_rules('catalogo_fisico', 'Catálogos', 'required|callback_valid_option|xss_clean');
        $this->form_validation->set_rules('recibir_promociones', 'Suscribirse a las promociones', 'trim|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            echo validation_errors('<span class="error">', '</span>');
        } else {
            $datestring = "%Y";
            $data['nombre'] = $this->input->post('inpt_catalogo_nombre');
            $data['apellidos'] = $this->input->post('inpt_catalogo_apellidos');
            $data['email'] = $this->input->post('inpt_catalogo_email');
            $data['direccion'] = $this->input->post('inpt_catalogo_direccion');
            $data['telefono'] = $this->input->post('inpt_catalogo_telefono');
            $data['catalogos'] = json_encode($this->input->post('catalogo_fisico'));
            $data['promociones'] = $this->input->post('recibir_promociones');
            $data['folio_catalogo'] = 'iTXTLCAT' . mdate($datestring) . '-' . random_string('numeric', 5);
            $data['ip'] = $this->input->ip_address();
            $data['navegador'] = $this->input->user_agent();
            $data = $this->security->xss_clean($data);
            $pedido_catalogo = $this->manager->pedir_catalogo($data);
            if ($pedido_catalogo != FALSE) {
                $this->email->from($data['email'], $data['nombre']);
                $this->email->to('ventas@iniciativatextil.com');
                $this->email->bcc( 'joboraz@gmail.com' );
                $this->email->bcc( 'mail.pruebas.ed@gmail.com' );
                $this->email->subject('Iniciativa Textil - Una persona ha solicitado alguno de los catálogos físicos');
                $this->email->message($this->load->view('mail/catalogo_pedido', $data, true));
                if( $this->email->send() ){
                    $this->email->from('ventas@iniciativatextil.com', 'Iniciativa Textil');
                    $this->email->to($data['email'], $data['nombre']);
                    $this->email->subject('Confirmación de pedido de catálogos físicos');
                    $this->email->message($this->load->view('mail/catalogo_confirmacion', $data, true));
                    $this->email->send();
                }
                echo TRUE;
            } else {
                echo '<span class="error">¡Ups! Ocurrió un problema al realizar tu pedido, vuelve a intentarlo.</span>';
            }
        }
    }

    public function mantenimiento() {
        $data['menu'] = menu_p('', '<em>&bull;</em>', $this->main_menu);
        $data['menu_footer'] = menu_p('', '<em>&bull;</em>', $this->footer_menu);
        $this->load->view('site/mantenimiento', $data);
    }

    function valid_phone($str) {
        if ($str) {
            if (!preg_match('/\([0-9]\)| |[0-9]/', $str)) {
                $this->form_validation->set_message('valid_phone', '<b class="requerido">*</b> El <b>%s</b> no tiene un formato válido.');
                return FALSE;
            } else {
                return TRUE;
            }
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
}
