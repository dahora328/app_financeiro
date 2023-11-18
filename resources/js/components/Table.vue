<template>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" v-for="titulo, key in titulos" :key="key">{{titulo.titulo}}</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">{{valor}}</span>
                        <span v-if="titulos[chaveValor].tipo == 'float'">{{valor}}</span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">{{valor}}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style>

</style>
<script>
    export default {
        props: ['dados', 'titulos', 'atualizar', 'remover', 'vizualizar'],
        computed: {
            dadosFiltrados(){

                let campos = Object.keys(this.titulos)
                let dadosFiltrados = []

                this.dados.map((item, chave) =>{


                    let itemFiltrado = {}
                    campos.forEach(campo => {
                        itemFiltrado[campo] = item[campo]
                    })
                    dadosFiltrados.push(itemFiltrado)
                })

                return dadosFiltrados //retorna um array de objetos
            }
        }
    }
</script>
