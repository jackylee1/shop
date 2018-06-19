<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark site-header">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="fab fa-telegram-plane"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Контакты</a>
                        </li>
                    </ul>
                    <form class="form-inline my-3 my-lg-0 input-group-sm">
                        <input class="form-control mr-sm-1" type="text" v-model="search" placeholder="Поиск" aria-label="Поиск">
                        <button class="btn btn-outline-default btn-sm my-2 my-sm-0" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav mr-0 ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-heart"></i>
                                <span v-if="bookmarks.count" class="badge badge-light">{{ bookmarks.count }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="cart-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-shopping-cart"></i>
                                <span v-if="cart.count" class="badge badge-light">{{ cart.count }}</span>
                            </a>
                            <div class="dropdown-menu cart-menu" aria-labelledby="cart-dropdown">
                                <h1>
                                    В корзине {{ cart.count }} товаров
                                </h1>
                                <div class="cart-items">
                                    <div class="cart-item" v-for="item in cart.items">
                                        <a :href="item.item_url" class="item-image">
                                            <img :src="item.item_image">
                                        </a>
                                        <div class="item-info">
                                            <a :href="item.item_url" class="remove-item" @click.stop="addItem">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                            <a :href="item.item_url">
                                                {{ item.item_name }}
                                            </a>
                                            <div class="item-info-footer">
                                                <p class="badge badge-light">{{ item.item_price }} руб.</p>
                                                <div class="count">
                                                    <a href="#"><i class="fa fa-minus"></i></a>
                                                    <b>{{ item.item_count }} шт.</b>
                                                    <a href="#"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="#" class="btn btn-success btn-sm">Перейти в корзину</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item" v-if="!user.logged">
                            <a class="nav-link" href="/user/login">
                                <i class="fa fa-user"></i>
                                Личный кабинет
                            </a>
                        </li>
                        <li class="nav-item dropdown" v-if="user.logged">
                            <a class="nav-link dropdown-toggle" href="#" id="user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                                {{ user.name }}
                            </a>
                            <div class="dropdown-menu user-menu" aria-labelledby="user-dropdown">
                                <a class="dropdown-item" href="#">Профиль</a>
                                <a class="dropdown-item" href="#">Выход</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{ search }}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    logged: false,
                    name: undefined,
                },
                bookmarks: {
                    count: 0
                },
                cart: {
                    count: 0,
                    items: [
                        {
                            item_id: 1,
                            item_image: "https://i2.rozetka.ua/goods/4575002/qitech_qt_ap_01_images_4575002472.jpg",
                            item_name: "Беспроводное зарядное устройство Qitech AirPower 3 в 1 для Apple Watch с технологией QI Fast Charge Белый (QT-AP-01) ",
                            item_url: "#",
                            item_price: 1300,
                            item_count: 1
                        }
                    ]
                },
                search: undefined
            }
        },
        props: ['username'],
        mounted() {
            $('[data-toggle="tooltip"]').tooltip();
            this.count();

            if(this.username != undefined) {
                this.user.logged = true;
                this.user.name = this.username;
            }
        },
        watch: {
            cart: function(val) {
                console.log("changed...", val);

                this.count();
            }
        },
        methods: {
            count() {
                this.cart.count = 0;
                for (let i = 0; i < this.cart.items.length; i++) {
                    this.cart.count += this.cart.items[i].item_count;
                }
            },
            addItem() {
                this.cart.items.push({
                    item_id: 1,
                    item_image: "https://images-na.ssl-images-amazon.com/images/I/71WjexE2YRL._AA100_.jpg",
                    item_name: "Echo (2nd Generation) - Smart speaker with Alexa - Charcoal Fabric",
                    item_url: "#",
                    item_price: 4900,
                    item_count: 1
                });

                this.cart.items.push({
                    item_id: 1,
                    item_image: "https://i2.rozetka.ua/goods/3285028/33926463_images_3285028175.jpg",
                    item_name: "Apple AirPods (MMEF2)",
                    item_url: "#",
                    item_price: 5200,
                    item_count: 1
                });

                this.count();
            }
        }
    }
</script>