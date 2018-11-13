<template>
    <section>
        <div class="descubrir">
            <h3><img :src="img" class="img-fluid" alt="">Usuarios</h3>
            <a @click.prevent="active(1)" href="#" class="parrafo" :class="{'active': active1}">Registro de Usuarios</a>
            <a @click.prevent="active(2)" href="#" class="parrafo" :class="{'active': active2}">Listado de Usuarios</a>
        </div>
        <div class="registro animated fadeIn" v-if="active1">
            <form @submit.prevent="save()" class="form-horizontal">
                <div class="col-md-6">
                    <loading-component v-if="loading"></loading-component>
                    <div class="form-group has-feedback" :class="{'has-error': errors.role_id, ' ': !errors.role_id }">
                        <label for="role" class="col-sm-2 control-label">Rol*</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span>
                                <select v-model="form.role_id" class="form-control">
                                    <option value="" disabled selected>Seleccionar Rol de Usuario...</option>
                                    <option v-for="(role, index) in roles" :key="index" :value="role.id">{{ role.name }}</option>
                                </select>
                                
                            </div>
                            <span class="help-block" v-if="errors.role_id">
                                <strong>{{ errors.role_id[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group has-feedback" :class="{'has-error': errors.name, ' ': !errors.name }">
                        <label for="name" class="col-sm-2 control-label">Nombre*</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-user"></i></span>
                                <input type="text" v-model="form.name" class="form-control" placeholder="Nombre Completo">
                                
                            </div>
                            <span class="help-block" v-if="errors.name">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group has-feedback" :class="{'has-error': errors.phone, ' ': !errors.phone }">
                        <label for="phone" class="col-sm-2 control-label">Teléfono*</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3"><i class="fa fa-phone"></i></span>
                                <input type="text" v-model="form.phone" class="form-control" placeholder="Número de Teléfono">
                            </div>
                            <span class="help-block" v-if="errors.phone">
                                <strong>{{ errors.phone[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group has-feedback" :class="{'has-error': errors.email, ' ': !errors.email }">
                        <label for="email" class="col-sm-2 control-label">Correo*</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon4"><i class="fa fa-envelope"></i></span>
                                <input type="email" v-model="form.email" class="form-control" placeholder="Corre Electrónico">
                                 
                            </div>
                            <span class="help-block" v-if="errors.email">
                                <strong>{{ errors.email[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group has-feedback" :class="{'has-error': errors.date, ' ': !errors.date }">
                        <label for="email" class="col-sm-2 control-label">Fecha de Nacimiento*</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon4"><i class="fa fa-calendar"></i></span>
                               
                                 <!--<datepicker :typeable="true" :format="'yyyy-MM-dd'" :input-class="'form-control'" v-model="form.date"></datepicker>-->
                                 <input type="date" v-model="form.date" class="form-control">
                            </div>
                            <span class="help-block" v-if="errors.date">
                                <strong>{{ errors.date[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button @click="reset" type="button" class="boton2 cancelar">Cancelar</button>
                            <button type="submit" class="boton hecho pull-right">Registrar</button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <div class="tabla animated fadeIn" v-if="active2">
            <v-server-table ref="table" :columns="columns" :url="url" :options="options">
                
                <div slot="role" slot-scope="props">
                    {{ props.row.role.name }}
                </div>

                <div slot="picture" slot-scope="props">
                    <img :src="`/images/users/${props.row.picture}`" class="img-fluid" width="60" alt="">
                </div>
            </v-server-table>
        </div>
    </section>
</template>

<script>
import LoadingComponent from './LoadingComponent'; 
import Datepicker from 'vuejs-datepicker';
export default {
    name: 'UsersComponent',
    components: {LoadingComponent,Datepicker},
    props: {
        img: {
            type: String,
            required: true
        },
        roles: {
            type: Array,
            required: true
        },
        labels: {
            type: Object,
            required: true
        },
        route: {
            type: String,
            required: true
        }
    },
    mounted() {
    // and also
       
    },
    data(){
        return{
            loading: false,
            active1: true,
            active2: false,
            form: {
                role_id: '',
                name: null,
                phone: null,
                email: null,
                date: null,
                picture: 'user.png',
            },
            errors: {
                role_id: null,
                name: null,
                phone: null,
                email: null,
                date: null,
            },
            url: this.route,
            columns: ['id','role','name','phone','email','picture','created_at'],
            options: {
                filterByColumn: true,
                perPage: 10,
                perPageValues: [10, 25, 50, 100, 500],
                headings: {
                    id: 'ID',
                    role: this.labels.role,
                    name: this.labels.name,
                    phone: this.labels.phone,
                    email: this.labels.email,
                    picture: this.labels.picture,
                    created_at: this.labels.created_at
                },
                customFilters: [],
                sortable: ['id','name'],
                filterable: ['name'],
                requestFunction: (data) => {
                    return window.axios.get(this.url, {
                        params: data
                    })
                    .catch((e) => {
                        this.dispatch('error',e);
                    })
                }
            }
        }
    },
    methods:{
        reset(){
            this.form = {
                role_id: '',
                name: null,
                phone: null,
                email: null,
                picture: 'user.png',
                date: null,
            }
        },

        resetErrors(){
            this.errors = {
                role_id: null,
                name: null,
                phone: null,
                email: null,
                date: null,
            }
        },
        active(n){
            if (n == 1)
            {
                this.active1 = true;
                this.active2 = false;
            }else{
                this.active2 = true;
                this.active1 = false;
            }
        },
        save(){
            const url = '/users';
            this.loading = true;
            this.resetErrors();
            axios.post(url, this.form)
                .then( response => {
                    console.log(response);
                    this.$toasted.show('Usuario registrado correctamente', {type:'success', icon: 'check'});
                    this.reset();
                })
                .catch( err => {
                    console.log(err);
                     if(err.response.data.errors){
                        this.errors = err.response.data.errors;
                    }else{
                        //swal('Oooops!',err.response.data, 'error');
                        this.$toasted.show(err.response.data, {type:'error', icon: 'ban'})
                        console.log(err.response.data);
                    }
                })
                .finally(() => {
                    this.loading = false;
                })
        }
    }
}
</script>

<style>
:root {
    --fuente-principal: #EA563C;
    --fuente-secundaria: #0A8587;
    --fuente-texto: #717171;
}
@-webkit-keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}
.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}
.fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
}
.table-bordered>thead>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tfoot>tr>td {
    text-align: center !important;
}
.descubrir {
    background: #f6f6f6;
    font-family: 'Montserrat', sans-serif;
    margin-left: -15px;
    margin-right: -15px;
    margin-top: -24px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    font-weight: bold;
    padding: 10px;
}

.descubrir h3 img {
    margin-right: 10px;
}

.descubrir .parrafo {
    margin-top: 15px;
    color: #4f4f4f;
}

.descubrir .active {
    color: var(--fuente-principal) !important;
}

.registro{
    padding: 30px;
}
.tabla{
    padding: 30px;
}
.boton {
    border: 2px solid black;
    background-color: var(--fuente-principal);
    color: black;
    padding: 10px 40px;
    font-size: 16px;
    cursor: pointer;
}

.hecho {
    border-color: var(--fuente-principal);
    color: #fff;
}

.boton2 {
    border: 2px solid black;
    background-color: gray;
    color: black;
    padding: 10px 40px;
    font-size: 16px;
    cursor: pointer;
}

.cancelar {
    border-color: gray;
    color: #fff;
}


</style>
