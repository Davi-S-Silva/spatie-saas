<form action="{{ route('localapoio.store') }}" method="post">
    <fieldset {{ $disabled ? 'disabled' : '' }}>

        <div>
            <label for="">Nome</label>
            <input type="text" name="name" id="">
        </div>
        <div>
            <label for="">Descrição</label>
            <input type="text" name="description" id="">
        </div>

        <x-select-empresa/>
        @csrf

        @if (!$disabled)
            <input type="submit" value="Salvar" class="btn btn-primary mt-2">
        @endif
    </fieldset>
</form>
