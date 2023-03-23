
<!DOCTYPE html>
<html>
<head>
<title>TODO LIST</title>
</head>
<body>
    <div class="bg-container">
        <div class="header">
            <div class="header-logo">
                <h1>Todo List</h1>
            </div>
            <div class="new-task"><button type="button" id="new-task-btn">Nueva tarea</button></div>
        </div>

        <div class="main-container">
            <div class="left-container">
                <div class="menu">
                    <div class="shortcuts">
                        <h2>Atajos</h2>
                        <ul class="shortcuts-menu">
                            <li class="display-all-tasks">Todas las tareas</li>
                            <li class="due-soon">En proceso</li>
                            <li class="completed-tasks">Completado</li>
                        </ul>
                    </div>
                    <div class="projects"><h2>Proyectos</h2><ul class="project-list"></ul></div>
                </div>
            </div>
            <div class="todos-container">
            </div>
        </div>
    </div>

    <div id="add-todo-modal" class="modal">
        <div class="new-todo-modal-content modal-content">
            <form id="add-task-form" action="javascript:void(0);"> <div><input class=" input" type="text" id="name-new" name="name" placeholder="Nombre de la tarea" required max-lenth="150">
        </div>
        <div>
            <textarea class="input" id="details-new" name="details" rows="5" cols="20" placeholder="Detalles"></textarea>
        </div>
        <div class="input-group">
            <label for="due-date-new">Fecha de vencimiento:</label><input class="input" type="date" id="due-date-new" name="due-date">
        </div>
        <div class="input-group">
            <label for="project-select">Proyecto:</label>
            <select name="project-select" id="project-select">
                <option class="new-task-project" value="new-project">Nuevo proyecto</option>
                <option class="new-task-project" id="uncategorized-option" value="uncategorized">Sin categorizar</option>
            </select>
        </div>
        <div class="new-project-input">
            <input class="input" type="text" id="new-project-name" name="new-project-name" placeholder="Nombre del nuevo proyecto" required>
        </div>
        <div class="modal-buttons">
            <button class="modal-button submit-new-task" type="submit">Agregar tarea</button><button type="button" class="modal-button cancel-new-task">Cancelar</button>
        </div>
        </form>
    </div>
    </div>
    <div id="details-modal" class="modal">
        <div class="details-modal-content modal-content">
            <div class="details-name details-group">
                <div class="details-name-title details-title">Nombre de la tarea:</div>
                <div class="details-name-name details-data"></div>
            </div>
            <div class="details-details details-group">
                <div class="details-details-title details-title">Detalles:</div>
                <div class="details-details-details details-data"></div>
            </div>
            <div class="details-date details-group">
                <div class="details-date-title details-title">Fecha de vencimiento:</div>
                <div class="details-date-date details-data"></div>
            </div>
            <div class="details-project details-group">
                <div class="details-project-title details-title">Proyecto:</div>
                <div class="details-project-project details-data"></div>
            </div>
            <div class="details-completed details-group">
                <div class="details-completed-title details-title">Completado:</div>
                <div class="details-completed-completed details-data"></div>
            </div>
            <div class="details-buttons">
                <button class="modal-button" id="details-close-button">Cerrar</button>
            </div>
        </div>
    </div>
</body>
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/Prueba.cssa') }}">
@endpush
</html>


   