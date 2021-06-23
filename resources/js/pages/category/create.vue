<template>
 <div class="container">
       <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Create Category Page</h5>
             <router-link :to="{name: 'category-list'}" class="btn btn-primary">Category List</router-link>
           </div>
                   <div class="card-body">
                        <div class="row">
                        <div class="col-6 offset-3"> 
                    <form @submit.prevent="createCategory">
                    <div class="form-group">
                        <label for="">Category name</label>
                         <input id="name" v-model="categoryForm.name" type="text" name="name" class="form-control" placeholder="category name" >
                        <HasError :form="categoryForm" field="name" />
                                    </div>

                     <div class="form-group">
                    <button type="submit" class="btn btn-success">Create Category</button>
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
    categoryForm: new Form({
      name: ''
    })
  }),
        methods: {
            createCategory() {
  
                this.categoryForm
                    .post('http://127.0.0.1:8000/api/category/create').then(({ data }) => {
                console.log(data)})
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)

                    this.$toast.success({
                    title:'Success!',
                    message:'Category created successfully.'
                })
            }
        }
    }
</script>