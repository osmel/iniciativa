<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * getThumbnail helper
 *
 * Características:
 * - Obtener el thumbnail específico del producto
 *
 * @package     getThumbnail
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Eric Bravo
 * @version     1.0 (CI 2.x & CI 1.x. Creado en Noviembre,06 2013)
 * @copyright   Copyright (c) 2013-2015 Eric Bravo, IT Citrus
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if ( ! function_exists('get_thumbnail')){
    function get_thumbnail($arr, $size){
        $arr = json_decode($arr);
        $thumbnails = (array)$arr;
        foreach ($thumbnails as $thumb => $value) {
        	if($size == $thumb){
        		return $value;
        	}
        }
    }
}

if(! function_exists('get_image_gallery')){
	function get_image_gallery($arr, $size){
        $thumbnails = (array)$arr;
        foreach ($thumbnails as $thumb => $value) {
        	if($size == $thumb){
        		return $value;
        	}
        }
    }
}


/* End of file get_thumbnails.php */
/* Location: ./system/helpers/get_thumbnails.php */

?>