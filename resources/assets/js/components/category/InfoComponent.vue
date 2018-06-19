<template>
    <div class="container category-info">
        <div class="row">
            <div class="col-sm-12">
                <h1>{{ name }}</h1>
                <hr>
            </div>
            <div class="col-sm-3">
                <div class="list-group">
                    <a :href="`/category/` + category.id" class="list-group-item" v-for="category in children">{{ category.name }}</a>                
                </div>
            </div>
            <div class="col-sm-9">
                <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="product-thumb">
            <div class="image"><a href="http://shop.maksa988.su/index.php?route=product/product&amp;path=62&amp;product_id=60"><img src="http://shop.maksa988.su/image/cache/catalog/998551195_w640_h640_007a481f184f05__716cd84d8b-228x228.jpg" alt="2Мп IP видеокамера Hikvision DS-2CD1121-I (2.8 мм)" title="2Мп IP видеокамера Hikvision DS-2CD1121-I (2.8 мм)" class="img-responsive"></a></div>
            <div>
              <div class="caption">
                <h4><a href="http://shop.maksa988.su/index.php?route=product/product&amp;path=62&amp;product_id=60">2Мп IP видеокамера Hikvision DS-2CD1121-I (2.8 мм)</a></h4>
                <p>..</p>
                                                <p class="price">
                                    5500руб.                                                    </p>
                              </div>
              <div class="button-group">
                <button type="button" onclick="cart.add('60', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Купить</span></button>
                <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('60');" data-original-title="В закладки"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('60');" data-original-title="В сравнение"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
        </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "Загрузка...",
                children: {}
            };
        },
        props: ['categoryid'],
        mounted() {
            axios.get(`/json/category/${this.categoryid}`).then((response) => {
                this.name = response.data.name;
                this.children = response.data.children;
            });
        }
    }
</script>

<style>
.category-info {
    margin-top: 50px;
}
</style>
