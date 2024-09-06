<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ctes', function (Blueprint $table) {
            $table->id();
            $table->integer('modelo');//modelo do cte 57 - 56
            $table->integer('numero');//numero do cte atual
            $table->string('versao');//versao do xml 4.00
            $table->foreignId('cfop_id')->references('id')->on('cfops');
            $table->text('natureza');// Natureza da operacao
            $table->integer('tipo_impressao');// Formato de impressao do DACTE: 1-Retrato; 2-Paisagem.
            $table->integer('tipo_emissao');// Forma de emissao do CTe: 1-Normal; 4-EPEC pela SVC; 5-Contingência
            $table->integer('cdv'); // Codigo verificador
            $table->integer('cct');// Codigo numerico que compoe a chave de acesso
            $table->integer('ambiente');//1 - producao; 2 - homologacao
            $table->integer('tipo_cte');//0- CT-e Normal; 1 - CT-e de Complemento de Valores; 3 - CTe de Substituição
            $table->integer('proc_emi');//0- CT-e Normal; 1 - CT-e de Complemento de Valores; 3 - CTe de Substituição
            $table->integer('versao_emissor');//versao do aplicativo emissor
            $table->string('modal');//Preencher com:01-Rodoviário; 02-Aéreo; 03-Aquaviário;04-
            $table->boolean('globalizado');//globalizado = true/false
            $table->integer('tipo_servico');//0- Normal; 1- Subcontratação; 2- Redespacho; 3- Redespacho Intermediário; 4- Serviço Vinculado a Multimodal
            $table->foreignId('remetente_id')->references('id')->on('filials');//remetente
            $table->foreignId('destinatario_id')->references('id')->on('destinatarios');//destinatario
            $table->foreignId('empresa_id')->references('id')->on('empresas');//emitente
            $table->foreignId('cidade_inicio_id')->references('id')->on('municipios');
            $table->foreignId('cidade_fim_id')->references('id')->on('municipios');
            $table->integer('retira');//Indicador se o Recebedor retira no Aeroporto; Filial, Porto ou Estação de Destino? 0-sim; 1-não
            $table->text('det_retira')->nullable();//detalhes da retirada
            $table->integer('ind_ie_toma');//indica inscricao estadual do tomador
            $table->dateTime('data_hora_cont')->nullable();
            $table->text('justificativa_cont')->nullable();
            $table->integer('tomador');//Tomador do servico
            $table->double('valor_total');
            $table->double('valor_receber');
            // $table->double('valor_aproximado_tributo');
            $table->string('rntrc')->nullable();
            $table->foreignId('cst_id')->references('id')->on('csts');
            $table->double('p_red_bc')->nullable();// Percentual de redução da BC (3 inteiros e 2 decimais)
            $table->double('v_bc');
            $table->integer('p_icms');
            $table->double('v_icms');
            $table->double('v_bc_icms_ret')->nullable(); // Valor do ICMS ST retido
            $table->double('v_icms_ret')->nullable(); // Valor do ICMS ST retido
            $table->double('p_icms_ret')->nullable();// Alíquota do ICMS
            $table->double('v_cred')->nullable();// Valor do Crédito Outorgado/Presumido
            $table->double('v_total_tributos')->nullable();// Valor de tributos federais; estaduais e municipais
            $table->boolean('outra_uf')->default(false);
            $table->double('v_icms_uf_ini')->nullable();// Valor icms uf inicial
            $table->double('v_icms_uf_fim')->nullable();// Valor icms uf final
            $table->text('info_fisco')->nullable();
            $table->foreignId('carga_id')->references('id')->on('cargas');
            $table->string('produto_predominante');
            $table->string('outras_caracteristicas');
            $table->double('v_carga_averb')->nullable();
            $table->text('x_obs');
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants');
            $table->foreignId('usuario_id')->references('id')->on('users');
            $table->foreignId('status_id')->references('id')->on('status');
            $table->date('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctes');
    }
};
