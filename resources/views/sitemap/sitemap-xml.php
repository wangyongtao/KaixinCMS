<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php echo '<?xml-stylesheet href="/assets/sitemap.xsl" type="text/xsl"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    <!-- XML文件需以utf-8编码-->
    <!-- <urlset> -->
    <!--必填标签-->
    <url>
        <!--必填标签,这是具体某一个链接的定义入口，每一条数据都要用<url>和</url>包含在里面，这是必须的 -->
        <loc><?php echo config('app.url'); ?>/sitemap.xml</loc>
        <!--必填,URL链接地址,长度不得超过256字节-->
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <!--可以不提交该标签,用来指定该链接的最后更新时间-->
        <changefreq>daily</changefreq>
        <!--可以不提交该标签,用这个标签告诉此链接可能会出现的更新频率 -->
        <priority>0.8</priority>
        <!--可以不提交该标签,用来指定此链接相对于其他链接的优先权比值，此值定于0.0-1.0之间-->
    </url>
<?php if (!empty($posts)) { ?>
    <?php foreach ($posts as $detail) { ?>
        <url>
        <loc><?php echo config('app.url'); ?>/a/detail-<?php echo $detail->id; ?>.html</loc>
        <lastmod><?php echo date('Y-m-d', $detail->update_time); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
        </url>
    <?php } ?>
<?php } ?>
</urlset>
