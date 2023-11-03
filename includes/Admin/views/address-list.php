<div class="wrap">

    <h1 class="wp-heading-inline"><?php _e('Addressbook', 'webdevbd')?></h1>

    <a href="<?php echo admin_url('admin.php?page=webdevbd-options&action=new') ?>" class = "page-title-action"'><?php _e('Add New', 'webdevbd')?></a>


   <?php if (isset($_GET['inserted'])) {?>
    <div class="notice notice-success">
        <p><?php _e('Address has been added successfully', 'webdevbd')?></p>
    </div>
   <?php }?>

   <?php if (isset($_GET['address-deleted']) && $_GET['address-deleted'] == 'true'): ?>
    <div class="notice notice-success">
        <p><?php _e('Address has been deleted successfully', 'webdevbd');?></p>
    </div>
<?php endif;?>




    <form action="" method="post">
         <?php
$table = new Ashraf\Webdevbd\Admin\Address_List();
$table->prepare_items();
$table->search_box('search', 'search_id');
$table->display();?>
    </form>




</div>