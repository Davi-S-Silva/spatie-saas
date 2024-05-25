<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificado Digital') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="max-w-7xl mx-auto px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card col-12 p-2">
                    <label class="font-bold">Configurar Certificado digital</label>

                    <form method="POST" name="FormCertificado" enctype="multipart/form-data">
                        <div class="flex flex-wrap justify-between">
                        <div class="col-3">
                            <label for="">Carregar Certificado</label>
                            <input type="file" class="form-control" name="Certificado" id="" max="1">
                        </div>
                        @csrf
                        <div class="col-3">
                            <label for="">Senha do Certificado</label>
                            <input type="password" class="form-control" name="SenhaCertificado" id="">
                        </div>
                        <div class="col-3">
                            <label for="">Validade do Certificado</label>
                            <input type="date" class="form-control" name="ValidadeCertificado" id="">
                        </div>

                        <x-select-empresa/>

                        </div>
                        <input type="submit" value="Carregar" class="btn btn-primary my-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
