<template>
    <div class="modal" id="loginModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Login
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form submit.prevent>
                        <ul class="alert alert-danger" v-if="errors.length > 0">
                            <li v-for="error in errors" :key="errors.indexOf(error)" class="list-group-item">
                                {{ error }}
                            </li>
                        </ul>
                        <input type="text" class="form-control my-3" placeholder="Username" v-model="email">
                        <input type="text" class="form-control my-3" placeholder="Password" v-model="password">
                        <div class="d-flex justify-content-between my-3">
                            <div class="form-check">
                                <input type="checkbox" id="rememberCheck" class="form-check-input" v-model="remember">
                                <label for="rememberCheck" class="form-check-label">Remember me</label>
                            </div>
                            <a href="">Forget Password?</a>
                        </div>
                        <button class="btn btn-primary w-100" @click.prevent="attemptLogin()" :disabled="!isValidLoginForm">LOGIN</button>
                        <p class="mt-3 text-muted text-center">Don't have an account? <a href="/register">Sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                email: '',
                password: '',
                remember: true,
                loading: false,
                errors: []
            }
        },
        methods: {
            emailIsValid() {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
                    return true
                } else {
                    return false
                }
            },
            attemptLogin() {
                this.errors = []
                this.loading = true
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                }).then(resp => {
                    location.reload() 
                }).catch(error => {
                    this.loading = false
                    if(error.response.status == 422) 
                    {
                        this.errors.push("We couldn't verify your account details.");
                    } else {
                        this.errors.push("Something went wrong , please refresh and try again.");
                    }
                })
            }
        },
        computed: {
            isValidLoginForm() {
                return this.emailIsValid() && this.password && !this.loading
            }
        }
    }
</script>
