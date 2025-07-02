<div class="col d-flex flex-column" style="min-height: 100vh;">
    <div class="table-container">
        <form id="form-eliminacion" method="post" action="/GestionLaboratorio/presentacion/eliminacion.php"
            onsubmit="return validarSeleccion();">
            <input type="hidden" name="table" value="asistencia">
            <input type="hidden" name="table" value="asistencia">
            <div class="table-scroll-wrapper flex-grow-1">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="seleccionar-todo" onclick="seleccionarTodos(this)"></th>
                            <th>fecha</th>
                            <th>Proyecto Curricular</th>
                            <th>Equipo/Práctica/Clase</th>
                            <th>Asignatura</th>
                            <th>Docente</th>
                            <th>Código Grupo</th>
                            <th>N° Estudiantes</th>
                            <th>Hora Entrada</th>
                            <th>Hora Salida</th>
                            <th>Firma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($asistencias as $temp): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="seleccionados[]"
                                    value="<?php echo $temp->idAsistencia; ?>">
                            </td>
                            <td><?php echo $temp->fecha; ?></td>
                            <td><?php echo $temp->proyectoC; ?></td>
                            <td><?php echo $temp->actividad; ?></td>
                            <td><?php echo $temp->asignatura; ?></td>
                            <td><?php echo $temp->docente; ?></td>
                            <td><?php echo $temp->codigoGrupo; ?></td>
                            <td><?php echo $temp->numeroEstudiante; ?></td>
                            <td><?php echo $temp->horaEntrada; ?></td>
                            <td><?php echo $temp->horaSalida; ?></td>
                            <td>
                                <img src="/GestionLaboratorio/<?php echo $temp->firma; ?>" alt="Firma" width="100"
                                    height="50">
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="modo" value="seleccionados">
            <!-- <button type="submit" class="btn btn-primary mt-3">Eliminar seleccionados</button> -->
        </form>
    </div>
</div>
<?php
$_SESSION['asistencias'] = $asistencias;
?>
<div class="btn-area d-flex gap-2"></div>
<a class="btn btn-primary" href="#" role="button"
    onclick="document.getElementById('form-eliminacion').submit();">Eliminar seleccionados</a>
<a class="btn btn-primary" href="/GestionLaboratorio/presentacion/pdf/generarAsistencia.php" role="button" target="_blank">pdf</a>
</div>
<style>
.table-scroll-wrapper {
    max-height: 550px;
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
        return false;
    }
    return confirm("¿Está seguro de que desea eliminar los elementos seleccionados?");
}

function seleccionarTodos(masterCheckbox) {
    const checkboxes = document.querySelectorAll('input[name="seleccionados[]"]');
    checkboxes.forEach((checkbox) => {
        checkbox.checked = masterCheckbox.checked;
    });
}
</script>