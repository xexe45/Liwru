<template>
    <section>
        <div class="descubrir">
            <h3><img :src="img" class="img-fluid" alt="">Categorías</h3>
            <a @click.prevent="active(1)" href="#" class="parrafo" :class="{'active': active1}">Registro de Categorías</a>
            <a @click.prevent="active(2)" href="#" class="parrafo" :class="{'active': active2}">Listado de Categorías</a>
        </div>
        <div class="registro animated fadeIn" v-if="active1">
            <form @submit.prevent="save()" class="form-horizontal">
                <div class="col-md-6">
                    <loading-component v-if="loading"></loading-component>
                    
                    <div class="form-group has-feedback" :class="{'has-error': errors.name, ' ': !errors.name }">
                        <label for="name" class="col-sm-2 control-label">Nombre*</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-book"></i></span>
                                <input type="text" v-model="form.name" class="form-control" placeholder="Nombre Categoría">
                                
                            </div>
                            <span class="help-block" v-if="errors.name">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        
                            <button @click="reset" type="button" class="boton2 cancelar">Cancelar</button>
                            <button type="submit" class="boton hecho pull-right">Guardar</button>
                        
                    </div>
                    
                </div>
                
            </form>
        </div>
        <div class="tabla animated fadeIn" v-if="active2">
            <v-server-table ref="table" :columns="columns" :url="url" :options="options">
                <div slot="options" slot-scope="props">
                    <button 
                        class="btn btn-info btn-sm"
                        type="button"
                        @click="update(props.row)"
                        >
                        <i class="fa fa-pencil-square-o"></i> {{ labels.edit }}
                    </button>
                </div>
            </v-server-table>
        </div>
    </section>
</template>

<script>
import LoadingComponent from './LoadingComponent'; 
export default {
    name: 'CategoryComponent',
    components: {LoadingComponent},
    props: {
        img: {
            type: String,
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
    data(){
        return{
            method: 'post',
            loading: false,
            active1: true,
            active2: false,
            form: {
                id: null,
                name: null,
            },
            errors: {
                name: null,
            },
            url: this.route,
            columns: ['id','name','created_at','options'],
            options: {
                filterByColumn: true,
                perPage: 10,
                perPageValues: [10, 25, 50, 100, 500],
                headings: {
                    id: 'ID',
                    name: this.labels.name,
                    created_at: this.labels.created_at,
                    options: this.labels.options,
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
            this.method = 'post';
            this.form = {
                id: null,
                name: null,
            }
        },

        resetErrors(){
            this.errors = {
                name: null,
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
            const url = '/categories';
            this.loading = true;
            this.resetErrors();
            if(this.method == 'post'){
                axios.post(url, this.form)
                .then( response => {
                    console.log(response);
                    this.$toasted.show('Categoría registrada correctamente', {type:'success', icon: 'check'});
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
            }else if(this.method == 'put'){
                axios.put(`${url}/${this.form.id}`, this.form)
                .then( response => {
                    console.log(response);
                    this.$toasted.show('Categoría editada correctamente', {type:'success', icon: 'check'});
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
            
        },
        update(row){
            this.active(1);
            this.method = 'put';
            this.form = {
                id: row.id,
                name: row.name
            }
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

@media only screen and (max-width: 800px) {
    .boton {
       
        padding: 10px 20px;
        
    }

    
    .boton2 {
        padding: 10px 20px;
    }
}
</style>
