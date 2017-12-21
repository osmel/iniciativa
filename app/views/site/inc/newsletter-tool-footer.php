<?php
    /**
     * Módulo de suscripción a newsletter footer
     */
?>
<span id="newsletter">
    <?php
        $newsletter = array('id'=>'newsletter_form_footer','name'=>'newsletter_form_footer','method'=>'POST','autocomplete'=>'off');
        echo form_open('newsletter',$newsletter);
    ?>
        <input type="email" name="email_newsletter" class="input-rounded" id="email_newsletter" placeholder="CORREO ELECTRONICO">
        <input type="submit" id="" value="Enviar" class="btn-blue">
    <?php echo form_close(); ?>
</span>