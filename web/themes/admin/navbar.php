<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <?php echo anchor('/', html_escape($this->settings_lib->item('site.title')), 'class="navbar-brand"'); ?>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!--Sub menu opciones-->
                <?php Template::block('sub_nav'); ?>
            </ul>            
        </div>
    </div>
</nav>
<!-- #Top Bar -->