<template>
 <div class="container">
       <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Create Products Page</h5>
             <router-link :to="{name: 'product-list'}" class="btn btn-primary">Product List</router-link>
           </div>
                   <div class="card-body">
                        <div class="row">
                        <div class="col-6 offset-3"> 
                    <form @submit.prevent="createProduct">
                    <div class="form-group">
                        <label for="">Product name</label>
                         <input id="name" v-model="productForm.name" type="text" name="name" class="form-control" placeholder="product name" >
                        <HasError :form="productForm" field="name" />
                                    </div>

                     <div class="form-group">
                    <button type="submit" class="btn btn-success">Create Product</button>
                </div>
                </form>
            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import {Form} from 'vform'
import {  HasError, AlertError } from 'vform/src/components/bootstrap5'

export default {
  components: {
 HasError, AlertError
  },

  data: () => ({
    productForm: new Form({
      name: ''
    })
  }),
        methods: {
            createProduct() {
  
                this.productForm
                    .post('http://127.0.0.1:8000/api/product/add').then(({ data }) => {
                console.log(data)})
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)

                    this.$toast.success({
                    title:'Success!',
                    message:'Product created successfully.'
                })
            }
        }
    }
</script>