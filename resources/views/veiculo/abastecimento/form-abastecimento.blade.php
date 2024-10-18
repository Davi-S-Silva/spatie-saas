@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<fieldset>
    <div>
        <label for="" class="form-label">Cupom</label>
        <input type="number" name="Cupom" id="" class="form-control abast-cupom rounded" value="{{ old('Cupom') }}" required>
        {{-- @if ($errors->has('Cupom'))
        <div class="alert alert-danger error-cupom">
            {{ $errors->first('Cupom') }}
        </div>
        @endif --}}
        <div class="alert alert-danger error-cupom">error</div>
    </div>
    <div>
        <label for="" class="form-label">KM</label>
        <input type="text" name="Km" id="" class="form-control abast-km rounded" value="{{ old('Km') }}" required>
        {{-- @if ($errors->has('Km'))
        <div class="alert alert-danger">
            {{ $errors->first('Km') }}
        </div>
        @endif --}}
        <div class="alert alert-danger error-km">error</div>
    </div>
    <div>
        <label for="" class="form-label">Litros</label>
        <input type="text" name="Litro" id="" class="form-control abast-litros rounded" value="{{ old('Litro') }}" required>
        {{-- @if ($errors->has('Litro'))
        <div class="alert alert-danger">
            {{ $errors->first('Litro') }}
        </div>
        @endif --}}
        <div class="alert alert-danger error-litros">error</div>
    </div>
    <div>
        <label for="" class="form-label">Valor</label>
        <input type="text" name="Valor" id="" class="form-control abast-valor rounded" value="{{ old('Valor') }}" required>
        {{-- @if ($errors->has('Valor'))
        <div class="alert alert-danger">
            {{ $errors->first('Valor') }}
        </div>
        @endif --}}
        <div class="alert alert-danger error-valor">error</div>
    </div>
    <div>
        <x-select-fornecedor :fornecedores=$fornecedores/>
        {{-- @if ($errors->has('Fornecedor'))
        <div class="alert alert-danger">
            {{ $errors->first('Fornecedor') }}
        </div>
        @endif --}}
    </div>
    <div>
        <x-select-combustivel :required=true/>
        {{-- @if ($errors->has('Combustivel'))
        <div class="alert alert-danger">
            {{ $errors->first('Combustivel') }}
        </div>
        @endif --}}
    </div>

    @hasanyrole('super-admin|admin|tenant-admin|tenant-admin-master|tenant-user|user')
        <x-select-colaborador :funcao=null :required=true/>
        {{-- @if ($errors->has('colaborador'))
        <div class="alert alert-danger">
            {{ $errors->first('colaborador') }}
        </div>
        @endif --}}
        <x-select-veiculo :required=true/>
        {{-- @if ($errors->has('veiculo'))
        <div class="alert alert-danger">
            {{ $errors->first('veiculo') }}
        </div>
        @endif --}}
    @endhasanyrole

    <div id="AreaCameraAbastecimento" class="col-12 bg-white text-center">
        <video autoplay class="video_camera_abastecimento col-11 border"></video>
        <button class="btn btn-primary btn-tirar-foto" id="btnTirarFoto">Tirar Foto</button>
    </div>

    <div class="my-3 border-black border rounded text-center pt-2">
        {{-- <div>
            <label for="" class="form-label">Foto Cupom</label>
            <input type="file" name="FotoCupom" id="" class="form-control p-3" required>
        </div> --}}

        <section id="SectionAreaFotoCupom" class="col-12 d-flex flex-column">
            <label for="">Cupom</label>
            <i class="fa-solid fa-camera" id="CameraFotoCupom" name="Cupom"></i>
            <div id="AreaFotoCupom" class="col-12 overflow-hidden">
                <canvas id="CanvasCameraFotoCupom" class="d-none"></canvas>
                {{-- <a href="">teste</a> --}}
            </div>
        </section>
        {{-- @if ($errors->has('FotoCupom'))
        <div class="alert alert-danger">
            {{ $errors->first('FotoCupom') }}
        </div>
        @endif --}}
    </div>

    <div class="my-3 border border-black rounded text-center pt-2">
        {{-- <div>
            <label for="" class="form-label">Foto Bomba de Abastecimento</label>
            <input type="file" name="FotoBomba" id="" class="form-control p-3" required>
        </div> --}}
        {{-- @if ($errors->has('FotoBomba'))
        <div class="alert alert-danger">
            {{ $errors->first('FotoBomba') }}
        </div>
        @endif --}}
        <section id="SectionAreaFotoBomba" class="col-12 d-flex flex-column">
            <label for="">Bomba</label>
            <i class="fa-solid fa-camera" id="CameraFotoBomba" name="Bomba"></i>
            <div id="AreaFotoBomba" class="col-12 overflow-hidden">
                <canvas id="CanvasCameraFotoBomba" class="d-none"></canvas>
                {{-- <a href="">teste</a> --}}
            </div>
        </section>
    </div>

    <div class="my-3 border border-black rounded text-center pt-2">
        {{-- <div>
            <label for="" class="form-label">Foto Hodometro / Velocimetro</label>
            <input type="file" name="FotoHodometro" id="FotoHodometro" class="form-control p-3" required>
        </div> --}}
        {{-- @if ($errors->has('FotoHodometro'))
        <div class="alert alert-danger">
            {{ $errors->first('FotoHodometro') }}
        </div>
        @endif --}}
        <section id="SectionAreaFotoHodometro" class="col-12 d-flex flex-column">
            <label for="">Hodometro</label>
            <i class="fa-solid fa-camera" id="CameraFotoHodometro" name="Hodometro"></i>
            <div id="AreaFotoHodometro" class="col-12 overflow-hidden">
                <canvas id="CanvasCameraFotoHodometro" class="d-none"></canvas>
                {{-- <a href="">teste</a> --}}
            </div>
        </section>
    </div>

   {{-- @if (Auth::user()->colaborador()->count() != 0 && Auth::user()->colaborador()->first()->veiculo()->count() == 0)
   <x-select-veiculo/>
   @endif --}}


    <div class="text-center">
        @csrf
        <input type="submit" value="Salvar" class="btn btn-primary my-2 py-3 px-5">
    </div>
</fieldset>
