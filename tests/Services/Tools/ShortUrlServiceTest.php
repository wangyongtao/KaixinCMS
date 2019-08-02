<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Services;

use App\Services\Tools\ShortUrlService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ShortUrlServiceTest extends TestCase
{
    public function testBasic()
    {
        static::assertTrue(true);
    }

    public function testShortUrl()
    {
        $urls = [
            'https://www.cnblogs.com/alibai/p/3506649.html',
            'https://packagist.org/packages/yadakhov/insert-on-duplicate-key',
            'https://laravel.com/docs/5.6/migrations',
            'https://www.baidu.com/',
        ];
        $out = [];
        foreach ($urls as $url) {
            $out[] = (new ShortUrlService())->createShortUrl($url).'  :  '.$url;
        }
//        print_r($out);

        static::assertTrue(true);
    }

    public function testGetOriginalUrl()
    {
        $url = 'https://www.baidu.com/';
        $expected = 'fDGH3q';

        // 加密
        $shortCode = (new ShortUrlService())->createShortUrl($url);
        static::assertSame($expected, $shortCode);

        // 解密
        $result = (new ShortUrlService())->getOriginalUrl($shortCode);
        static::assertSame($url, $result);
    }
}
