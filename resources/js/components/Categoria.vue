<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!--Inicio do card de listagem dos lançamentos-->
                <card-component titulo="Relação de categorias">
                    <template v-slot:conteudo>

                    </template>
                    <template v-slot:rodape>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLancamento">Adicionar</button>
                        </div>
                    </template>
                </card-component>
                <!--Fim do card de listagem dos lançamentos-->
            </div>
        </div>
        <!--Início do modal de adiconar lançamentos-->
        <modal-component id="modalLancamento" titulo="Adicionar lançamento">
            <template v-slot:alertas>
            </template>
            <template v-slot:conteudo>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>
        <!--Fim do modal de adiconar lançamentos-->

        <!--Inicio do modal de vizualização lançamentos-->
        <modal-component id="modalLancamentoVisualizar" titulo="Visualizar lançamento">
            <template v-slot:alertas>

            </template>
            <template v-slot:conteudo>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!--Fim do mocal de vizualização lançamentos-->

        <!--Inicio do modal de remoção lançamentos-->
        <modal-component id="modalLancamentoRemover" titulo="Excluir lançamento">
            <template v-slot:alertas>
            </template>
            <template v-slot:conteudo>

            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-danger">Remover</button>
                <button type="button" class="btn btn-secondary">Fechar</button>
            </template>
        </modal-component>
        <!--Fim do modal de remoção lançamentos-->

        <!--Início do modal de atualização lançamentos-->
        <modal-component id="modalLancamentoAtualizar" titulo="Atualizar lançamento">
            <template v-slot:alertas>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Descrição" id="atualizarDescricao" id-help="atualizarDescricaoHelp" texto-ajuda="Informe a descrição.">
                    </input-container-component>

                </div>
                <div class="form-group">
                    <input-container-component titulo="Valor" id="atualizarValor" id-help="atualizarValorHelp" texto-ajuda="Informe o valor.">
                    </input-container-component>

                </div>
                <div class="form-group">
                    <input-container-component titulo="Data de vencimento" id="atualizarDataVencimento" id-help="atualizarDataVencimentohelp" texto-ajuda="Informe a data de vencimento.">
                    </input-container-component>

                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary">Fechar</button>
                <button type="button" class="btn btn-primary">Atualizar</button>
            </template>
        </modal-component>
        <!--Fim do modal de adiconar lançamentos-->
    </div>
</template>

<script>

</script>
