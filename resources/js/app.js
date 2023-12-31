/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import Login from './components/Login.vue';
import Home from './components/Home.vue';
import Lancamento from './components/Lancamento.vue';
import Table from './components/Table.vue';
import InputContainer from './components/InputContainer.vue';
import Card from './components/Card.vue';
import Modal from './components/Modal.vue';
import Alert from './components/Alert.vue';
import Paginate from "./components/Paginate.vue";
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});


/* Importação e configuração do Vuex */

import { createStore } from 'Vuex'
const store = createStore({
    state: {
        item: {},
        transacao: {
            status: '',
            mensagem: '',
            dados: ''
        }
    }
})
app.use(store)


app.config.globalProperties.$filters = {
    formataDataTempo(d) {
        if (!d) return "";

        d = d.split("T")
        let data = d[0]
        data = data.split("-")
        data = data[2] + "/" + data[1] + "/" + data[0];

        return data
    },
}

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);
app.component('login-component', Login);
app.component('home-component', Home);
app.component('lancamento-component', Lancamento);
app.component('table-component', Table);
app.component('input-container-component', InputContainer);
app.component('card-component', Card);
app.component('modal-component', Modal);
app.component('alert-component', Alert);
app.component('paginate-componet', Paginate);




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
