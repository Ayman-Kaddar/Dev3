@extends("template.template")

@section("content")

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center mt-3 h-100">
            <div class="col">
                <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                    <div class="card-body py-4 px-4 px-md-5">
                        <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                            <i class="fas fa-check-square me-1"></i>
                            <u>CATEGORIA</u>
                        </p>
                        <div class="pb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="">
                                        <form action="{{route("projects.store")}}" method="POST" class="d-flex flex-row align-items-center gap-3">
                                            @csrf
                                            <input type="text" class="form-control form-control-lg" name="name"
                                                placeholder="Nom de la categoria...">
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
                        @foreach($projects as $project)
                            <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                                <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                                    <p class="lead fw-normal mb-0">{{$project->name}}</p>
                                </li>
                                <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                                    <div class="d-flex flex-row justify-content-end mb-1">
                                        <a href="{{route('projects.edit', $project->id)}}" class="text-info" data-mdb-toggle="tooltip" title="Edit todo"><i
                                            class="fas fa-pencil-alt me-3"></i></a>
                                        <form action="{{route("projects.destroy", $project->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="text-danger" style="border: 0;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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