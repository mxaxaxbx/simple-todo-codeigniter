<?php $this->load->view('layouts/header'); ?>
<br/>

<h1> <?=$title?> </h1>

<?php if( $error ) echo "<p>Error: " . $error . "</p>"; ?>

<form action="<?=base_url()?>index.php/app/create/" method="POST">
    <input type="text" name="task"/>
    <button type="submit">Guardar</submit>
</form>
