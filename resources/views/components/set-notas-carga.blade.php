<section class="d-flex justify-center">
    <form action="" class="form_add_notas" method="post">
        <header><a href="">X</a></header>
        <div>
            <legend>Form Add Notas</legend>
            <textarea class="textarea_notas" name="Notas" id="" cols="60" rows="10"></textarea>
        </div>
        @csrf
        <input type="submit" value="Inserir" class="btn btn-primary">
    </form>
</section>
