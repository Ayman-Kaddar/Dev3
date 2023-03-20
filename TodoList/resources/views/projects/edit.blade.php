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
                            <u>PROJECTS</u>
                        </p>
                        <div class="pb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="">
                                        <form action="{{route("projects.update", $project->id)}}" method="POST" class="d-flex flex-row align-items-center gap-3">
                                            @csrf
                                            @method("put")
                                            <input type="text" class="form-control form-control-lg" name="name"
                                                placeholder="Nom del proyecto..." value="{{$project->name}}">
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
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection