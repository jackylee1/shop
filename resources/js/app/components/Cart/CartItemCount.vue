<template>
    <div class="count">
        <a href="#" @click.stop="updateItem('decrement')"><i class="fa fa-minus"></i></a>
        <b v-text="count"></b>
        <a href="#" @click.stop="updateItem('increment')"><i class="fa fa-plus"></i></a>
    </div>
</template>

<script>
    export default {
        props: ['itemId', 'itemCount'],

        data: function () {
            return {
                count: this.itemCount,
            };
        },

        methods: {
            updateItem(type = 'increment') {
                axios.patch(`/cart/${this.itemId}/${type}`).then(({data}) => {
                    this.count = data.item_count;

                    this.$root.cart_items = data.count;
                });
            }
        }
    }
</script>