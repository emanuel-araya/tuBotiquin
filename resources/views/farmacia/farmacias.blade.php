@extends('welcome')
@section('titulo','Farmacias')

@section('contenido')
    <div class="container">
        <div class="card-body mb-2">
            <!-- Masthead Subheading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Farmacias</h2>
            <br>  
             <form method="POST" action="{{ route('buscarFarmaciaSucursal')}}">
                 @csrf                     
                    <div class="form-group">
                        <select id="id_farmacia" class="form-control  placeholder="Busque su farmacia aqui"
                                    name="id_farmacia" value="{{ old('localidad') }}"> 
                                    <option setect value="">Seleccione una Farmacia de esta lista</option>
                                    @foreach($arrayFarmacias as $farmacia)
                                        <option value="{{ $farmacia->id_farmacia }}"> {{ $farmacia->nombre_farmacia }}</option> 
                                    @endforeach   
                        </select> 
                                
                    </div>
                    <div class="form-group">
                        <div class="d-flex d-flex justify-content-center"> 
                            <button type="submit" class="btn btn-primary mr-1">
                                {{ __('Buscar') }}
                            </button>
                        </div>
                    </div>
            </form>
        </div>

    <div class="container">
        <div class="row">
            @foreach ($arrayFarmaciasPaginate as $farmaciaPaginate)
                @if ($farmaciaPaginate->habilitada == 1)
                    <div class="col-md-4">
                        <div class="shadow p-2 mb-4 bg-white rounded">          
                            <img class="card-img-top" src="../public/assets/img/health_1.svg" alt="Card image cap" width="600" height="250">
                                <div class="card-body">
                                    <h4 class="card-title"> {{ $farmaciaPaginate->nombre_farmacia }}</h4>
                                    <p class="card-text">{{ $farmaciaPaginate->descripcion_farmacia }}</p> 
                                    <hr>
                                    <a href="{{ route ('farmaciaSucursal', ['farmacia' => $farmaciaPaginate->id_farmacia ]) }}" class="btn btn-primary btn-sm">Ver sucursales</a>
                                </div>
                        </div>
                    </div> 
                 @endif             
            @endforeach
         </div>

         <!-- Pagination for 6 elements -->
         <div class="d-flex d-flex justify-content-center mt-4"> 
                 {{ $arrayFarmaciasPaginate->links() }}
         </div>
    </div>           
@endsection


                    