<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * menu_ul()
 * Genera una lista desordenada con la clase current en el elemento seleccionado.
 */
if ( ! function_exists('menu_ul')){
    function menu_ul($sel = 'home', $config)   {
        $items = $config;
        
        $menu = '<ul class="main_nav">'."\n";
        foreach($items as $item)        {
            $current = (in_array($sel, $item)) ? ' class="active"' : '';
            $id = (!empty($item['id'])) ? ' id="'.$item['id'].'"' : '';
            $menu .= '<li'.$current.'><a href="'.$item['link'].'"'.$id.'>'.$item['title'].'</a></li>'."\n";
        }
        $menu .= '</ul>'."\n";
        return $menu;
    }
}

// ------------------------------------------------------------------------

/**
 * menu_p
 * Genera un parrafo con la clase current en el elemento seleccionado
 */
if ( ! function_exists('menu_p')){
    function menu_p($sel = 'home', $separator = '', $config){
        $items = $config;

        $count = count($items);
        $i = 0;
        $menu = "\n".'<p class="bottom_nav">';
        foreach($items as $item){
            $current = (in_array($sel, $item)) ? ' class="active"' : '';
            $id = (!empty($item['id'])) ? ' id="'.$item['id'].'"' : '';
            $menu .= '<a'.$current.' href="'.$item['link'].'"'.$id.'>'.$item['title'].'</a>';
            $i++;
            if($count != $i){
                $menu .= ' '.$separator.' ';
            }
        }
        $menu .= '</p>'."\n";
        return $menu;
    }
}


/* End of file navigation_helper.php */
/* Location: ./system/helpers/navigation_helper.php */