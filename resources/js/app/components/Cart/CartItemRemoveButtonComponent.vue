<template>
    <button type="button"
            class="btn btn-danger btn-sm"
            @click="removeFromCart"
            data-toggle="tooltip"
            data-placement="left">
        <i class="fas fa-times"></i>
    </button>
</template>

<script>
    export default {
        props: ['itemId'],

        data: function () {
            return {
                //
            };
        },

        methods: {
            removeFromCart() {
                axios.delete(`cart/${this.itemId}`).then(({data}) => {
                    this.$root.cart_items = data.count;

                    $(".cart-total-price").html(data.total + "$");

                    if(data.count == 0) {
                        $(".list-empty").removeClass('d-none');
                    }

                    $(`[data-item-id='${this.itemId}']`).remove();
                });
            }
        }
    }
</script>