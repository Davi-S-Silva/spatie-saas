<div>
    <form action="" name="StartEntrega" class="form_toggle_entrega" method="post">
        <legend>Iniciar entrega <span></span></legend>
        {{-- <div class="col-12">
            <x-select-colaborador :funcao=1/>
        </div> --}}
        <div>
            <label for="">Km Inicial</label>
            <input type="text" required name="KmInicial">
        </div>
        <input type="hidden" name="Entrega">
        @csrf
        <input type="submit" class="btn btn-primary" value="Salvar">
    </form>
</div>
