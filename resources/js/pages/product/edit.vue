<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Edit The Product-{{productForm.name}}</h5>
                        <router-link :to="{name: 'product-list'}" class="btn btn-primary">Product List</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="saveProduct">
                                    <div class="form-group">
                                    <label for="">Product Name</label>
                                        <input type="text" v-model="productForm.name" class="form-control" name="name" placeholder="product name">
                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <input type="text" v-model="productForm.price" class="form-control" name="price" placeholder="product price">

                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="">Product Image</label>
                                                <input type="file" class="form-control-file"  @change="onImageChange">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div style="width: 100%; max-height: 150px; overflow:hidden">
                                                <img :src="image" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Product details</label>
                                        <textarea v-model="productForm.detail" class="form-control" name="detail" placeholder="product description" rows="3"></textarea>
            
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Product</button>
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
import { objectToFormData } from 'object-to-formdata'
export default {
  data(){
      return{
      productForm: new Form({
      name: '',
      price: '',
      image: '',
      detail: '',
      _method:'put',
    }),
      image: '',
    }
  },
methods: {   
   loadProductData() {
        let id = this.$route.params.id;
            axios.get(`http://127.0.0.1:8000/api/product/edit/${id}`).then((response) => {
                let product = response.data;
                //console.log(product);
                this.productForm.name = product.name;
                this.productForm.price = product.price;
                this.productForm.detail = product.detail;
              //  this.productForm.category_id = product.category_id;
                this.image = product.image;
        
                });
        },
     
            saveProduct() {
                this.axios
                    .post(`http://127.0.0.1:8000/api/product/update/${this.$route.params.id}`, {
                transformRequest: [function (data, headers) {
                    return objectToFormData(data)
                }],
                onUploadProgress: e => {
                    // Do whatever you want with the progress event
                    console.log(e)
                }
            }).then(({ data }) => {
                this.image = data.image;
                    this.$toast.success({
                    name:'Success!',
                    message:'Product updated successfully.'
                });
             })
          },
            onImageChange(e){
            const file = e.target.files[0]
            // Do some client side validation...
            this.productForm.image = file
        },
    },
   
}
</script>

