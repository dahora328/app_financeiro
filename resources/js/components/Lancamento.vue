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
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID" v-model="busca.id">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Descricao" id="inputDescricao" id-help="descricaoHelp" texto-ajuda="Opcional. Informe a descrição.">
                                    <input type="text" class="form-control" id="inputDescricao" aria-describedby="descricaoHelp" placeholder="Descrição" v-model="busca.descricao">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm me-md-2" @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!--Fim do card de busca-->

                <!--Inicio do card de listagem dos lançamentos-->
                <card-component titulo="Relação de lançamentos">

                    <template v-slot:conteudo>
                        <table-component
                            :visualizar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalLancamentoVisualizar'}"
                            :atualizar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalLancamentoAtualizar'}"
                            :remover="{visivel: true, dataToggle: 'modal', dataTarget: '#modalLancamentoRemover'}"
                            :titulos="{
                            id: {titulo: 'ID', tipo: 'texto'},
                            descricao: {titulo: 'Descrição', tipo: 'texto'},
                            valor: {titulo: 'Valor', tipo: 'float'},
                            data: {titulo: 'Data Vencimento', tipo: 'data'},
                            categoria_id: {}
                        }" :dados="lancamentos.data"></table-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="col">
                            <paginate-componet>
                                <li v-for="objPagina, key in lancamentos.links" :key="key" :class="objPagina.active ? 'page-item active' : 'page-item'" @click="paginacao(objPagina)">
                                    <a class="page-link" v-html="objPagina.label"></a>
                                </li>
                            </paginate-componet>
                        </div>

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
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar o lançamento" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Descrição" id="novaDescricao" id-help="novaDescricaoHelp" texto-ajuda="Informe a descrição.">
                        <input type="text" class="form-control" id="novaDescricao" aria-describedby="novaDescricaoHelp" placeholder="Descrição" v-model="descricaoLancamento">
                    </input-container-component>
                    {{descricaoLancamento}}
                </div>
                <div class="form-group">
                    <input-container-component titulo="Valor" id="novoValor" id-help="novoValorHelp" texto-ajuda="Informe o valor.">
                        <input type="text" class="form-control" id="novoValor" aria-describedby="novoValorHelp" placeholder="Valor" v-model="valorLancamento">
                    </input-container-component>
                    {{valorLancamento}}
                </div>
                <div class="form-group">
                    <input-container-component titulo="Data de vencimento" id="novaDataVencimento" id-help="novaDataVencimentohelp" texto-ajuda="Informe a data de vencimento.">
                        <input type="date" class="form-control" id="novaDataVencimento" aria-describedby="novaDataVencimentohelp" placeholder="Data de vencimento" v-model="dataVencimentoLancamento">
                    </input-container-component>
                    {{dataVencimentoLancamento}}
                </div>
                <div class="form-group">
                    <input-container-component titulo="Categoria" id="novaCategoria" id-help="novaCategoriaHelp" texto-ajuda="Informe a categoria.">
                        <input type="text" class="form-control" id="novaCategoria" aria-describedby="novaCategoriaHelp" placeholder="Categoria" v-model="categoria_id">
                    </input-container-component>
                    {{categoria_id}}
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
            </template>
        </modal-component>
        <!--Fim do modal de adiconar lançamentos-->

        <!--Inicio do modal de vizualização lançamentos-->
        <modal-component id="modalLancamentoVisualizar" titulo="Visualizar lançamento">
            <template v-slot:alertas>

            </template>
            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>
                <input-container-component titulo="Descrição">
                    <input type="text" class="form-control" :value="$store.state.item.descricao" disabled>
                </input-container-component>
                <input-container-component titulo="Data vencimento">
                    <input type="text" class="form-control" :value="$store.state.item.data" disabled>
                </input-container-component>
                <input-container-component titulo="Categoria">
                    <input type="text" class="form-control" :value="$store.state.item.categoria_id" disabled>
                </input-container-component>

            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!--Fim do mocal de vizualização lançamentos-->

        <!--Inicio do modal de remoção lançamentos-->
        <modal-component id="modalLancamentoRemover" titulo="Excluir lançamento">
            <template v-slot:alertas>
                <alert-component tipo="success" titulo="Transacao realizada com sucesso" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'sucesso'"></alert-component>
                <alert-component tipo="danger" titulo="Erro na transação" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>
                <input-container-component titulo="Descrição">
                    <input type="text" class="form-control" :value="$store.state.item.descricao" disabled>
                </input-container-component>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-danger" @click="remover()" v-if="$store.state.transacao.status != 'sucesso'">Remover</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!--Fim do modal de remoção lançamentos-->

        <!--Início do modal de atualização lançamentos-->
        <modal-component id="modalLancamentoAtualizar" titulo="Atualizar lançamento">
            <template v-slot:alertas>
                <alert-component tipo="success" titulo="Transacao realizada com sucesso" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status === 'sucesso'"></alert-component>
                <alert-component tipo="danger" titulo="Erro na transação" :detalhes="$store.state.transacao" v-if="$store.state.transacao.status === 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Descrição" id="atualizarDescricao" id-help="atualizarDescricaoHelp" texto-ajuda="Informe a descrição.">
                        <input type="text" class="form-control" id="atualizarDescricao" aria-describedby="atualizarDescricaoHelp" placeholder="Descrição" v-model="$store.state.item.descricao">
                    </input-container-component>

                </div>
                <div class="form-group">
                    <input-container-component titulo="Valor" id="atualizarValor" id-help="atualizarValorHelp" texto-ajuda="Informe o valor.">
                        <input type="text" class="form-control" id="atualizarValor" aria-describedby="atualizarValorHelp" placeholder="Valor" v-model="$store.state.item.valor">
                    </input-container-component>

                </div>
                <div class="form-group">
                    <input-container-component titulo="Data de vencimento" id="atualizarDataVencimento" id-help="atualizarDataVencimentohelp" texto-ajuda="Informe a data de vencimento.">
                        <input type="date" class="form-control" id="atualizarDataVencimento" aria-describedby="atualizarDataVencimentohelp" placeholder="Data de vencimento" v-model="$store.state.item.data">
                    </input-container-component>

                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="atualizar()">Atualizar</button>
            </template>
        </modal-component>
        <!--Fim do modal de adiconar lançamentos-->
    </div>
