@extends("template.template")

@section("content")

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                    <div class="card-body py-4 px-4 px-md-5">
                        <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                            <i class="fas fa-check-square me-1"></i>
                            <u>TODO LIST</u>
                        </p>
                        <div class="pb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="">
                                        <form action="{{route("tasks.store")}}" method="POST" class="d-flex flex-md-row flex-sm-column align-items-center gap-3">
                                            @csrf
                                            <input type="text" class="form-control form-control-lg" name="texto"
                                                placeholder="Nom de la tasca...">
                                            <input type="date" class="form-control form-control-lg" name="data">
                                            <select class="form-select" name="project_id">
                                                <option value="" selected disabled>Seleciona un proyecto</option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->id }}">{{$project->name}}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <button type="submit" class="btn btn-primary">AÑADIR</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($errors->any)
                            <div class="row">
                                 <ul>
                                    @foreach($errors->all() as $error)
                                        <li><span class="text-danger">{{ $error }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            
                        <hr class="my-4">
            
                        <div class="d-flex justify-content-end align-items-center mb-4 pt-2 pb-3">
                            <p class="small mb-0 me-2 text-muted">Filtrar</p>
                            <form action="{{ route("tasks.index") }}" method="GET" class="d-flex">
                                <select class="form-select" name="data">
                                    <option value="">Todas</option>
                                    <option value="1">Hoy</option>
                                    <option value="0">Anteriores</option>
                                    <option value="2">Posteriores</option>
                                </select>
                                <button type="submit" style="border: 0;">
                                    <i class="fas fa-sort-amount-down-alt ms-2" style="color: #23af89;"></i>
                                </button>
                            </form>
                        </div>
            
                        @foreach($tasks as $task)
                            <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                                <li class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input me-0" 
                                            type="checkbox"
                                            value="1"
                                            @if($task->estado == 1) checked @endif 
                                            onclick="location.href = '{{ route('tasks.estado', $task->id) }}'"
                                        /> 
                                    </div>
                                </li>
                                <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                                    <p class="lead fw-normal mb-0 @if($task->estado == 1) text-decoration-line-through @endif">{{$task->texto}}</p>
                                </li>
                                @if(Carbon\Carbon::createFromFormat("d/m/Y", $task->data)->lt(now()->format("Y-m-d")) && $task->estado == 0)
                                <li class="list-group-item px-3 py-1 d-flex align-items-center border-0 bg-transparent">
                                    <div class="py-2 px-3 me-2 border border-warning rounded-3 d-flex align-items-center bg-light">
                                        <p class="small mb-0">
                                            <i class="fas fa-hourglass-half me-2 text-warning"></i>
                                            Tasca vencida
                                        </p>
                                    </div>
                                </li>
                                @endif
                                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                                    <div class="d-flex flex-row justify-content-end mb-1">
                                        <a href="{{route('tasks.edit', $task->id)}}" class="text-info" data-mdb-toggle="tooltip" title="Edit todo"><i
                                            class="fas fa-pencil-alt me-3"></i></a>
                                        <form action="{{route("tasks.destroy", $task->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="text-danger" style="border: 0;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="text-end text-muted">
                                        <p class="small mb-0"><i class="fas fa-info-circle me-2"></i>{{$task->data}}</p>
                                    </div>
                                </li>
                            </ul>
                        @endforeach                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection