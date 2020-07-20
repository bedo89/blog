<template>
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form action="/examples/actions/confirmation.php" method="post" nonvalidate>
                            <h2 class="text-center">Create New Account</h2>
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="name" placeholder="Name">
                                <div class="text-danger" v-show="nameError">
                                    ... This name is too short !!
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" v-model="email" placeholder="Email">
                                <div class="text-danger" v-show="emailError">
                                    ... This email is not valid !!
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" v-model="password" placeholder="Password">
                                <div class="text-danger" v-show="passwordError">
                                    ... This password is too short !!
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"
                                        :disabled="!isValidForm" @click.prevent="submitRegister">Create Account</button>
                            </div>
                            <div class="clearfix">
                                <a href="#" class="pull-right">Forgot Password?</a>
                            </div>
                        </form>
                        <p class="text-center">having account ?
                            <strong class="switch-tologin-modal" ><a href="#">Login</a></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                name : '',
                password : '',
                email : ''
            }
        },
        computed:{
            nameError(){
                return this.name.length > 0 && this.name.length < 4;
            },
            emailError(){
                return this.email.length > 0 && !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email));
            },
            passwordError(){
                return this.password.length > 0 && this.password.length < 7;
            },
            isValidForm(){
                return this.name.length > 4
                    && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.password.length > 7;
            }
        },
        methods:{
            submitRegister(){




                var name = this.name;
                var email = this.email;
                var password = this.password;
                //let {name, email, password} = this;

                this.$store.dispatch('RegisterUser', {name, email, password})
                //let {name, email, password} = this;
                //this.$store.commit('setUserToken', {userToken : 'fdfdsadasd sadsa'})
                //console.log('submitted');
                //this.$store.state.userToken = "ahmed";
                //console.log(this.$store.getters.isLogged);
                //this.$store.commit('setUserToken', {userToken : 'fdfdsadasd sadsa'})
            }
        }
    }
</script>
