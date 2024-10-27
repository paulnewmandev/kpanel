<h1>Editar Servicio</h1>
<form action="/dashboard/services/edit/<?php echo $service['id']; ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $service['name']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $service['description']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $service['price']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
</form>