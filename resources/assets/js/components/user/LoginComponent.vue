<template>
    <div>
        <a href="#" class="btn btn-default" @click="login">Login</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                status: false,
            }
        },
        methods: {
            login() {
                axios.post('/login', {
                    email: "maks.best5@mail.ru",
                    password: "maksa988",
                    remember: true
                }).then((response) => {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
    }
</script>