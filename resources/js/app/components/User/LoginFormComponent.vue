<template>
    <div class="container">
        <form class="form-signin" @submit.prevent="login">
            <h1 class="h3 mb-3 font-weight-normal">Вход в личный кабинет</h1>
            <div class="input-group">
                <label class="sr-only">Email адрес</label>
                <input type="email" name="email" v-bind:class="{ 'is-invalid': errors.email.status, 'form-control': true }" placeholder="Email адрес" v-model="userdata.email" required autofocus>
                <div class="invalid-tooltip">
                    {{ errors.email.message }}
                </div>
            </div>
            <div class="input-group">
                <label class="sr-only">Пароль</label>
                <input type="password" name="password" v-bind:class="{ 'is-invalid': errors.password.status, 'form-control': true }" placeholder="Пароль" v-model="userdata.password" required>
                <div class="invalid-tooltip">
                    {{ errors.password.message }}
                </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" v-model="userdata.remember"> Запомнить меня
                </label>
            </div>
            <a href="/user/register" class="btn btn-link btn-block">Еще не зарегестрированы?</a>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                status: false,
                userdata: {
                    email: undefined,
                    password: undefined,
                    remember: undefined,
                },
                errors: {
                    password: {
                        status: false,
                        message: undefined,
                    },
                    email: {
                        status: false,
                        message: undefined,
                    }
                }
            }
        },

        watch: {
            "userdata.email": function(newVal, oldVal) {
                this.errors.email.status = false;
            },
            "userdata.password": function(newVal, oldVal) {
                this.errors.password.status = false;
            }
        },

        methods: {
            login() {
                axios.post(location.pathname, this.userdata).then((response) => {
                    location.href = "/";
                }).catch(({response}) => {
                    if(response.statusText == "Unprocessable Entity" || response.status == 422) {
                        if(response.data.errors) {
                            this.errors = response.data.errors;
                        }
                    }
                });
            }
        },
    }
</script>