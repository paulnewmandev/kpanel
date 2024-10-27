<h1>Crear Nuevo Usuario</h1>
<form action="/dashboard/users/create" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="cc" class="form-label">CC</label>
        <input type="text" class="form-control" id="cc" name="cc" required>
    </div>
    <div class="mb-3">
        <label for="senescyt" class="form-label">Senescyt</label>
        <input type="text" class="form-control" id="senescyt" name="senescyt" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <select class="form-control" id="type" name="type" required>
            <option value="D">Doctor</option>
            <option value="A">Administrador</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="active" class="form-label">Activo</label>
        <select class="form-control" id="active" name="active" required>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Crear Usuario</button>
</form>