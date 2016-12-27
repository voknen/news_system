<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="utf-8">
        <title>Detail page</title>
    </head>    
    <body>
        <a href="../">Back to home</a>
        <?php if (!empty($news) && isset($news[0])) : ?>
            <?php $current_news = $news[0]; ?>
        <?php endif; ?>
        <div>
            <h1><?php echo isset($current_news->title) ? $current_news->title : ''; ?></h1>
            <div>
                <p><?php echo isset($current_news->date) ? date('jS F', strtotime($current_news->date)) : ''; ?></p>
            </div>
            <div>
                <p><?php echo isset($current_news->text) ? $current_news->text : ''; ?></p>
            </div>
            <div>
                <?php 
                    $thumbnail_path = base_url() . 'public/uploads/';
                    $thumbnail = isset($current_news->thumbnail) ? get_image_thumbnail_name($current_news->thumbnail, 500) : '';
                ?>
                <img src="<?php echo $thumbnail_path . $thumbnail; ?>" />
            </div>
        </div>
    </body>
</html>