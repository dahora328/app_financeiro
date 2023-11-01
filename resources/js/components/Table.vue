<template>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col"></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td >
                    <span></span>
                    <span></span>
                    <span></span>
                </td>
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
