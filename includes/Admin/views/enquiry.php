
<div class="wedevbd-enquiry-form" id="webdevbd-enquiry-form">
    <h2>Enquiry Form</h2>

    <form action="" method="post">
    <div class="form-row">
        <label for="name"><?php _e('Name', 'webdevbd');?>:</label>
        <input type="text" id="name" name="name" required>
</div>
<div class="form-row">
        <label for="email"><?php _e('Email', 'webdevbd');?>:</label>
        <input type="email" id="email" name="email" required>
</div>

<div class="form-row">
        <label for="message"><?php _e('Message', 'webdevbd');?>:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
</div>
<div class="form-row">
        <?php wp_nonce_field('webdevbd-enquiry-form');?>

        <input type="hidden" name="action" value="webdevbd_enquiry" >

        <input type="submit" id="send-enquiry" name="send_enquiry" value="<?php esc_attr_e('Send Enquiry', 'webdevbd');?>" >
</div>

    </form>
</div>
