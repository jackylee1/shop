<template>
    <div :class="{'card product-item col-md-4 border': true, 'border-danger': inBookmarks}" @click="productClick">
        <div class="product-type">
            <span class="btn btn-success btn-sm">Акция</span>
        </div>
        <div class="product-img">
            <img :src="product.image" :alt="product.image">
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
        </div>
        <div class="card-footer">
            <div class="btn btn-outline-info btn-sm">17 999 грн.</div>
            <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" data-placement="top" title="Добавить в корзину">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <div @click.stop="toggleBookmark" :class="{ 'btn btn-sm pull-right': true, 'btn-secondary': !inBookmarks, 'btn-danger': inBookmarks }"  data-toggle="tooltip" data-placement="top" title="В закладки">
                <i class="fa fa-heart"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                inBookmarks: false
            }
        },
        props: ['product'],
        mounted() {
            if(this.product.bookmark)
                this.inBookmarks = true;
        },
        methods: {
            productClick() {
                alert("Product clicked");
            },
            toggleBookmark() {
                this.inBookmarks = !this.inBookmarks;
            }
        },
    }
</script>