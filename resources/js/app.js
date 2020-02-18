/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import { from, of } from "rxjs";
import { distinct, take } from "rxjs/operators";
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "historial-component",
    require("./components/HistorialComponent.vue").default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: "#historial",
    mounted() {
        this.getCargos();
        this.fechaActual();
        this.porVencer();
    },
    data: {
        cargos: [],
        pagination: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0
        },
        fecha_actual: "",
        por_vencer: ""
    },
    computed: {
        isActived() {
            return this.pagination.current_page;
        },
        pagesNumber() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - 10;
            if (from < 1) {
                from = 1;
            }

            var to = from + 10 * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        getCargos(page) {
            axios
                .get(
                    "http://localhost/cargos-directos-laravel/public/api/historial?page=" +
                        page
                )
                .then(res => {
                    let sinRepetidos = [...new Set(res.data.cargos.data)];

                    (this.cargos = sinRepetidos),
                        (this.pagination = res.data.pagination);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        changePage(page) {
            this.pagination.current_page = page;
            this.getCargos(page);
        },
        fechaActual() {
            var f = new Date();
            var year = f.getFullYear();
            var mes = ("0" + (f.getMonth() + 1)).slice(-2);
            var dia = f.getDate();
            return (this.fecha_actual = `${year}-${mes}-${dia}`);
        },
        porVencer() {
            var f = new Date();
            var year = f.getFullYear();
            var mes = ("0" + (f.getMonth() + 1)).slice(-2);
            var dia = f.getDate() + 5;

            return (this.por_vencer = `${year}-${mes}-${dia}`);
        }
    }
});

new Vue({
    el: "#pendientes",
    mounted() {
        this.getCargos();
        this.fechaActual();
        this.porVencer();
    },
    data: {
        cargos: [],
        pagination: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0
        },
        fecha_actual: "",
        por_vencer: ""
    },
    computed: {
        isActived() {
            return this.pagination.current_page;
        },
        pagesNumber() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - 10;
            if (from < 1) {
                from = 1;
            }

            var to = from + 10 * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        getCargos(page) {
            axios
                .get(
                    "http://localhost/cargos-directos-laravel/public/api/pendientes?page=" +
                        page
                )
                .then(res => {
                    (this.cargos = res.data.cargos.data),
                        (this.pagination = res.data.pagination);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        changePage(page) {
            this.pagination.current_page = page;
            this.getCargos(page);
        },
        fechaActual() {
            var f = new Date();
            var year = f.getFullYear();
            var mes = ("0" + (f.getMonth() + 1)).slice(-2);
            var dia = f.getDate();

            return (this.fecha_actual = `${year}-${mes}-${dia}`);
        },
        porVencer() {
            var f = new Date();
            var year = f.getFullYear();
            var mes = ("0" + (f.getMonth() + 1)).slice(-2);
            var dia = f.getDate() + 5;

            return (this.por_vencer = `${year}-${mes}-${dia}`);
        }
    }
});
