<!-- Filtro a la izquierda (más estrecho) -->
<div class="filter-title">Filtrar Asistencias</div>
<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="hidden" name="filtrar" value="1">

    <!-- Año desde -->
    <div class="mb-2">
        <label for="year_start" class="form-label">Año desde</label>
        <input type="number" name="year_start" id="year_start" class="form-control form-control-sm"
            placeholder="Ej: 2024">
    </div>

    <!-- Mes desde -->
    <div class="mb-2">
        <label for="month_start" class="form-label">Mes desde</label>
        <select name="month_start" id="month_start" class="form-select form-select-sm">
            <option value="">Mes</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <!-- Año hasta -->
    <div class="mb-2">
        <label for="year_end" class="form-label">Año hasta</label>
        <input type="number" name="year_end" id="year_end" class="form-control form-control-sm" placeholder="Ej: 2026">
    </div>

    <!-- Mes hasta -->
    <div class="mb-2">
        <label for="month_end" class="form-label">Mes hasta</label>
        <select name="month_end" id="month_end" class="form-select form-select-sm">
            <option value="">Mes</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <!-- Carrera -->
    <div class="mb-2">
        <label for="proyectoC" class="form-label">Carrera</label>
        <input type="text" name="proyectoC" id="proyectoC" class="form-control form-control-sm" placeholder="Carrera">
    </div>

    <!-- Asignatura -->
    <div class="mb-2">
        <label for="asignatura" class="form-label">Asignatura</label>
        <input type="text" name="asignatura" id="asignatura" class="form-control form-control-sm"
            placeholder="Asignatura">
    </div>

    <!-- Botón Buscar -->
    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
    </div>
</form>