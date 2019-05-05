<template>
    <button type="button"
            :class="{'btn btn-sm': true, 'btn-danger': bookmark_status, 'btn-outline-danger': ! bookmark_status}"
            @click="addBookmark"
            data-toggle="tooltip"
            data-placement="left"
            :title="tooltip"><i class="fas fa-heart"></i></button>
</template>

<script>
    export default {
        props: ['productId', 'status', 'remove'],

        data: function () {
            return {
                bookmark_status: this.status,
            };
        },

        watch: {
            'bookmark_status': function (newVal) {
                if(this.remove && ! newVal) {
                    $(`[data-product-item-id='${this.productId}']`).remove();
                }
            }
        },

        computed: {
            tooltip() {
                return ! this.bookmark_status
                    ? 'Add to bookmarks'
                    : (this.remove ? 'Remove from bookmarks' : '');
            }
        },

        methods: {
            addBookmark() {
                axios.post('bookmarks', {
                    'product_id': this.productId,
                }).then(({data}) => {

                    this.$parent.bookmarks = data.bookmarks;

                    this.bookmark_status = ! this.bookmark_status;
                });
            }
        }
    }
</script>