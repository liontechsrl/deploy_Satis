@extends('layouts.plantillaEstudiante')
<title>Registro funda empresa TIS</title>

          @section('cuerpo')
          {{ Breadcrumbs::render('estudiante.fundaempresa') }}
        <div class="container mt-5 formulario">
          <div class="formCyA ">
            <h1 Style="text-align: center;">FUNDA EMPRESA</h1>
            @if(Session::get('success'))
             <div class="alert alert-success">
                {{ Session::get('success') }}
             </div>
            @endif
            @if(Session::get('fail'))
             <div class="alert alert-danger">
                {{ Session::get('fail') }}
             </div>
            @endif
          <form
          id="funda" class="row g-3" method="post" action="{{ route('auth.save3') }}" enctype="multipart/form-data">
            
            @csrf
            <div class="col-md-6 ">
              <label for="nombreC" class="form-label">Nombre corto*</label>
              <input type="text" class="form-control" name="nombreC" required>
              <span class="text-danger">@error('nombreC'){{ $message }} @enderror</span>
            </div>
            <div class="col-md-6">
              <label for="nombreL" class="form-label">Nombre Largo*</label>
              <input type="text" class="form-control" name="nombreL" required>
              <span class="text-danger">@error('nombreL'){{ $message }} @enderror</span>
            </div>
   
            <div class="col-md-6">
                <label for="integrantes" class="form-label">Integrantes</label>
                <table name="integrantes">
                    <tr>
                            <th class="text-center">Seleccionar</th>
                            <th class="text-center">Nombre</th>
                    </tr>
                    
                    @foreach($data as $key=>$item)
                        
                        <tr>
                            <td align="center">
                                <input type="checkbox" name="seleccion[]" value="{{$key}}">
                            </td>
                            <td>
                                {{$item->nombre}}
                                <input type="hidden" name="nombre[]" value="{{$item->nombre}}">
                            </td>
                        </tr>
                    @endforeach
                    
                </table>
            </div>
            <!--<div class="col-md-12">
              <label for="integrantes" class="form-label">Integrantes</label>
              <textarea rows="6" cols="60" class="form-control" name="integrantes" form="funda"
              placeholder="1.Integrante1&#10;2.Integrante2&#10;3.Integrante3&#10;4.Integrante4&#10;5.Integrante5&#10;"></textarea>
              <span class="text-danger">@error('integrantes'){{ $message }} @enderror</span>
            </div>-->
          
            <div class="col-md-12">
              <label for="representante" class="form-label">Representante Legal</label>
              <input type="text" class="form-control" name="representante" >
              <span class="text-danger">@error('representante'){{ $message }} @enderror</span>
            </div>
            <div class="col-md-12">
              <label for="correo" class="form-label">Correo de la empresa</label>
              <input type="email" class="form-control" name="correo" >
              <span class="text-danger">@error('correo'){{ $message }} @enderror</span>
            </div>
            <div class="col-md-12">
              <label for="telefono" class="form-label">Telefono de la empresa</label>
              <input type="text" class="form-control" name="telefono" >
              <span class="text-danger">@error('telefono'){{ $message }} @enderror</span>
            </div>
            <div class="col-md-12">
              <label for="direccion" class="form-label">Direccion de la empresa</label>
              <input type="text" class="form-control" name="direccion" >
              <span class="text-danger">@error('direccion'){{ $message }} @enderror</span>
            </div>
            <div class="col-md-12">Los campos con (*) son obligatorios</div>
            <div class="col-md-6 d-flex justify-content-between ">
              <button type="submit" class="btn btn-primary" style="background-color: #215f88;">Registrar</button>              
            </div>
         
          </form>
        </div>
      
      </div>
    </div>
    @endsection
