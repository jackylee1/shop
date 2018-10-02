<template>
    <div class="container category-all">
        <div class="row">
            <div class="col-sm-12">
                <h1>Категории</h1>
            </div>
            <div class="col-sm-3">
                <div class="list-group">
                    <a href="/" class="list-group-item">Видеонаблюдение (8)</a>
                    <a href="/" class="list-group-item">&nbsp;&nbsp;&nbsp;- Видеокамеры (4)</a>
                    <a href="/" class="list-group-item">&nbsp;&nbsp;&nbsp;- Видеорегистраторы (4)</a>
                    <a href="/" class="list-group-item">Сигнализация (6)</a>
                    <a href="/" class="list-group-item">Системы оповещения (6)</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                children: {}
            };
        }
    }
</script>

<style>
.category-all {
    margin-top: 50px;
}
</style>
