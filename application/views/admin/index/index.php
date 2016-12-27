<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/index.css?version=2">
        <title>All news</title>
    </head>    
    <body>
        <a href="<?php echo base_url(); ?>index.php/admin/add">Add news</a>
        <table border="1">
            <th>N</th>
            <th>Image</th>
            <th>Title</th>
            <th>Date</th>
            <th></th>
            <th></th>
            <?php if (!empty($news)) : ?>
                <?php foreach ($news as $key => $value) : ?>
                    <tr>
                        <td><?php echo $key + 1;  ?></td>
                        <td><img src="<?php echo base_url() . 'public/uploads/' . get_image_thumbnail_name($value->thumbnail, 250);  ?>" /></td>
                        <td><?php echo $value->title;  ?></td>
                        <td><?php echo date('jS F', strtotime($value->date)); ?></td>
                        <td><a class="edit" href="<?php echo base_url() . 'index.php/admin/edit/' . $value->id ?>">Edit</a></td>
                        <td><a class="delete" href="<?php echo base_url() . 'index.php/admin/delete/' . $value->id ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">No news items</td>
                </tr>
            <?php endif; ?>
        </table>
    </body>
</html>