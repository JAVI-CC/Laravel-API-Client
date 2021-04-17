<div class="container">
    <form method="POST" action="{{ url("juegos/search") }}">
        @csrf 
        <div class="div-icons-bars-images">
          <i class="fas fa-bars icon-bars icon-bars-images"></i>
          <span style="margin-left: 25px;"></span>
          <div class="div-icon-images">
            <i class="fas fa-images icon-images icon-bars-images"></i>
          </div>
        </div>
        <div class="form-row align-items-center col-xs-12 div-form-search">
            <div class="col-auto my-1 div-input-buscar-mobile">
                <div class="div-input-buscar">
                    <input type="text" name="search" class="form-control input-search" value="@isset($search){{$search}}@endisset" placeholder="Buscar...">
                </div>
            </div>
            <div class="col-auto my-1 div-select-ord-mobile">
                <select name="order" class="custom-select mr-sm-4">
                    <option name="order" value="0" selected disabled>Ordenar por...</option>
                    <option name="order" value="1" @isset($order) @if($order == '1') selected @endif @endisset>Predeterminada</option>
                    <option name="order" value="2" @isset($order) @if($order == '2') selected @endif @endisset>Nombre (A-Z)</option>
                    <option name="order" value="3" @isset($order) @if($order == '3') selected @endif @endisset>Nombre (Z-A)</option>
                    <option name="order" value="4" @isset($order) @if($order == '4') selected @endif @endisset>Fecha ascendente</option>
                    <option name="order" value="5" @isset($order) @if($order == '5') selected @endif @endisset>Fecha descendente</option>
                </select>
            </div>
            <div class="col-auto my-1">
                <button type="submit" class="btn btn-primary" style="padding: 6px;"><i class="fas fa-search" style="font-size: 15px;"></i></button>
            </div>
        </div>
    </form>
</div>


@yield('search')