<template>
    <button type="button"
            :class="{'btn btn-sm': true, 'btn-success': ! cart_status, 'btn-outline-success': cart_status}"
            @click="addToCart"
            data-toggle="tooltip"
            data-placement="left"
            :title="tooltip">
        <i class="fas fa-shopping-cart"></i> <span class="buy-text">Buy</span>
    </button>
</template>

<script>
    export default {
        props: ['productId', 'status', 'remove'],

        data: function () {
            return {
                cart_status: this.status,
            };
        },

        watch: {
            'cart_status': function (newVal) {
                if(this.remove && ! newVal) {
                    $(`[data-product-item-id='${this.productId}']`).remove();
                }
            }
        },

        computed: {
            tooltip() {
                return ! this.cart_status
                    ? ''
                    : (this.remove ? 'In Cart' : '');
            }
        },

        methods: {
            addToCart() {
                axios.post('cart', {
                    'product_id': this.productId,
                }).then(({data}) => {
                    this.$root.cart_items = data.count;

                    this.cart_status = ! this.cart_status;

                    this.$root.$emit('cart-item-added');

                    $(".cart-navbar-btn").click();
                });
            }
        }
    }
</script>