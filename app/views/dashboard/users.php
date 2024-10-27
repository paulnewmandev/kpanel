<h1>Gestión de Usuarios</h1>
<a href="/dashboard/users/create" class="btn btn-primary mb-3">Crear nuevo usuario</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['type'] === 'D' ? 'Doctor' : 'Administrador'; ?></td>
            <td><?php echo $user['active'] === '1' ? 'Sí' : 'No'; ?></td>
            <td>
                <a href="/dashboard/users/edit/<?php echo $user['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="#" onclick="confirmDelete(<?php echo $user['id']; ?>)" class="btn btn-sm btn-danger">Eliminar</a>
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
                window.location.href = '/dashboard/users/delete/' + id;
            }
        })
    }
</script>