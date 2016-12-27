<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Add News</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css?version=1">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/script.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body>
        <a href="../admin">Back to home</a>
        <div id="main">
            <div id="login">
                <h2>Add news</h2>
                <?php if (isset($success_message) && $success_message != '') : ?>
                    <?php echo $success_message . '<br/>'; ?>
                <?php endif; ?>
                <hr/>
                <?php echo form_open_multipart(); ?>
                    <?php
                        echo "<div class='error_msg'>";
                        echo validation_errors();
                        echo "</div>";
                    ?>
                    <?php if (isset($file_error) && $file_error != '') : ?>
                        <?php
                            echo "<div class='error_msg'>";
                            echo $file_error;
                            echo "</div>";
                        ?>
                    <?php endif; ?>
                    <label for="title">News Title</label>
                    <input type="text" name="title" placeholder="Enter title"/><br /><br />
                    <label for="text">News Text</label>
                    <textarea name="text" placeholder="Enter text" rows="4" cols="40"></textarea><br/><br/>
                    <label for="date">News Date</label>
                    <input type="text" name="date" id="datepicker" placeholder="Enter date"/><br /><br />
                    <label for="thumbnail">News Thumbnail</label>
                    <input type="file" name="thumbnail"/><br /><br />
                    <label for="status">News Status</label><br/><br/>
                    <select name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select><br/><br/>

                    <input type="submit" value=" Save " name="submit"/><br />
                <?php echo form_close(); ?>
            </div>
        </div>
    </body>
</html>