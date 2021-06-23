<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Edit Category</h5>
                        <router-link :to="{name: 'category-list'}" class="btn btn-primary">Category List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="updateCategory">
                                    <div class="form-group">
                                        <label for="">Category name</label>
                                        <input id="name" v-model="categoryForm.name" type="text" name="name" class="form-control" placeholder="category name" >
                                    
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Category</button>
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
import Form from 'vform'
import { Button, HasError, AlertError } from 'vform/src/components/bootstrap5'

export default {
  components: {
    Button, HasError, AlertError
  },

  data: () => ({
    categoryForm: new Form({
      name: ''
    })
  }),
        created() {
            this.axios
                .get(`http://127.0.0.1:8000/api/category/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.categoryForm = response.data;
        
                });
        },
        methods: {
            updateCategory() {
                this.axios
                    .post(`http://127.0.0.1:8000/api/category/update/${this.$route.params.id}`, this.categoryForm)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
                        this.$toast.success({
                    title:'Success!',
                    message:'Category updated successfully.'
                })
            }
        }
    }
</script>

