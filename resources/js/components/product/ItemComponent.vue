<template>
    <a :href="`/product/` + product.id" :class="{'card product-item col-md-4 border': true, 'border-danger': inBookmarks}" @click="productClick">
        <div class="product-type">
            <span class="btn btn-success btn-sm">Акция</span>
        </div>
        <div class="product-img">
            <img :src="product.image_url" :alt="product.image_url">
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text">
                {{ product.description }}
            </p>
        </div>
        <div class="card-footer">
            <div class="btn btn-outline-info btn-sm">{{ product.price | price }} грн.</div>
            <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" data-placement="top" title="Добавить в корзину">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <div @click.stop="toggleBookmark" :class="{ 'btn btn-sm pull-right': true, 'btn-secondary': !inBookmarks, 'btn-danger': inBookmarks }"  data-toggle="tooltip" data-placement="top" title="В закладки">
                <i class="fa fa-heart"></i>
            </div>
        </div>
    </a>
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
            toggleBookmark() {
                this.inBookmarks = !this.inBookmarks;
            }
        },
    }
</script>