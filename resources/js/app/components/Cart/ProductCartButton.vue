<template>
    <button :class="{'btn d-flex justify-content-center align-items-baseline': true, 'btn-success': ! cart_status, 'btn-outline-success': cart_status}"
            @click="addToCart">
        <i class="fa fa-shopping-bag mr-2"></i> <span v-text="cartText"></span>
    </button>
</template>

<script>
    export default {
        props: ['productId', 'status'],

        data: function () {
            return {
                cart_status: this.status,
            };
        },

        computed: {
            cartText() {
                if(this.cart_status) {
                    return "In Cart";
                }

                return "Add to cart";
            }
        },

        methods: {
            addToCart() {
                axios.post('/cart', {
                    'product_id': this.productId,
                }).then(({data}) => {
                    this.$root.cart_items = data.count;

                    this.cart_status = true;

                    this.$root.$emit('cart-item-added');

                    $(".cart-navbar-btn").click();
                });
            }
        }
    }
</script>