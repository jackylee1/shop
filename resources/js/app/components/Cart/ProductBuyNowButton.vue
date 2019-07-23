<template>
    <button class="btn btn-secondary d-flex justify-content-center align-items-baseline"
            @click="buyNow">
        <i class="fa fa-shopping-cart mr-2"></i> <span>Buy now</span>
    </button>
</template>

<script>
    export default {
        props: ['productId'],

        methods: {
            buyNow() {
                axios.post('/cart', {
                    'product_id': this.productId,
                }).then(({data}) => {
                    location.href = '/checkout'
                });
            }
        }
    }
</script>