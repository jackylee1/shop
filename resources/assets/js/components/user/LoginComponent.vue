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
        data() {
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
            'userdata.email'(newVal, oldVal) {
                this.errors.email.status = false;
            },
            'userdata.password'(newVal, oldVal) {
                this.errors.password.status = false;
            }
        },
        methods: {
            login() {
                axios.post('/login', this.userdata).then((response) => {
                    console.log(response);
                }).catch((error) => {
                    var errors = error.response;
                    console.log(errors);
                    if(errors.statusText == "Unprocessable Entity" || errors.status == 422) {
                        console.log(errors.status);
                        if(errors.data.errors) {
                            if(errors.data.errors.email) {
                                this.errors.email.status = true;
                                this.errors.email.message = _.isArray(errors.data.errors.email) ? errors.data.errors.email[0] : errors.data.errors.email;
                            }
                            if(errors.data.errors.password) {
                                this.errors.password.status = true;
                                this.errors.password.message = _.isArray(errors.data.errors.password) ? errors.data.errors.password[0] : errors.data.errors.password;
                            }
                        }
                    }
                });
            }
        },
    }
</script>