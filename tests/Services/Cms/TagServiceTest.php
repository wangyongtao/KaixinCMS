<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Services;

use App\Services\Cms\TagService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class TagServiceTest extends TestCase
{
    public function testBasic()
    {
        echo '----'.__CLASS__.'-----'.PHP_EOL;
        static::assertTrue(true);
    }

    public function testGetHotTags()
    {
        $input = collect([
            'platform' => 'cms',
            'module' => 'posts',
            'limit' => 110,
        ]);
        $result = (new TagService())->getHotTags($input);
        print_r($result);
    }

    public function testGetTagsByPlatform()
    {
        $input = collect([
        ]);
        $result = (new TagService())->getTagsByPlatform($input);
        print_r($result);
    }

    public function testCreateTag()
    {
        $input = collect([
            'tag_name' => 'TAG1'.time(),
        ]);
        $result = (new TagService())->createTag($input);
        static::assertGreaterThan(1, $result);

        // 删除
        static::assertTrue(
            (new TagService())->deleteTag($result)
        );

        $input = collect([
            'tag_name' => 'TAG2'.time(),
        ]);
        $objectId = rand(100, 10000);
        $result = (new TagService())->createTag($input, $objectId);
        static::assertTrue($result);
    }
}
