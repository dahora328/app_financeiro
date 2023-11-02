<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!--Inicio do card de busca-->
                <card-component titulo="Busca Lançamentos">
                    <template v-slot:conteudo>
                        <div class="row g-3">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp" texto-ajuda="Opcional. Informe o ID.">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Descricao" id="inputDescricao" id-help="descricaoHelp" texto-ajuda="Opcional. Informe a descrição.">
                                    <input type="text" class="form-control" id="inputDescricao" aria-describedby="descricaoHelp" placeholder="Descrição">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm me-md-2">Pesquisar</button>
                    </template>
                </card-component>
                <!--Fim do card de busca-->

                <!--Inicio do card de listagem dos lançamentos-->
                <card-component titulo="Relação de lançamentos">
                    <template v-slot:conteudo>
                        <table-component></table-component>
                    </template>
                    <template v-slot:rodape>
                        <button type="button" class="btn btn-primary btn-sm me-md-2" data-bs-toggle="modal" data-bs-target="#modalLancamento">Adicionar</button>
                    </template>
                </card-component>
                <!--Fim do card de listagem dos lançamentos-->
            </div>
        </div>
        <modal-component id="modalLancamento" titulo="Adicionar lançamento">
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Descricao" id="novaDescricao" id-help="novaDescricaoHelp" texto-ajuda="Informe a descrição.">
                        <input type="text" class="form-control" id="novaDescricao" aria-describedby="novaDescricaoHelp" placeholder="Descrição">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Valor" id="novoDescricao" id-help="novoValorHelp" texto-ajuda="Informe o valor.">
                        <input type="text" class="form-control" id="inputValor" aria-describedby="novoValorHelp" placeholder="Valor">
                    </input-container-component>
                </div>
                <div class="form-group">
                    <input-container-component titulo="Data de vencimento" id="novaDataVencimento" id-help="novaDataVencimentohelp" texto-ajuda="Informe a data de vencimento.">
                        <input type="date" class="form-control" id="inputDataVencimento" aria-describedby="novaDataVencimentohelp" placeholder="Data de vencimento">
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>

import {defineComponent} from "vue";
import InputContainerComponent from "@/components/InputContainer.vue";

export default defineComponent({
    components: {InputContainerComponent}
})
</script>
