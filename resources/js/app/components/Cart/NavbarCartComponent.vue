<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle cart-navbar-btn" @click="loadCart" href="#" id="cart-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shopping-bag"></i>
            <span class="badge badge-secondary" v-text="$root.cart_items"></span>
        </a>
        <div class="dropdown-menu cart-menu" aria-labelledby="cart-dropdown">
            <h1 v-if="items.length == 0">
                Your Shopping Cart is empty
            </h1>
            <div class="cart-items" v-else>
                <div class="cart-item" v-for="item in items">
                    <a href="#" class="item-image">
                        <img :src="`/${item.product.cover}`" class="img-fluid">
                    </a>
                    <div class="item-info">
                        <a href="#" @click.stop="removeItem(item)" class="remove-item">
                            <i class="fa fa-trash-alt"></i>
                        </a>
                        <a href="#" v-text="item.product.title"></a>
                        <div class="item-info-footer">
                            <p class="badge badge-secondary">{{ item.price.toFixed(2) }}$</p>
                            <div class="count">
                                <a href="#" @click.stop="updateItem(item, 'decrement')"><i class="fa fa-minus"></i></a>
                                <b v-text="item.count"></b>
                                <a href="#" @click.stop="updateItem(item, 'increment')"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="text-center mt-2">
                <a href="/cart" class="btn btn-success btn-sm">Go to shopping cart</a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data: function () {
            return {
                items: [],
            };
        },

        mounted: function () {
            this.$root.$on('cart-item-added', () => {
                this.loadCart();
            });
        },

        methods: {
            loadCart() {
                axios.get('/cart').then(({data}) => {
                    this.items = data.items;

                    this.$root.cart_items = data.count;
                });
            },

            removeItem(item) {
                axios.delete(`/cart/${item.key}`).then(() => {
                    this.loadCart();
                });
            },

            updateItem(item, type = 'increment') {
                axios.patch(`/cart/${item.key}/${type}`).then(() => {
                    this.loadCart();
                });
            }
        }
    }
</script>

<style scoped>

</style>