<?php $this->load->view('layouts/header'); ?>
<br/>

<h1> <?=$title?> </h1>

<a href="<?=base_url()?>index.php/app/new">Crear Tarea</a>

<br/>
<?php if( $success ) echo "<p>Hecho: " . $success . "</p>"; ?>
<br/>
<?php if( $error ) echo "<p>Error: " . $error . "</p>"; ?>
<br/>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>editar</th>
            <th>eliminar</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($tasks as $item): ?>
        <tr>
            <td>#<?=$item->id?></td>
            <td><?=$item->name?></td>
            <td> <a href="<?=base_url()?>index.php/app/edit/<?=$item->id?>"> Editar </a> </td>
            <td> <button type="submit" onClick="setAlertConfirm( <?=$item->id?> )">Eliminar</button> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>

var url = "<?=base_url()?>";

function setAlertConfirm( id ) {
    var confirm_ = confirm('¿Está seguro de eliminar éste item?');
    if( confirm_ ) {
        window.location.href = url + "index.php/app/delete/" + id;
    }
}

</script>
