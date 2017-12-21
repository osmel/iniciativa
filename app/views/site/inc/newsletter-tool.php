<?php
    /**
     * Módulo de suscripción a newsletter
     */
?>
<span id="newsletter">
    <?php
        $newsletter = array('id'=>'newsletter_form','name'=>'newsletter_form','method'=>'POST','autocomplete'=>'off');
        echo form_open('newsletter',$newsletter);
    ?>
        <input type="email" name="email_newsletter" class="input-rounded" id="email_newsletter" placeholder="Correo electrónico">
        <input type="submit" id="" value="Enviar" class="btn-blue btn-blue-foot">
    <?php echo form_close(); ?>
</span>