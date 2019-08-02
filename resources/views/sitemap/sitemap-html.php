<!-- 网站首页 -->
<?php if (config('app.url')) {?>
    <a href="<?php echo config('app.url'); ?>">网站首页</a>
<?php }?>
<!-- 网站栏目 -->

<!-- 分类 -->

<!-- 文章列表 -->
<?php if (!empty($posts)) {
    foreach ($posts as $item) {?>
        <p>
            <a href="<?php echo route('article_detail', ['id' => $item->id]); ?>"><?php echo $item->title; ?></a>
        </p>
    <?php }
}?>