</template>

<script>
    import axios from "axios";
    import data from "bootstrap/js/src/dom/data.js";

    export default {
        data(){
            return{
                urlBase: 'http://localhost/api/v1/lancamento',
                urlPaginacao: '',
                urlFiltro: '',
                descricaoLancamento: '',
                valorLancamento: '',
                dataVencimentoLancamento: '',
                categoria_id: '',
                user_id: '',
                transacaoStatus: '',
                transacaoDetalhes: {},
                lancamentos: { data: [] },
                busca: { id: '', descricao: ''}
            }
        },
        methods: {
            atualizar(){

                let formData = new FormData();
                formData.append('_method', 'patch')
                formData.append('descricao', this.$store.state.item.descricao)
                formData.append('valor', this.$store.state.item.valor)
                formData.append('data', this.$store.state.item.data)

                let url = this.urlBase + '/' + this.$store.state.item.id

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data', //form tipo equivalente ao  form-data do postman
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        console.log('Atualizado', response)
                        this.$store.state.transacao.status = 'sucesso'
                        this.$store.state.transacao.mensagem = 'Registro de lançamento atualizado com sucesso!'
                        this.carregarLista()
                    })
                    .catch(errors => {
                        console.log('Erro na atualização', errors.response)
                        this.$store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.message
                        this.$store.state.transacao.dados = errors.response.data.errors

                    })
            },
            remover(){
                let confirmacao = confirm('Deseja realmente remover esse registro?')

                if (!confirmacao){
                    return false
                }

                let formData = new FormData();
                formData.append('_method', 'delete')

                let url = this.urlBase + '/' + this.$store.state.item.id

                axios.post(url, formData)
                    .then(response => {
                        this.$store.state.transacao.status = 'sucesso'
                        this.$store.state.transacao.mensagem = response.data.msg
                        this.carregarLista()
                    })
                    .catch(errors => {
                        this.$store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.erro
                    })
            },
            pesquisar(){

                let filtro = ''

                for(let chave in this.busca){

                    if(this.busca[chave]){

                        if(filtro !== ''){
                            filtro += ';'
                        }
                        filtro += chave + ':like:' + '%' + this.busca[chave] + '%'
                    }
                }
                if(filtro !== ''){
                    this.urlPaginacao = 'page=1'
                    this.urlFiltro = '&filtro=' + filtro
                }else{
                    this.urlFiltro = ''
                }
                this.carregarLista()
            },
            paginacao(objPagina){
                if(objPagina.url){
                    //this.urlBase = objPagina.url ajustando a url com parametro de paginação
                    this.urlPaginacao = objPagina.url.split('?')[1] //pega o indice 1 do array da url
                    this.carregarLista()
                }
            },
            carregarLista(){
                let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro

                axios.get(url)
                    .then(response => {
                        this.lancamentos = response.data
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            },
            salvar(){
                console.log(this.descricaoLancamento, this.valorLancamento, this.dataVencimentoLancamento)

                let formData = new FormData();

                formData.append('descricao', this.descricaoLancamento)
                formData.append('valor', this.valorLancamento)
                formData.append('data', this.dataVencimentoLancamento)
                formData.append('categoria_id', this.categoria_id)

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data', //form tipo equivalente ao form-data do postman
                    }
                }
                console.log(this.urlBase, formData, config)
                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                    })
                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }

                    })
            }
        },
        mounted() {
            this.carregarLista()
        }

    }
</script>
