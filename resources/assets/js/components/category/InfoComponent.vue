<template>
    <div class="container category-info">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ name }}</h1>
                <hr>
            </div>
            <div class="col-md-3">
                <div class="list-group">
                    <a :href="`/category/` + category.id" class="list-group-item" v-for="category in children" :key="category.id">{{ category.name }}</a>                
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <product-item v-for="(product) in products" :product="product" :key="product.id"></product-item>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "Загрузка...",
                children: [],
                products: []
            };
        },
        props: ['categoryid'],
        mounted() {
            axios.get(`/json/category/${this.categoryid}`).then((response) => {
                this.name = response.data.name;
                this.children = response.data.children_with_products;

                this.products = response.data.products;

                for(let i = 0; i < this.children.length; i++) {
                    this.products = this.products.concat(this.children[i].products);
                }
            });
        }
    }
</script>