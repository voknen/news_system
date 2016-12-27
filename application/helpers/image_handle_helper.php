<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('image_validation'))
{
    function image_validation($image, $check_size = false)
    {
        if ($check_size) {
            if (isset($image['thumbnail']['size']) && $image['thumbnail']['size'] <= 0) {
                return TRUE;
            } 
        }

        if (isset($image['thumbnail']['name']) && $image['thumbnail']['name'] != '') {
            $ext = pathinfo($image['thumbnail']['name'], PATHINFO_EXTENSION);
            $ci = get_instance(); // CI_Loader instance
            $ci->load->config('config');

            if (strpos($ci->config->item('formats'), $ext) === false) {
                return TRUE;
            }
        }
    }   
}

if ( ! function_exists('get_image_thumbnail_name'))
{
    function get_image_thumbnail_name($file, $size)
    {
        $info = pathinfo($file);
        $filename =  basename($file, '.' . $info['extension']);

        if ($size == 250) {
            $filename = $filename . '_250x250.' . $info['extension']; 
        } else if ($size == 500) {
            $filename = $filename . '_500x500.' . $info['extension'];
        }

        return $filename;
    }
}

if (!function_exists('delete_thumbnails'))
{
    function delete_thumbnails($news)
    {
        $ci = get_instance(); // CI_Loader instance
        $ci->load->config('config');

        $thumbnail_path = $ci->config->item('assets_dir');
        $thumbnails = array(
            'normal' => $news->thumbnail,
            'small'  => get_image_thumbnail_name($news->thumbnail, 250),
            'big'    => get_image_thumbnail_name($news->thumbnail, 500)
        );

        foreach ($thumbnails as $thumbnail) {
            $image = $thumbnail_path . $thumbnail;
            if (file_exists($image)) {
                unlink($image);
            }
        }
    }
}