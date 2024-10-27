<h1>Gestión de Servicios</h1>
<a href="/dashboard/services/create" class="btn btn-primary mb-3">Crear nuevo servicio</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($services as $service): ?>
        <tr>
            <td><?php echo $service['id']; ?></td>
            <td><?php echo $service['name']; ?></td>
            <td><?php echo $service['description']; ?></td>
            <td><?php echo $service['price']; ?></td>
            <td>
                <a href="/dashboard/services/edit/<?php echo $service['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="#" onclick="confirmDelete(<?php echo $service['id']; ?>)" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/dashboard/services/delete/' + id;
            }
        })
    }
</script>