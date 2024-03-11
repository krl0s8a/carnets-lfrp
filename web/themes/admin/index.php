<?php
echo theme_view('header');
echo theme_view('top_navigation');
?>
<div class="container" id="container">
    <div class="row" id="main-con">
        <table class="lt">
            <tr>
                <td class="sidebar-con">
                    <div id="sidebar-left" >
                        <?php echo theme_view('menu_left'); ?>
                    </div>
                </td>
                <td class="content-con">
                    <div id="content">
                        <div class="row">
                            <?php Template::block('sub_nav'); ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo Template::message(); 
                                echo '<div class="alerts-con"></div>';
                                echo isset($content) ? $content : Template::content();
                                ?>
                            </div>
                        </div>                        
                        <div class="clearfix"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php echo theme_view('footer'); ?>