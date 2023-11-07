<template>
    <div>
        <table class="table table-hover">

            <thead>
            <tr>
                <th scope="col" v-for="titulo, key in titulos" :key="key">{{titulo}}</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="lancamento in dados" :key="lancamento.id">
                    <th scope="row">{{lancamento.id}}</th>
                    <td>{{lancamento.descricao}}</td>
                    <td>{{lancamento.valor}}</td>
                    <td>{{lancamento.data}}</td>
                    <td>
                        <button>Vizualizar</button>
                        <button>Atualizar</button>
                        <button>Remover</button>
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
    }
</script>
