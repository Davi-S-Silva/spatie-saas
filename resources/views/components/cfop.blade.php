<label for="" class="form-label">CFOP</label>
<select name="Cfop" id="" {{ (isset($required))?'required':'' }} class="form-control border-black">
    <option value="">Selecione o CFOP</option>
    @foreach ($cfop as $tipo)
        <option value="{{ $tipo->id }}">{{ $tipo->codigo }} - {{ $tipo->descricao }}</option>
    @endforeach
</select>
