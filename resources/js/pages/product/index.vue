<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div
            class="
              card-header
              d-flex
              justify-content-between
              align-items-center
            "
          >
            <h5 class="mb-0">Products</h5>
            <router-link
              :to="{ name: 'create-product' }"
              class="btn btn-primary"
              >Create Product</router-link
            >
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 100px">Id</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Details</th>
                  <th style="width: 170px">Action</th>
                </tr>
              </thead>
              <tbody v-if="products.length">
                <tr v-for="product in products" :key="product.id">
                  <td style="width: 100px">{{ product.id }}</td>
                  <td>
                    <div
                      style="
                        max-width: 150px;
                        max-height: 150px;
                        overflow: hidden;
                      "
                    >
                      <img :src="product.image" alt="" class="img-fluid" />
                    </div>
                  </td>
                  <td>{{ product.name }}</td>
                  <td>{{ product.slug }}</td>
                  <td>{{ product.price }}</td>
                  <td>
                    <span v-if="product.category">
                      {{ product.category.name }}
                    </span>
                    <span v-else> {{ product.category_id }} </span>
                  </td>
                  <td>{{ product.description }}</td>
                  <td style="width: 170px">
                    <router-link
                      :to="{ name: 'edit-product', params: { id: product.id } }"
                      class="btn btn-primary btn-sm"
                      >Edit</router-link
                    >
                    <button
                      class="btn btn-danger btn-sm"
                      @click="deleteProduct(product.id)"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr>
                  <td colspan="4">
                    <h5 class="text-center mt-4 mb-4">No products found.</h5>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


   
<script>
export default {
  data() {
    return {
      products: [],
    };
  },
  created() {
    this.axios.get("http://127.0.0.1:8000/api/products").then((response) => {
      this.products = response.data;
    });
  },
  methods: {
    deleteProduct(id) {
      this.axios
        .delete(`http://127.0.0.1:8000/api/product/delete/${id}`)
        .then((response) => {
          let i = this.products.map((item) => item.id).indexOf(id); // find index of your object
          this.products.splice(i, 1);
        });
      this.$toast.success({
        title: "Success!",
        message: "product deleted successfully.",
      });
    },
  },
};
</script>
