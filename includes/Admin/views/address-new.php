<div class="wrap">

    <h1 class="wp-heading-inline"><?php _e('New Address', 'webdevbd')?></h1>


    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="name"><?php _e('Name', 'webdevbbd');?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="">
                        <?php if ($this->has_error('name')) {?>
                            <p class="error-description"><?php echo $this->get_error('name'); ?></p>
                        <?php }?>
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
                        <?php if (isset($this->errors['phone'])) {?>
                            <p class="error-description"><?php echo $this->errors['phone']; ?></p>
                        <?php }?>
                    </td>
                </tr>

            </tbody>
        </table>

        <?php wp_nonce_field('new-address');?>
        <?php submit_button(__('Add Address', 'webdevbd'), 'primary', 'submit_address', 'true', 'null');?>

    </form>


</div>