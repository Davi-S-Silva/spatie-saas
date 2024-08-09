<form action="{{ route('servico-manutencao.store') }}" name="FormAddServicoManutencao" method="post">
    <x-select-servico />
    <input type="hidden" name="Manutencao" value="{{ $manutencao }}">
    @csrf
    <input type="submit" value="Adicionar" class="btn btn-primary">
</form>
