<h1>Editar Usuario</h1>
<form action="/dashboard/users/edit/<?php echo $user['id']; ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="cc" class="form-label">CC</label>
        <input type="text" class="form-control" id="cc" name="cc" value="<?php echo $user['cc']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="senescyt" class="form-label">Senescyt</label>
        <input type="text" class="form-control" id="senescyt" name="senescyt" value="<?php echo $user['senescyt']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <select class="form-control" id="type" name="type" required>
            <option value="D" <?php echo $user['type'] === 'D' ? 'selected' : ''; ?>>Doctor</option>
            <option value="A" <?php echo $user['type'] === 'A' ? 'selected' : ''; ?>>Administrador</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="active" class="form-label">Activo</label>
        <select class="form-control" id="active" name="active" required>
            <option value="1" <?php echo $user['active'] === '1' ? 'selected' : ''; ?>>Sí</option>
            <option value="0" <?php echo $user['active'] === '0' ? 'selected' : ''; ?>>No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
</form>