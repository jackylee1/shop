<template>
    <button type="button" class="btn btn-sm btn-danger" @click="addBookmark"><i class="fas fa-heart"></i></button>
</template>

<script>
    export default {
        props: ['productId'],

        data: function () {
            return {

            };
        },

        methods: {
            addBookmark() {
                axios.post('bookmarks', {
                    'product_id': this.productId,
                }).then((data) => {
                    console.log(data);
                });
            }
        }
    }
</script>