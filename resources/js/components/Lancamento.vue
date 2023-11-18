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
                        <table-component
                            :titulos="{
                            id: {titulo: 'ID', tipo: 'texto'},
                            descricao:{titulo: 'Descrição', tipo: 'texto'},
                            valor: {titulo: 'Valor', tipo: 'float'},
                            data: {titulo: 'Data Vencimento', tipo: 'data'},

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
        <!--Início do card de adiconar lançamentos-->
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
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
            </template>
        </modal-component>
        <!--Fim do card de adiconar lançamentos-->
    </div>
</template>

<script>
    import axios from "axios";
    import {text} from "ionicons/icons";

    export default {
        data(){
            return{
                urlBase: 'http://localhost/api/v1/lancamento',
                descricaoLancamento: '',
                valorLancamento: '',
                dataVencimentoLancamento: '',
                transacaoStatus: '',
                transacaoDetalhes: {},
                lancamentos: { data: [] }
            }
        },
        computed:{
            token(){
                let token = document.cookie.split(';').find(indice => {
                    return indice.includes('token=')
                })

                token = token.split('=')[1] //retorna indice 1 do array ontem tem o token
                token = 'Bearer ' + token
                return token
            }
        },
        methods: {
            paginacao(objPagina){
                if(objPagina.url){
                    this.urlBase = objPagina.url //ajustando a url com parametro de paginação
                    this.carregarLsita()
                }
            },
            carregarLsita(){
                let config = {
                    headers: {
                        'Accept': 'application/json', //sempre o retorno vai ser um Json
                        'Authorization': this.token
                    }
                }
                axios.get(this.urlBase, config)
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

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data', //form tipo equivalente ao  form-data do postman
                        'Accept': 'application/json', //sempre o retorno vai ser um Json
                        'Authorization': this.token
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
            this.carregarLsita()
        }

    }
</script>
