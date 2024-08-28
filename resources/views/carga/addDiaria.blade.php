<form action="{{ route('storeFormDiaria',['carga'=>$carga->id]) }}" name="FormDiariaCarga" class="text-center">
    @method('PUT')
    <label class="form-label">Diaria/Pernoite/Refrete</label>
    <div class="d-flex align-items-center justify-center">
        <input type="number" name="diaria" value="{{ $carga->diaria }}" class="col-4 text-center">
        <input type="submit" value="Salvar" class="btn btn-primary">
    </div>
    @csrf
</form>
