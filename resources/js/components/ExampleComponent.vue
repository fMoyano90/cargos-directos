<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Componente de ejemplo desde Vue</div>

                    <div class="card-body">
                        Soy un componente ejemplo
                        <p>{{ texto }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return{
                texto: 'Hola mundo desde el componente!',
            }
        }
    }
</script>
