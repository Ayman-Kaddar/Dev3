@extends("template.template")

@section("content")

    <div class="container mt-3 d-none">
        <div class="row text-center">
            <div class="col-md-8">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="text" name="texto" id="" value="{{$task->texto}}">
                    <input type="date" name="data" id="" value="{{$task->data}}">
                    <select name="project_id">
                        <option value="" disabled>Seleciona un proyecto</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" @if($project->id == $task->project->id) selected @endif>{{$project->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit">
                </form>
                @if($errors->any)
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center mt-5 h-100">
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
                                            <form action="{{route("tasks.update", $task->id)}}" method="POST" class="d-flex flex-row align-items-center gap-3">
                                                @csrf
                                                @method("PUT")
                                                <input type="text" class="form-control form-control-lg" name="texto"
                                                    placeholder="Nom de la tasca..." 
                                                    value="{{$task->texto}}"
                                                >
                                                <input type="date" class="form-control form-control-lg" 
                                                    name="data" 
                                                    value="{{$task->data}}"
                                                >
                                                <select class="form-select" name="project_id">
                                                    <option value="" selected disabled>Seleciona un proyecto</option>
                                                    @foreach($projects as $project)
                                                        <option 
                                                            value="{{ $project->id }}" 
                                                            @if($project->id == $task->project->id) selected @endif
                                                        >
                                                            {{$project->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div>
                                                    <button type="submit" class="btn btn-primary">MODIFICAR</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection