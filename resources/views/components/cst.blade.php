<label for="" class="form-label">CST/CSOSN ICMS</label>
<select name="Cst" id="" {{ (isset($required))?'required':'' }} class="form-control border-black">
    <option value="">Selecione o CST</option>
    @foreach ($cst as $tipo)
        <option value="{{ $tipo->id }}">{{ $tipo->codigo }} - {{ $tipo->descricao }}</option>
    @endforeach
</select>
