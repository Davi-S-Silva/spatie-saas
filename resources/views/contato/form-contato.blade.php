{{-- <form action="" method="post"> --}}
<div class="form-contato col-12 border p-2">
    {{-- <legend>Contato</legend> --}}
    <div>
        <label for="" class="form-label">Celular</label>
        <input type="tel" class="form-control border-black rounded" name="Telefone" id="" value="{{ !empty($contato) ? $contato->telefone : '' }}">
    </div>
    <div>
        <label for="" class="form-label">WhatsApp</label>
        <input type="tel" class="form-control border-black rounded" name="WhatsApp" id="" value="{{ !empty($contato) ? $contato->whatsapp : '' }}">
    </div>
    <div>
        <label for="" class="form-label">Email</label>
        <input type="email" class="form-control border-black rounded" name="Email" id="" value="{{ !empty($contato) ? $contato->email : '' }}">
    </div>
    <div>
        <label for="" class="form-label">Descrição</label>
        <textarea name="Descricao" class="form-control border-black rounded" id="">{{ !empty($contato) ? $contato->descricao : '' }}</textarea>
    </div>
</div>
{{-- </form> --}}
