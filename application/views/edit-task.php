<?php $this->load->view('layouts/header'); ?>
<br/>

<h1> <?=$title?> </h1>

<?php if( $error ) echo "<p>Error: " . $error . "</p>"; ?>

<form action="<?=base_url()?>index.php/app/update/" method="POST">
    <input type="hidden" name="id" value="<?=$task->id?>"/>
    <input type="text" name="name" value="<?=$task->name?>"/>
    <button type="submit">Guardar</submit>
</form>
