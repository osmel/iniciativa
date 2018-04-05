<?php

if (!defined('BASEPATH'))
    exit('No tienes permiso para acceder a este archivo');

class Manager_model extends CI_Model {

    private $key_encrypt;

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->key_encrypt = $_SERVER['AES_ENCRY_KEY'];
    }

    /** @Consultas * */

        /**
         * Comprobación de usuario válido para hacer login en el administrador
         * @param  [object] $user [Objeto con variables de usuario y password]
         * @return [object]       [Objeto de autoriazación de usuario logueado]
         */
        public function login($user) {
            $this->db->cache_off();
            $this->db->select('id, auth');
            $this->db->where('usuario', "AES_ENCRYPT('{$user['usuario']}','{$this->key_encrypt}')", FALSE);
            $this->db->where('pass', "AES_ENCRYPT('{$user['password']}','{$this->key_encrypt}')", FALSE);
            $this->db->where('activo', 1);
            $auth = $this->db->get($this->db->dbprefix('manager_users'));
            if ($auth->num_rows() > 0) {
                return json_encode($auth->row());
            } else {
                return FALSE;
            }
        }



        public function eliminar_imagen($data) {
            
            $this->db->select('m.galeria_producto, m.pid');
            $this->db->from($this->db->dbprefix('catalogo_productos'). ' AS m');
            $where = '(
                          (m.puid = "'.$data["puid"].'")
                         
            )'; 

            $this->db->where($where);  
            
            $result = $this->db->get();
        
            if ( $result->num_rows() > 0 ) {
                //return json_decode($result->row()->galeria_producto);
                $arreglo= json_decode($result->row()->galeria_producto);
                $arr = array();
                $si = true;
                foreach ($arreglo as $key => $value) {
                    foreach ($value as $key1 => $value1) {
                         if ($value1==$data['img']) {
                            $si=false;
                         }
                         

                    }   
                        
                    if ($si) $arr[]=$value;     
                    $si=true;  
                }

                $this->db->set('galeria_producto', json_encode($arr) );
                $this->db->where($where);  
                $this->db->update($this->db->dbprefix('catalogo_productos'). ' AS m');


                //return json_encode($arr);

                $this->db->cache_delete_all();
                if ($this->db->affected_rows() > 0)
                    return json_encode($arr);
                else
                    return FALSE;


                 
            }               
            else
               return False;
            $result->free_result();

        }


        public function total_productos( $search ) {
            $this->db->cache_off();
            $this->db->from( $this->db->dbprefix( 'catalogo_productos' ) . ' AS a' );
            $this->db->join( $this->db->dbprefix( 'productos_categorias' ). ' AS m', 'm.puid = a.puid','INNER' );
            $this->db->join( $this->db->dbprefix( 'catalogo_categorias' ). ' AS b', 'b.cid = m.cid','INNER' );
            // $this->db->where( 'a.status_producto', 1 );
            // $this->db->like( 'a.slug_producto', strtolower( $search ) );
            // $this->db->or_like( 'a.descripcion_producto', $search );
            // $this->db->or_like( 'a.modelo_producto', strtolower( $search ) );
            // $this->db->or_like( 'b.slug_categoria', strtolower( $search ) );
            // $this->db->or_like( 'b.descripcion_categoria', $search );

             $where = '(
                         ( (a.status_producto=1) AND (
                            (a.slug_producto LIKE "%'.strtolower($search).'%") OR
                                (a.descripcion_producto LIKE "%'.$search.'%") OR
                                    (a.modelo_producto LIKE "%'.strtolower($search).'%") OR
                                        (b.slug_categoria LIKE "%'.strtolower($search).'%") OR
                                            (b.descripcion_categoria LIKE "%'.strtolower($search).'%")
                            )                                
                                                   
                          )
               )';   
             $this->db->where($where);


            $this->db->group_by( 'a.modelo_producto' );
            $filas = $this->db->get()->num_rows();
            if ($filas > 0)
                return $filas;
            else
                return NULL;
            $filas->free_result();
        }

        public function total_productos_admin($busqueda) {
            $this->db->cache_on();
            if(strlen($busqueda) != 0){
                $this->db->from('catalogo_productos');
                $this->db->like('nombre_producto', $busqueda);
                $this->db->or_like('modelo_producto', $busqueda);
                $total_rows = $this->db->count_all('catalogo_productos');
            }else{
                $total_rows = $this->db->count_all('catalogo_productos');
                return $total_rows;

            }
        }
	public function evaluacion( $puid, $cat ) {
            $this->db->cache_on();
            $this->db->select( 'a.pid' );
            $this->db->from( $this->db->dbprefix( 'catalogo_productos' ) . ' AS a' );
            $this->db->join( $this->db->dbprefix( 'productos_categorias' ). ' AS m', 'm.puid = a.puid','inner' );
            $this->db->join( $this->db->dbprefix( 'catalogo_categorias' ). ' AS b', 'b.cid = m.cid','inner' );
            $this->db->where( 'a.status_producto', 1);
            $this->db->where( 'a.puid', $puid );
            $this->db->where( 'b.cid', $cat );
            $productos = $this->db->get();
            if ($productos->num_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        

        public function total_categorias_admin() {
            $this->db->cache_on();
            $this->db->from('catalogo_categorias');
            $this->db->where('parent', 0);
            $total_cats = $this->db->count_all_results();
            return $total_cats;
        }

        public function total_colores_admin() {
            $this->db->cache_on();
            $total_colores = $this->db->count_all('catalogo_colores');
            return $total_colores;
        }

        public function total_banners_admin() {
            $this->db->cache_on();
            $total_banners = $this->db->count_all('catalogo_banners');
            return $total_banners;
        }

        public function buscador($limit, $start, $search) {
            $this->db->cache_off();
            $this->db->select('a.pid, a.puid, nombre_producto, slug_producto, descripcion_producto, 
    					precio_metro, precio_rollo, colores_producto, modelo_producto, slug_modelo_producto, 
                        b.cid, b.nombre_categoria, b.slug_categoria, imagen_producto, thumbs_producto, tipo_producto');
            $this->db->from($this->db->dbprefix('catalogo_productos') . ' AS a');
            $this->db->join($this->db->dbprefix('productos_categorias'). ' AS m', 'm.puid = a.puid','INNER');
            $this->db->join($this->db->dbprefix('catalogo_categorias'). ' AS b', 'b.cid = m.cid','INNER');
            // $this->db->where('a.status_producto', 1);
            // $this->db->like('a.slug_producto', strtolower($search) );
            //$this->db->or_like('a.descripcion_producto', $search);
            // $this->db->or_like('a.modelo_producto', strtolower($search) );
            // $this->db->or_like('b.slug_categoria', strtolower($search) );
            // $this->db->or_like('b.descripcion_categoria', $search);


             $where = '(
                         ( (a.status_producto=1) AND (
                            (a.slug_producto LIKE "%'.strtolower($search).'%") OR
                                (a.descripcion_producto LIKE "%'.$search.'%") OR
                                    (a.modelo_producto LIKE "%'.strtolower($search).'%") OR
                                        (b.slug_categoria LIKE "%'.strtolower($search).'%") OR
                                            (b.descripcion_categoria LIKE "%'.strtolower($search).'%")
                            )                                
                                                   
                          )
               )';   
             $this->db->where($where);
// AND  ( (a.slug_producto =  "'.strtolower($search).'") OR (a.modelo_producto ="'.strtolower($search).'")) 
            $this->db->group_by('a.modelo_producto');
            $this->db->order_by('pid', 'ASC');
            $this->db->limit($limit, $start);
            $listado_productos = $this->db->get();
            if ($listado_productos->num_rows() > 0)
                return $listado_productos->result();
            else
                return NULL;
            $listado_productos->free_result();
        }

        public function productos($limit, $start, $busqueda) {
            $this->db->cache_on();
            if (strlen($busqueda) == 0) {
                $this->db->select('pid, puid, nombre_producto, modelo_producto, slug_modelo_producto, status_producto');
                $this->db->limit($limit, $start);
                $this->db->order_by('alta_producto', 'DESC');
                $productos = $this->db->get($this->db->dbprefix('catalogo_productos'));
            } else {
                $this->db->select('pid, puid, nombre_producto, modelo_producto, slug_modelo_producto, status_producto');
                $this->db->like('nombre_producto', $busqueda);
                $this->db->or_like('modelo_producto', $busqueda);
                $this->db->limit($limit, $start);
                $this->db->order_by('nombre_producto', 'ASC');
                $productos = $this->db->get($this->db->dbprefix('catalogo_productos'));
            }
            return $productos->result();
            $productos->free_result();
        }

        /**
         * FUNCIÓN PARA OBTENER PRODUCTOS ALEATORIAMIENTE
         * @param $limit número de productos que se desean obtener
         * @return Regresa los productos con sus propiedades
         */
        public function randproductos($limit) {
            $this->db->cache_off();
            $this->db->select('a.puid');
            $this->db->from($this->db->dbprefix('catalogo_productos'). ' AS a');
            $this->db->join($this->db->dbprefix('productos_categorias'). ' AS m', 'm.puid = a.puid','INNER');
            $this->db->where('a.status_producto', 1);
            $this->db->where('m.cid !=', 0);
            $this->db->order_by('a.puid', 'RANDOM');
            $this->db->limit($limit);
            $puids_random = $this->db->get();
            if ($puids_random->num_rows() > 0) {
                $puids_random = $puids_random->result();
                $puids = array();
                foreach ($puids_random as $row) {
                    array_push($puids, $row->puid);
                }
                $this->db->select('a.pid, a.puid, nombre_producto, slug_producto, descripcion_producto, precio_metro, precio_rollo,
                        colores_producto, modelo_producto, slug_modelo_producto, b.nombre_categoria, b.slug_categoria,
                        imagen_producto, thumbs_producto, tipo_producto');
                $this->db->from($this->db->dbprefix('catalogo_productos') . ' AS a');
                $this->db->join($this->db->dbprefix('productos_categorias'). ' AS m', 'm.puid = a.puid','INNER');
                $this->db->join($this->db->dbprefix('catalogo_categorias'). ' AS b', 'b.cid = m.cid','INNER');
                $this->db->where_in('a.puid', $puids);
                $this->db->group_by('a.puid');
                $random_productos = $this->db->get();
                return $random_productos->result();
            }else{
                return NULL;
            }
        }

        /**
         * FUNCIÓN PARA OBTENER PRODUCTOS SELECCIONADOS CÓMO DESTACADOS ALEATORIAMENTE
         * @param $limit número de productos que se desean obtener
         * @return Regresa los productos con sus propiedades, si no existen destacados, extrae la misma cantidad deseada pero sin ser destacados
         */
        public function productos_destacados($limit) {
            $this->db->cache_off();
            $this->db->select('a.puid');
            $this->db->from($this->db->dbprefix('catalogo_productos'). ' AS a');
            $this->db->join($this->db->dbprefix('productos_categorias'). ' AS m', 'm.puid = a.puid','INNER');
            $this->db->where('a.status_producto', 1);
            $this->db->where('a.destacado', 1);
            $this->db->where('m.cid !=', 1);
            $this->db->order_by('a.puid', 'RANDOM');
            $this->db->limit($limit);
            $puids_random = $this->db->get();
            if($puids_random->num_rows() > 0){
                $puids_random = $puids_random->result();
                $puids = array();
                foreach ($puids_random as $row) {
                    array_push($puids, $row->puid);
                }
                $this->db->select('a.puid, a.pid, nombre_producto, slug_producto, descripcion_producto, precio_metro, precio_rollo,
                    colores_producto, modelo_producto, slug_modelo_producto, b.nombre_categoria, b.slug_categoria,
                    imagen_producto, thumbs_producto, tipo_producto');
                $this->db->from($this->db->dbprefix('catalogo_productos'). ' AS a');
                $this->db->join($this->db->dbprefix('productos_categorias'). ' AS m', 'm.puid = a.puid','INNER');
                $this->db->join($this->db->dbprefix('catalogo_categorias'). ' AS b', 'b.cid = m.cid','INNER');
                $this->db->where_in('a.puid', $puids);
                $this->db->group_by('a.puid');
                $random_productos = $this->db->get();
                return $random_productos->result();
            }else{
                return $this->randproductos($limit);
            }
            $puids_random->db->free_result();
        }

        public function productos_catalogo($limit) {
            $this->db->cache_off();   
                $this->db->select('a.puid, a.pid, nombre_producto, slug_producto, descripcion_producto, precio_metro, precio_rollo,
                    colores_producto, modelo_producto, slug_modelo_producto, b.nombre_categoria, b.slug_categoria,
                    imagen_producto, thumbs_producto, tipo_producto');
                $this->db->from($this->db->dbprefix('catalogo_productos'). ' AS a');
                $this->db->join($this->db->dbprefix('productos_categorias'). ' AS m', 'm.puid = a.puid','INNER');
                $this->db->join($this->db->dbprefix('catalogo_categorias'). ' AS b', 'b.cid = m.cid','INNER');
                $this->db->where('a.status_producto', 1);    
                if ($limit == 4){
                    $this->db->where('a.status_producto', 1); //producto activado
                    $this->db->where('a.destacado', 1); //producto destacado                    
                }else{
                    $this->db->where('a.destacado !=', 1); //producto destacado      
                }            
                
                $this->db->where('m.cid !=', 1);
                $this->db->order_by('rand()');
                $this->db->limit($limit);
                $this->db->group_by('a.puid');
                $random_productos = $this->db->get();                
                return $random_productos->result();            
            $puids_random->db->free_result();
        }
        public function categorias($status, $limit, $start) {
            $this->db->cache_on();
            if ($limit == 0 && $start == 0) {
                $this->db->cache_off();
                $this->db->select('cid, cuid, nombre_categoria, status_categoria, slug_categoria');
                $this->db->where('parent', 0);
                if ($status != 0) {
                    $this->db->where('status_categoria', $status);
                }
                $this->db->order_by('orden_categoria', 'ASC');
                $categorias = $this->db->get($this->db->dbprefix('catalogo_categorias'));
            } else {
                $this->db->cache_off();
                $this->db->select('cid, cuid, nombre_categoria, status_categoria, slug_categoria');
                $this->db->where('parent', 0);
                if ($status != 0) {
                    $this->db->where('status_categoria', $status);
                }
                $this->db->limit($limit, $start);
                $this->db->order_by('orden_categoria', 'ASC');
                $categorias = $this->db->get($this->db->dbprefix('catalogo_categorias'));
            }
            return $categorias->result();
            $categorias->free_result();
        }

        public function banners($limit, $start) {
            $this->db->cache_on();
            $this->db->select('buid, nombre_banner, status_banner');
            $this->db->limit($limit, $start);
            $this->db->order_by('fecha_alta', 'DESC');
            $banners = $this->db->get($this->db->dbprefix('catalogo_banners'));
            return $banners->result();
            $banners->free_result();
        }

        public function obtener_colores($color) {
            $this->db->cache_on();
            $colores = json_decode($color);
            $this->db->cache_off();
            $this->db->select('color_uid, nombre_color, hexadecimal_color');
            $this->db->where_in('color_uid', $colores);
            $lista = $this->db->get($this->db->dbprefix('catalogo_colores'));
            return $lista->result();
            $lista->free_result();
        }

        public function propiedades_color($color) {
            $this->db->cache_on();
            $this->db->select('nombre_color, hexadecimal_color');
            $this->db->where('color_uid', $color);
            $lista = $this->db->get($this->db->dbprefix('catalogo_colores'));
            return $lista->row();
            $lista->free_result();
        }

        public function lista_categorias($parent, $status) {
            $this->db->cache_on();
            $this->db->select('cid, cuid, nombre_categoria, orden_categoria,  status_categoria, slug_categoria');
            $this->db->where('parent', $parent);
            if ($status != 0) {
                $this->db->where('status_categoria', $status);
            }
            $this->db->order_by('orden_categoria', 'ASC');
            $lista = $this->db->get($this->db->dbprefix('catalogo_categorias'));
            return $lista->result();
            $lista->free_result();
        }

        //hago este conteo para mostrar la subcategoría aquellos q se repiten
          public function lista_conteo_categorias($parent, $nombre) {
            $this->db->cache_on();
            $this->db->select('cid');
            $this->db->where('parent', $parent);
            $this->db->order_by('orden_categoria', 'ASC');
            $lista = $this->db->get($this->db->dbprefix('catalogo_categorias'));
            
            $arreglo= $lista->result_array();

            $arr = array();
            foreach ($lista->result_array() as $row)    {
                $arr[] = $row['cid'];
            }   
            $cadena= '('.implode(",",$arr).')';
            //return $cadena;

            //
            $this->db->cache_on();
            $this->db->select('cid');

            $where = '(
                          (parent in '.$cadena.') AND (nombre_categoria = "'.$nombre.'" )
                                    
                            
               )'; 
            $this->db->where($where);
            $this->db->order_by('orden_categoria', 'ASC');
            $this->db->from($this->db->dbprefix('catalogo_categorias'));

            $filas = $this->db->count_all_results();
            return $filas;


            $lista->free_result();
        }


        public function lista_colores($limit, $start) {
            $this->db->cache_on();
            if ($limit == 0 && $start == 0) {
                $this->db->cache_off();
                $this->db->select('color_uid, nombre_color, hexadecimal_color');
                $lista = $this->db->get($this->db->dbprefix('catalogo_colores'));
            } else {
                $this->db->cache_off();
                $this->db->select('color_uid, nombre_color, hexadecimal_color');
                $this->db->limit($limit, $start);
                $this->db->order_by('color_id', 'DESC');
                $lista = $this->db->get($this->db->dbprefix('catalogo_colores'));
            }
            return $lista->result();
            $lista->free_result();
        }

        public function lista_colores_ajax($indice) {
            $this->db->cache_on();
            $this->db->select('color_uid, nombre_color, hexadecimal_color');
            if($indice == "#"){
                $this->db->like('nombre_color', '0', "after");
                $this->db->or_like('nombre_color', '1', "after");
                $this->db->or_like('nombre_color', '2', "after");
                $this->db->or_like('nombre_color', '3', "after");
                $this->db->or_like('nombre_color', '4', "after");
                $this->db->or_like('nombre_color', '5', "after");
                $this->db->or_like('nombre_color', '6', "after");
                $this->db->or_like('nombre_color', '7', "after");
                $this->db->or_like('nombre_color', '8', "after");
                $this->db->or_like('nombre_color', '9', "after");
            }else{
                $this->db->like('nombre_color', $indice, "after");
            }
            $lista = $this->db->get($this->db->dbprefix('catalogo_colores'));
            return $lista->result();
            $lista->free_result();
        }

        /**
         * Modelo para obtener el listado de productos por categoría en el sitio
         * @param  [int] $limit [Límite de la consulta]
         * @param  [int] $start [Número de registro donde inicia la consulta]
         * @param  [int] $cat   [Categoría filtro de la consulta]
         * @return [array] $listado_productos [El resultado de la consulta en un objeto]
         */
        public function lista_productos($limit, $start, $cat) {
            $this->db->cache_on();
            $this->db->select('a.pid, a.puid, nombre_producto, slug_producto, descripcion_producto, 
					precio_metro, precio_rollo, colores_producto, modelo_producto, slug_modelo_producto, b.cid, 
                    b.nombre_categoria, b.slug_categoria, imagen_producto, thumbs_producto, tipo_producto, b.parent');

            //$this->db->select('CONCAT(b.nombre_categoria,b.cid) as CONCAT("osmel",b.cid)', FALSE);

            //$this->db->select("( CASE WHEN b.cid = 40 THEN b.nombre_categoria ELSE 0 END ) AS metros"); 

            //$this->db->select('CONCAT(b.nombre_categoria,b.cid) as CONCAT("osmel",b.cid)', FALSE);

            //$this->db->select("SUM((id_medida =1) * cantidad_um) as metros"); 

            $this->db->from($this->db->dbprefix('catalogo_productos'). ' AS a');
            $this->db->join($this->db->dbprefix('productos_categorias'). ' AS m', 'm.puid = a.puid','INNER');
            $this->db->join($this->db->dbprefix('catalogo_categorias'). ' AS b', 'b.cid = m.cid','INNER');
            //$this->db->join($this->db->dbprefix('catalogo_categorias'). ' AS d', 'd.cid = m.cid','LEFT');
            // $this->db->where('b.status_categoria', 1);
            // $this->db->where('a.status_producto', 1);
            // $this->db->where('b.cid', $cat->cid);
            $where = '(
                         ( (b.status_categoria=1) AND (a.status_producto=1) AND (b.cid = '.$cat->cid.')
                            )                                
                                                                       
                          
               )'; 
            $this->db->where($where);  
            $this->db->order_by('a.pid', 'ASC');
            $this->db->limit($limit, $start);
            $listado_productos = $this->db->get();
            if ($listado_productos->num_rows() > 0) {
                foreach ($listado_productos->result() as $key => $value) {
                    $value->composicion = self::composicion_productos($value->puid)->nombre_categoria;
                }

                return $listado_productos->result();
            } else
                return NULL;
            $listado_productos->free_result();
        }


          public function composicion_productos($puid) {
            $this->db->cache_on();
            $this->db->select('b.nombre_categoria, b.parent');

            $this->db->from($this->db->dbprefix('productos_categorias'). ' AS m');
            $this->db->join($this->db->dbprefix('catalogo_categorias'). ' AS b', 'b.cid = m.cid AND  b.parent=13','INNER');
            $where = '(
                         ( (b.status_categoria=1)  AND (m.puid = "'.$puid.'")
                            )                                
               )'; 
            $this->db->where($where);  
            //$this->db->order_by('a.pid', 'ASC');
            $listado_productos = $this->db->get();
            if ($listado_productos->num_rows() > 0)
                return $listado_productos->row();
            else
                return NULL;
            $listado_productos->free_result();
        }

        public function lista_banners() {
            $this->db->cache_on();
            $this->db->select('nombre_banner, link, slug_banner, img_banner');
            $this->db->where('status_banner', 1);
            $this->db->order_by('bid', 'ASC');
            $listado_banners = $this->db->get($this->db->dbprefix('catalogo_banners'));
            if ($listado_banners->num_rows() > 0)
                return $listado_banners->result();
            else
                return NULL;
            $listado_banners->free_result();
        }

        public function lista_cuidados() {
            $this->db->cache_on();
            $this->db->select('sku_uid, cuidado');
            $this->db->order_by('cuidado', 'ASC');
            $listado_cuidados = $this->db->get($this->db->dbprefix('catalogo_cuidados'));
            if ($listado_cuidados->num_rows() > 0)
                return $listado_cuidados->result();
            else
                return NULL;
            $listado_cuidados->free_result();
        }

        public function atributos_producto($puid) {
            $this->db->cache_on();
            $this->db->select('productos.puid, nombre_producto, descripcion_producto, precio_metro, precio_rollo, colores_producto, 
    					acats.cid, imagen_producto, thumbs_producto, galeria_producto, modelo_producto, slug_modelo_producto, destacado, tipo_producto, metros_rollo');
            $this->db->from($this->db->dbprefix('catalogo_productos') . ' AS productos');
            $this->db->join($this->db->dbprefix('productos_categorias') . ' AS acats', 'acats.puid = productos.puid', 'inner');
            $this->db->where('productos.puid', $puid);
            $atributos_producto = $this->db->get();
            if ($atributos_producto->num_rows() > 0)
                return $atributos_producto->row();
            else
                return NULL;
            $atributos_producto->free_result();
        }

        public function atributos_categoria($cid) {
            $this->db->cache_on();
            $this->db->select('cid, parent, nombre_categoria,orden_categoria, descripcion_categoria, status_categoria');
            $this->db->where('cid', $cid);
            $atributos_categoria = $this->db->get($this->db->dbprefix('catalogo_categorias'));
            if ($atributos_categoria->num_rows() > 0)
                return $atributos_categoria->row();
            else
                return NULL;
            $atributos_categoria->free_result();
        }

        public function atributos_color($cid) {
            $this->db->cache_on();
            $this->db->select('color_uid, nombre_color, hexadecimal_color');
            $this->db->where('color_uid', $cid);
            $atributos_colores = $this->db->get($this->db->dbprefix('catalogo_colores'));
            if ($atributos_colores->num_rows() > 0)
                return $atributos_colores->row();
            else
                return NULL;
            $atributos_colores->free_result();
        }

        public function atributos_banner($buid) {
            $this->db->cache_on();
            $this->db->select('buid, nombre_banner, link, descripcion_banner, img_banner');
            $this->db->where('buid', $buid);
            $banner = $this->db->get($this->db->dbprefix('catalogo_banners'));
            if ($banner->num_rows() > 0)
                return $banner->row();
            else
                return NULL;
            $banner->free_result();
        }

        public function detalle( $puid, $cat ) {
            $this->db->cache_on();
            $this->db->select( 'a.pid, a.puid, a.metros_rollo, nombre_producto, slug_producto, descripcion_producto, precio_rollo,
					precio_metro, colores_producto, modelo_producto, slug_modelo_producto, galeria_producto, 
                    b.cid, b.nombre_categoria, b.slug_categoria, imagen_producto, thumbs_producto, tipo_producto' );
            $this->db->from( $this->db->dbprefix( 'catalogo_productos' ) . ' AS a' );
            $this->db->join( $this->db->dbprefix( 'productos_categorias' ). ' AS m', 'm.puid = a.puid','inner' );
            $this->db->join( $this->db->dbprefix( 'catalogo_categorias' ). ' AS b', 'b.cid = m.cid','inner' );
            $this->db->where( 'a.puid', $puid );
            $this->db->where( 'b.cid', $cat );
            $productos = $this->db->get();
            if ($productos->num_rows() > 0)
                return $productos->row();
            else
                return NULL;
        }

        public function imagenes_banners($data) {
            $this->db->cache_on();
            $this->db->select('img_banner');
            $this->db->where('buid', $data['buid']);
            $imagenes = $this->db->get($this->db->dbprefix('catalogo_banners'));
            if ($imagenes->num_rows() > 0)
                return $imagenes->row();
            else
                return FALSE;
            $imagenes->free_result();
        }

        public function imagenes_producto($data) {
            $this->db->cache_on();
            $this->db->select('imagen_producto, thumbs_producto');
            $this->db->where('puid', $data['puid']);
            $imagenes = $this->db->get($this->db->dbprefix('catalogo_productos'));
            if ($imagenes->num_rows() > 0)
                return $imagenes->row();
            else
                return FALSE;
            $imagenes->free_result();
        }

        public function categorias_hijas($cid) {
            $this->db->cache_on();
            $this->db->select('cid, cuid, nombre_categoria, status_categoria, slug_categoria');
            $this->db->where('parent', $cid);
            $this->db->order_by('slug_categoria', 'ASC');
            $lista = $this->db->get($this->db->dbprefix('catalogo_categorias'));
            return $lista->result();
            $lista->free_result();
        }

        public function filas($cat) {
            $this->db->cache_on();
            $this->db->from($this->db->dbprefix('productos_categorias'). ' AS a');
            $this->db->join($this->db->dbprefix('catalogo_productos'). ' AS b', 'b.puid = a.puid','INNER');
            // $this->db->where('a.cid', $cat->cid);
            // $this->db->where('b.status_producto', 1);
             $where = '(
                         ( (a.cid='.$cat->cid.') AND (b.status_producto=1)
                                    
                            )                                
                                                   
                          
               )'; 
            $this->db->where($where);  

            $filas = $this->db->count_all_results();
            return $filas;
            $filas->free_result();
        }

        public function galerias_productos($data) {
            $this->db->cache_on();
            $this->db->select('galeria_producto');
            $this->db->where('pid', $data['pid']);
            $this->db->where('status_producto', 1);
            $galerias = $this->db->get($this->db->dbprefix('catalogo_productos'));
            if ($galerias->num_rows() > 0)
                return $galerias->row();
            else
                return FALSE;
            $galerias->free_result();
        }

        public function categorias_asignadas($puid) {
            $this->db->cache_on();
            $this->db->select('cid');
            $this->db->where('puid', $puid);
            $categorias_asignadas = $this->db->get($this->db->dbprefix('productos_categorias'));
            if ($categorias_asignadas->num_rows() > 0){
                $cats = array();
                foreach($categorias_asignadas->result() as $row){
                    array_push($cats, $row->cid);
                }
                return $cats;
            }else
                return NULL;
            $categorias_asignadas->free_result();
        }

        public function cuidados_asignados($puid) {
            $this->db->cache_on();
            $this->db->select('sku_uid');
            $this->db->where('puid', $puid);
            $cuidados_asignados = $this->db->get($this->db->dbprefix('productos_cuidados'));
            if ($cuidados_asignados->num_rows() > 0){
                $cuidados = array();
                foreach($cuidados_asignados->result() as $row){
                    array_push($cuidados, $row->sku_uid);
                }
                return $cuidados;
            }else
                return NULL;
            $cuidados_asignados->free_result();
        }

        public function validar_suscriptor($email) {
            $this->db->cache_off();
            $this->db->where('email', "AES_ENCRYPT('{$email}','{$this->key_encrypt}')", FALSE);
            $verifica = $this->db->count_all_results($this->db->dbprefix('newsletter'));
            if($verifica > 0) return TRUE;
            else return FALSE;
        }

        public function producto_puid($pid){
            $this->db->cache_off();
            $this->db->select('puid');
            $this->db->where('pid', $pid);
            $puid = $this->db->get($this->db->dbprefix('catalogo_productos'));
            return $puid->row();
            $puid->free_result();
        }

        public function producto_puid_slug($slug){
            $this->db->cache_off();
            $this->db->select('puid');
            $this->db->where('slug_producto', $slug);
            $puid = $this->db->get($this->db->dbprefix('catalogo_productos'));
            return $puid->row();
            $puid->free_result();
        }

        public function producto_puid_modelo($model){
            $this->db->cache_off();
            $this->db->select('puid');
            $this->db->where('slug_modelo_producto', $model);
            $puid = $this->db->get($this->db->dbprefix('catalogo_productos'));
            return $puid->row();
            $puid->free_result();
        }

        public function category_cid($cat){
            $this->db->cache_off();
            $this->db->select('cid');
            $this->db->where('slug_categoria', $cat);
            $cid = $this->db->get($this->db->dbprefix('catalogo_categorias'));
            return $cid->row();
            $cid->free_result();
        }

        public function cuidados_asignados_detalle($puid) {
            $this->db->cache_off();
            $this->db->select('a.cuidado, a.icon');
            $this->db->from($this->db->dbprefix('catalogo_cuidados') . ' AS a');
            $this->db->join($this->db->dbprefix('productos_cuidados') . ' AS m', 'm.sku_uid = a.sku_uid', 'INNER');
            $this->db->where('m.puid', $puid);
            $cuidados_detalle = $this->db->get();
            if ($cuidados_detalle->num_rows() > 0){
                return $cuidados_detalle->result();
            }else
                return NULL;
            $cuidados_detalle->free_result();
        }

        public function mismo_nombre_categoria( $nombre_categoria ) {
            $this->db->from( $this->db->dbprefix( 'catalogo_categorias' ) );
            $this->db->where( 'nombre_categoria', $nombre_categoria );
            $mismo_nombre = $this->db->count_all_results();
            return $mismo_nombre;
        }

        public function mismo_nombre_banner( $nombre_banner ) {
            $this->db->from( $this->db->dbprefix( 'catalogo_banners' ) );
            $this->db->where( 'nombre_banner', $nombre_banner );
            $mismo_nombre = $this->db->count_all_results();
            return $mismo_nombre;
        }

        public function mismo_nombre_producto( $nombre_producto ) {
            $this->db->from( $this->db->dbprefix( 'catalogo_productos' ) );
            $this->db->where( 'nombre_producto', $nombre_producto );
            $mismo_nombre = $this->db->count_all_results();
            return $mismo_nombre;
        }

        public function mismo_modelo_producto( $modelo_producto ) {
            $this->db->from( $this->db->dbprefix( 'catalogo_productos' ) );
            $this->db->where( 'slug_modelo_producto', $modelo_producto );
            $mismo_nombre = $this->db->count_all_results();
            return $mismo_nombre;
        }
    /** Terminan las consultas * */

    /** @Nuevos registros  * */
        public function nuevo_usuario() {
            
        }

        public function nueva_categoria($data) {
            $this->db->set('cuid', "UUID()", FALSE);
            $this->db->set('nombre_categoria', $data['nombre_categoria']);
            $this->db->set('orden_categoria', $data['orden_categoria']);
            
            $this->db->set('descripcion_categoria', $data['descripcion_categoria']);
            $this->db->set('slug_categoria', $data['slug']);
            $this->db->set('parent', $data['parent']);
            $this->db->insert($this->db->dbprefix('catalogo_categorias'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function nuevo_producto($data) {
            $this->db->set('puid', 'UUID()', FALSE);
            $this->db->set('nombre_producto', $data['nombre_producto']);
            $this->db->set('slug_producto', $data['slug_producto']);
            $this->db->set('descripcion_producto', $data['descripcion_producto']);
            $this->db->set('precio_metro', $data['precio_metro_producto']);
            $this->db->set('precio_rollo', $data['precio_rollo_producto']);
            if (isset($data['imagen_producto'])) {
                $this->db->set('imagen_producto', $data['imagen_producto']);
                $this->db->set('thumbs_producto', $data['thumbnails_producto']);
            }
            if (isset($data['galeria_producto'])) {
                $this->db->set('galeria_producto', $data['galeria_producto']);
            }
            $this->db->set('modelo_producto', $data['modelo_producto']);
            $this->db->set('slug_modelo_producto', $data['slug_modelo_producto']);
            $this->db->set('destacado', $data['producto_destacado']);
            $this->db->set('tipo_producto', $data['tipo_producto']);
            $this->db->set('colores_producto', $data['colores']);
            $this->db->set('alta_producto', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->set('modificacion_producto', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->set('autor', $data['autor']);
            $this->db->set('metros_rollo', $data['metros_rollo_producto']);
            $this->db->insert($this->db->dbprefix('catalogo_productos'));
            $this->db->cache_delete_all();
            $puid = $this->manager->producto_puid($this->db->insert_id());
            if ($this->db->affected_rows() > 0){
                if ($data['cuidados'] != "false") {
                    $this->limpiar_cuidados_producto($puid->puid);
                    $this->guardar_cuidados_producto($puid->puid, $data['cuidados']);
                }
                $this->limpiar_categorias_producto('prod', $puid->puid);
                $this->guardar_categorias_producto($puid->puid, $data['categoria']);
                if($this->db->affected_rows() > 0)
                    return TRUE;
                else
                    return FALSE;
            }else{
                return FALSE;
            }
        }

        public function nuevo_color($data) {
            $this->db->set('color_uid', 'UUID()', FALSE);
            $this->db->set('nombre_color', $data['nombre_color']);
            $this->db->set('hexadecimal_color', $data['hex_color']);
            $this->db->insert($this->db->dbprefix('catalogo_colores'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function nuevo_banner($data) {
            $this->db->set('buid', 'UUID()', FALSE);
            $this->db->set('nombre_banner', $data['nombre_banner']);
            $this->db->set('slug_banner', $data['slug_banner']);
            $this->db->set('link', $data['link_banner']);
            $this->db->set('img_banner', $data['thumbnails_banner']);
            $this->db->set('descripcion_banner', $data['descripcion_banner']);
            $this->db->set('codigo_promocion', $data['codigo_promocion']);
            $this->db->set('status_banner', 0);
            $this->db->set('fecha_alta', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->insert($this->db->dbprefix('catalogo_banners'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function contacto($data) {
            $this->db->set('fecha', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->set('nombre', "AES_ENCRYPT('{$data['nombre']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('email', "AES_ENCRYPT('{$data['email']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('celular', "AES_ENCRYPT('{$data['telefono_celular']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('mensaje', $data['mensaje']);
            $this->db->set('ip', "AES_ENCRYPT('{$data['ip']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('navegador', $data['navegador']);
            $this->db->insert($this->db->dbprefix('formulario_contacto'));
            if ($this->db->affected_rows() > 0)
                return true;
            else
                return false;
        }

        public function pedido($data) {
            $contenido_pedido = json_encode($data['contenido_pedido']);
            $this->db->set('nombre_completo', "AES_ENCRYPT('{$data['nombre_completo']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('correo_electronico', "AES_ENCRYPT('{$data['correo_electronico']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('telefono_celular', "AES_ENCRYPT('{$data['telefono_celular']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('num_pedido', $data['num_pedido']);
            $this->db->set('entrega_pedido', $data['entrega_pedido']);
            if ($data['tipo_entrega'] == 2) {
                $entrega_domicilio = array(
                    'calle' => $data['calle_envio'],
                    'numero' => $data['numero_envio'],
                    'colonia' => $data['colonia_envio'],
                    'provincia' => $data['provincia_envio'],
                    'estado' => $data['estado_envio'],
                    'cpostal' => $data['cpostal_envio'],
                    'telefono' => $data['telefono_envio'],
                );
                $entrega_domicilio = json_encode($entrega_domicilio);
                $this->db->set('datos_envio', "AES_ENCRYPT('{$entrega_domicilio}','{$this->key_encrypt}')", FALSE);
            }
            $this->db->set('contenido_pedido', $contenido_pedido);
            $this->db->set('total_pedido', $data['total_pedido']);
            $this->db->set('fecha_pedido', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->insert($this->db->dbprefix('lista_pedidos'));
            $pid = $this->db->insert_id();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function pedir_catalogo($data) {
            $this->db->set('fecha', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->set('nombre', $data['nombre']);
            $this->db->set('apellidos', "AES_ENCRYPT('{$data['apellidos']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('email', "AES_ENCRYPT('{$data['email']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('direccion', "AES_ENCRYPT('{$data['direccion']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('catalogos', $data['catalogos']);
            $this->db->set('promociones', $data['promociones']);
            $this->db->set('folio_catalogo', $data['folio_catalogo']);
            $this->db->set('ip', $data['ip']);
            $this->db->set('navegador', $data['navegador']);
            $this->db->insert($this->db->dbprefix('pedido_catalogo_fisico'));
            if ($this->db->affected_rows() > 0) {
                if( $data['promociones'] == 1 ){
                    if($this->validar_suscriptor($data['email']) != TRUE) {
                        $this->suscribir($data);
                    }
                }
                return TRUE;
            }
            else return FALSE;
        }

        public function suscribir($data) {
            $this->db->set('email',"AES_ENCRYPT('{$data['suscriptor']}','{$this->key_encrypt}')", FALSE);
            $this->db->set('fecha', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->set('ip', $data['ip']);
            $this->db->set('navegador', $data['user_agent']);  
            $this->db->insert($this->db->dbprefix('newsletter'));
            if ($this->db->affected_rows() > 0) return TRUE;
            else return FALSE;
        }

        public function guardar_categorias_producto($puid, $categorias) {
            $categorias = json_decode($categorias);
            foreach ($categorias as $categoria) {
                $this->db->set('puid', $puid);
                $this->db->set('cid', $categoria);
                $this->db->insert($this->db->dbprefix('productos_categorias'));
            }
            $this->db->cache_delete_all();
        }

        public function guardar_cuidados_producto($puid, $cuidados) {
            $cuidados = json_decode($cuidados);
            foreach ($cuidados as $cuidado) {
                $this->db->set('puid', $puid);
                $this->db->set('sku_uid', $cuidado);
                $this->db->insert($this->db->dbprefix('productos_cuidados'));
            }
            $this->db->cache_delete_all();
        }
    /** Terminan los registros * */

    /** @Actualizaciones * */
        public function activar_banner($data) {
            $this->db->where('buid', $data['buid']);
            $this->db->set('status_banner', $data['status_banner']);
            $this->db->set('fecha_activacion', "UNIX_TIMESTAMP(NOW())", FALSE);
            $this->db->update($this->db->dbprefix('catalogo_banners'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function activar_producto($data) {
            $this->db->where('puid', $data['puid']);
            $this->db->set('status_producto', $data['status_producto']);
            $this->db->set('modificacion_producto', "UNIX_TIMESTAMP(NOW())", FALSE);
            $this->db->update($this->db->dbprefix('catalogo_productos'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function activar_categoria($data) {
            $this->db->where('cid', $data['cid']);
            $this->db->set('status_categoria', $data['status_categoria']);
            $this->db->update($this->db->dbprefix('catalogo_categorias'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function actualizar_producto($data) {
            $this->db->set('nombre_producto', $data['nombre_producto']);
            $this->db->set('slug_producto', $data['slug_producto']);
            $this->db->set('descripcion_producto', $data['descripcion_producto']);
            $this->db->set('precio_metro', $data['precio_metro_producto']);
            $this->db->set('precio_rollo', $data['precio_rollo_producto']);
            if (isset($data['imagen_producto'])) {
                $this->db->set('imagen_producto', $data['imagen_producto']);
                $this->db->set('thumbs_producto', $data['thumbnails_producto']);
            }
            if (isset($data['galeria_producto'])) {
                $this->db->set('galeria_producto', $data['galeria_producto']);
            }
            $this->db->set('modelo_producto', $data['modelo_producto']);
            $this->db->set('slug_modelo_producto', $data['slug_modelo_producto']);
            $this->db->set('destacado', $data['producto_destacado']);
            $this->db->set('tipo_producto', $data['tipo_producto']);
            $this->db->set('colores_producto', $data['colores']);
            $this->db->set('modificacion_producto', 'UNIX_TIMESTAMP(NOW())', FALSE);
            $this->db->set('autor', $data['autor']);
            $this->db->set('metros_rollo', $data['metros_rollo_producto']);
            $this->db->where('puid', $data['puid']);
            $this->db->update($this->db->dbprefix('catalogo_productos'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0){
                if ($data['cuidados'] != "false") {
                    $this->limpiar_cuidados_producto($data['puid']);
                    $this->guardar_cuidados_producto($data['puid'], $data['cuidados']);
                }
                $this->limpiar_categorias_producto('prod',$data['puid']);
                $this->guardar_categorias_producto($data['puid'], $data['categoria']);
                if($this->db->affected_rows() > 0)
                    return TRUE;
                else
                    return FALSE;
            }else
                return FALSE;
        }

        public function actualizar_categoria($data) {
            $this->db->set('nombre_categoria', $data['nombre_categoria']);
            $this->db->set('orden_categoria', $data['orden_categoria']);
            $this->db->set('descripcion_categoria', $data['descripcion_categoria']);
            $this->db->set('slug_categoria', $data['slug']);
            $this->db->set('parent', $data['parent']);
            $this->db->where('cid', $data['cid']);
            $this->db->update($this->db->dbprefix('catalogo_categorias'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function actualizar_color($data) {
            $this->db->set('nombre_color', $data['nombre_color']);
            $this->db->set('hexadecimal_color', $data['hex_color']);
            $this->db->where('color_uid', $data['color_id']);
            $this->db->update($this->db->dbprefix('catalogo_colores'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function actualizar_banner($data) {
            $this->db->set('nombre_banner', $data['nombre_banner']);
            $this->db->set('slug_banner', $data['slug_banner']);
            $this->db->set('link', $data['link_banner']);
            if (isset($data['thumbnails_banner'])) {
                $this->db->set('img_banner', $data['thumbnails_banner']);
            }
            $this->db->set('descripcion_banner', $data['descripcion_banner']);
            $this->db->where('buid', $data['buid']);
            $this->db->update($this->db->dbprefix('catalogo_banners'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
    /** Terminan las actualizaciones * */

    /** @Eliminación * */
        public function eliminar_banner($buid) {
            $this->db->where('buid', $buid['buid']);
            $this->db->delete($this->db->dbprefix('catalogo_banners'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function eliminar_producto($puid) {
            $this->db->where('puid', $puid['puid']);
            $this->db->delete($this->db->dbprefix('catalogo_productos'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0){
                $this->limpiar_categorias_producto('prod', $puid['puid']);
                $this->limpiar_cuidados_producto($puid['puid']);
                return TRUE;
            }else
                return FALSE;
        }

        public function eliminar_categoria($cid) {
            $categorias = array();
            $childs = $this->manager->lista_categorias($cid['cid'], 0);
            if($childs){
                array_push($categorias, $cid['cid']);
                foreach($childs as $child){
                    array_push($categorias, $child->cid);
                    $subchilds = $this->manager->lista_categorias($child->cid, 0);
                    if($subchilds){
                        foreach($subchilds as $subchild){
                            array_push($categorias, $subchild->cid);
                        }
                    }
                }
                $this->limpiar_categorias_producto('cats', $cid['cid']);
                $this->db->where('cid', $cid['cid']);
                $this->db->delete($this->db->dbprefix('catalogo_categorias'));
                if ($this->db->affected_rows() > 0){
                    $this->db->set('parent', 0);
                    $this->db->set('status_categoria', 0);
                    $this->db->where_in('parent', $categorias);
                    $this->db->update($this->db->dbprefix('catalogo_categorias'));
                    $this->db->cache_delete_all();
                    return TRUE;
                }else{
                    return FALSE;
                }
            }else{
                $this->limpiar_categorias_producto('cats', $cid['cid']);
                $this->db->where('cid', $cid['cid']);
                $this->db->delete($this->db->dbprefix('catalogo_categorias'));
                $this->db->cache_delete_all();
                if ($this->db->affected_rows() > 0){
                    return TRUE;
                }else{
                    return FALSE;
                }
            }
        }

        public function eliminar_color($cuid) {
            $this->db->where('color_uid', $cuid['cuid']);
            $this->db->delete($this->db->dbprefix('catalogo_colores'));
            $this->db->cache_delete_all();
            if ($this->db->affected_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }

        public function limpiar_categorias_producto($type, $id) {
            switch ($type) {
                case 'cats':
                    $this->db->where('cid', $id);
                    $this->db->delete($this->db->dbprefix('productos_categorias'));
                    $this->db->cache_delete_all();
                    break;
                case 'prod':
                    $this->db->where('puid', $id);
                    $this->db->delete($this->db->dbprefix('productos_categorias'));
                    $this->db->cache_delete_all();
                    break;
            }      
        }

        public function limpiar_cuidados_producto($puid) {
            $this->db->where('puid', $puid);
            $this->db->delete($this->db->dbprefix('productos_cuidados'));
            $this->db->cache_delete_all();
        }
    /** Terminan los querys de eliminación * */
}
?>