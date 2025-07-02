<form method="post" action="/GestionLaboratorio/presentacion/eliminacion.php" onsubmit="return validarSeleccion();">
    <input type="hidden" name="table" value="proyecto C">
    <div class="table-scroll-wrapper">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($carreras as $temp): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="seleccionados[]" value="<?php echo $temp->getIdProyectoC(); ?>">
                    </td>
                    <td><?php echo $temp->getNombre(); ?></td>
                    <td><?php echo $temp->getCodigo(); ?></td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="modo" value="seleccionados">
    <button type="submit" class="btn btn-primary mt-3">Eliminar seleccionados</button>
</form>

<style>
.table-scroll-wrapper {
    max-height: 400px;
    overflow-y: auto;
}

.table-scroll-wrapper table {
    width: 100%;
    table-layout: auto;
}
</style>

<script>
function validarSeleccion() {
    const checkboxes = document.querySelectorAll('input[name="seleccionados[]"]');
    let algunoSeleccionado = false;

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            algunoSeleccionado = true;
        }
    });

    if (!algunoSeleccionado) {
        alert("Seleccione al menos un registro.");
        return false; // 폼 제출 막기
    }
    return confirm("¿Está seguro de que desea eliminar los elementos seleccionados?");
}
</script>