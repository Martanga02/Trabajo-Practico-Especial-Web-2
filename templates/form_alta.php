<!-- formulario de almacen -->
<form action="nueva" method="POST" class="my-4">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label>Título</label>
                <input required name="title" type="text" class="form-control">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label>Categoria</label>
                <select required name="priority" class="form-control">
                    <option value="1">Verduras</option>
                    <option value="2">Frutas</option>
                    <option value="3">Lacteos</option>
                    <option value="4">Carnes</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Descripcion</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
</form>