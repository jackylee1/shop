<template>
    <div class="container">
        <form class="form-signup" @submit.prevent="register">
            <h1 class="h3 mb-3 font-weight-normal">Регистрация аккаунта</h1>
            <div class="input-group">
                <label class="sr-only">Имя</label>
                <input type="text" name="name" v-bind:class="{ 'is-invalid': errors.name.status, 'form-control': true }" placeholder="Имя" v-model="userdata.name" required autofocus>
                <div class="invalid-tooltip">
                    {{ errors.name.message }}
                </div>
            </div>
            <div class="input-group">
                <label class="sr-only">Фамилия</label>
                <input type="text" name="surname" v-bind:class="{ 'is-invalid': errors.surname.status, 'form-control': true }" placeholder="Фамилия" v-model="userdata.surname" required autofocus>
                <div class="invalid-tooltip">
                    {{ errors.surname.message }}
                </div>
            </div>
            <div class="input-group">
                <label class="sr-only">Email адрес</label>
                <input type="email" name="email" v-bind:class="{ 'is-invalid': errors.email.status, 'form-control': true }" placeholder="Email адрес" v-model="userdata.email" required autofocus>
                <div class="invalid-tooltip">
                    {{ errors.email.message }}
                </div>
            </div>
            <div class="input-group">
                <label class="sr-only">Пароль</label>
                <input type="password" name="password" class="form-control" placeholder="Пароль" v-model="userdata.password" required>
            </div>
            <div class="input-group">
                <label class="sr-only">Пароль</label>
                <input type="password" name="password_confirmation" v-bind:class="{ 'is-invalid': errors.password.status, 'form-control': true }" placeholder="Повторите пароль" v-model="userdata.password_confirmation" required>
                <div class="invalid-tooltip">
                    {{ errors.password.message }}
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегестрироваться</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                status: false,
                userdata: {
                    name: undefined,
                    surname: undefined,
                    email: undefined,
                    password: undefined,
                    password_confirmation: undefined,
                },
                errors: {
                    password: {
                        status: false,
                        message: undefined,
                    },
                    email: {
                        status: false,
                        message: undefined,
                    },
                    name: {
                        status: false,
                        message: undefined,
                    },
                    surname: {
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
            },
            'userdata.password_confirmation'(newVal, oldVal) {
                this.errors.password.status = false;
            },
            'userdata.name'(newVal, oldVal) {
                this.errors.name.status = false;
            },
            'userdata.surname'(newVal, oldVal) {
                this.errors.surname.status = false;
            }
        },
        methods: {
            register() {
                axios.post('/register', this.userdata).then((response) => {
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
                            if(errors.data.errors.name) {
                                this.errors.name.status = true;
                                this.errors.name.message = _.isArray(errors.data.errors.name) ? errors.data.errors.name[0] : errors.data.errors.name;
                            }
                        }
                    }
                });
            }
        },
    }
</script>

<style>
.form-signup {
  width: 100%;
  max-width: 400px;
  padding: 15px;
  margin: auto;
  margin-top: 50px;
}
.form-signup .checkbox {
  font-weight: 400;
  margin-top: 15px;
}
.form-signup .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signup .form-control:focus {
  z-index: 2;
}
.form-signup .btn {
    margin-top: 20px;
}
</style>
