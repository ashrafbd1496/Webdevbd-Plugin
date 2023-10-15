<div class="wrap">

    <h1 class="wp-heading-inline"><?php _e('New Address', 'webdevbd')?></h1>
    <?php echo '<pre>';
var_dump($this->errors);
echo '</pre>'; ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="name"><?php _e('Name', 'webdevbbd');?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="address"><?php _e('Address', 'webdevbbd');?></label>
                    </th>
                    <td>
                        <input type="text" name="address" id="address" class="regular-text" value="">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="phone"><?php _e('Phone', 'webdevbbd');?></label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="">
                    </td>
                </tr>

            </tbody>
        </table>

        <?php wp_nonce_field('new-address');?>
        <?php submit_button(__('Add Address', 'webdevbd'), 'primary', 'submit_address', 'true', 'null');?>

    </form>


</div>