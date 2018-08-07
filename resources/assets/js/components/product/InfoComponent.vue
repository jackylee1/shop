<template>
    <div class="container product-info">
        <div class="row loader" v-if="!loaded">
            <h1 class="text-center">Загрузка...</h1>
        </div>
        <div class="row" v-if="loaded">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Каталог</a></li>
                        <li class="breadcrumb-item" v-for="(item, index) in category" :key="index"><a :href="`/category/` + item.id">{{ item.name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ product.name }}</li>
                    </ol>
                </nav>
                <div>
                    <div class="pull-right">
                        <a href="#" class="btn btn-sm btn-secondary"><i class="fa fa-share"></i></a>
                    </div>
                    <h1>{{ product.name }}</h1>
                </div>
                <hr>
            </div>
            <div class="col-md-8 left-side border-md-right">
                <div id="productcarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#productcarousel" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item text-center active">
                            <img class="" :src="product.image_url" alt="First slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#productcarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productcarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4 right-side">
                <div class="price">
                    <span>
                        {{ product.price | price }}
                        <small class="currency">грн.</small>
                        <s class="oldprice badge badge-danger">
                            20 999
                            <small class="currency">грн.</small>
                        </s>
                    </span>
                </div>
                <a href="#" class="btn btn-success btn-lg btn-block"><i class="fa fa-shopping-cart"></i> Купить</a>

                <ul class="nav flex-column mt-4 nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Все о товаре</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Описание</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Отзывы</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 border-top pt-2 pb-2 border-right">
                {{ product.description }}
            </div>
            <div class="col-md-8 border-top pt-4 border-right">
                <div class="review" v-for="(item, index) in cleanReviews" :key="index">
                    <div class="card mb-4">
                        <div class="card-header">
                            {{ item.user.name }} {{ item.user.surname }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ item.content }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            <a href="#"><i class="fa fa-reply"></i> Ответить</a>
                            <p class="card-text float-right">{{ item.created_at }}</p>
                        </div>
                    </div>

                    <div class="card ml-5 mb-4" v-for="(c_item, c_index) in item.children" :key="c_index">
                        <div class="card-header">
                            {{ c_item.user.name }} {{ c_item.user.surname }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ c_item.content }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            <a href="#"><i class="fa fa-reply"></i> Ответить</a>
                            <p class="card-text float-right">{{ c_item.created_at }}</p>
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
                loaded: false,
                product: {},
                category: [],
                review: [],
            }
        },
        filters: {
            console: function (value) {
                console.log(value);
            }
        },
        computed: {
            cleanReviews: function () {
                let _reviews = [];

                for(let i = 0; i < this.review.length; i++)
                {
                    if(this.review[i].parent_id === null) {
                        _reviews.push(this.review[i]);
                    }
                }

                return _reviews;
            }
        },
        props: ['productid'],
        mounted() {
            axios.get(`/json/product/${this.productid}`).then((response) => {
                console.log(response.data);

                this.product = response.data;

                this.category.push(this.product.category);

                let _parent = this.product.category.parent;
                while (_parent) {
                    this.category.push(_parent);

                    _parent = _parent.parent;
                }

                this.category = this.category.reverse();

                this.review = this.product.reviews;

                this.loaded = true;
            });
        }
    }
</script>