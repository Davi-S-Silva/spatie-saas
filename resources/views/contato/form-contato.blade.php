{{-- <form action="" method="post"> --}}
<div class="form-contato">
    <div>
        <label for="">Celular</label>
        <input type="tel" name="Telefone" id="" value="{{ !empty($contato) ? $contato->celular : '' }}">
    </div>
    <div>
        <label for="">WhatsApp</label>
        <input type="tel" name="WhatsApp" id="" value="{{ !empty($contato) ? $contato->whatsapp : '' }}">
    </div>
    <div>
        <label for="">Email</label>
        <input type="email" name="Email" id="" value="{{ !empty($contato) ? $contato->email : '' }}">
    </div>
    <div>
        <label for="">Descrição</label>
        <textarea name="Descricao" id="">{{ !empty($contato) ? $contato->descricao : '' }}</textarea>
    </div>
</div>
{{-- </form> --}}
