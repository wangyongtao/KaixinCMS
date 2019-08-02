<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Services;

use App\Services\Tools\ExplodeWordsService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ExplodeWordsServiceTest extends TestCase
{
    public function testBasic()
    {
        static::assertTrue(true);
    }

    public function testPhrase()
    {
        $t = "<<<END_OF_STRING
    This is my string 
END_OF_STRING; // print This is my string
‘Come on,’ she urged. ‘I’ll telephone my sister [Catherine]. She’s said to be very beautiful 
        by people who ought to know.’
‘Well, I’d like to, but——‘
We went on, cutting back again over <the Park toward> the West Hundreds. 
At 158th Street the cab stopped at one slice in a long white cake of apartment houses. 
Throwing a regal homecoming glance around the neighborhood, Mrs. Wil- son gathered up her dog and 
her other purchases and went haughtily in. '\fChapter'
standard—it was a factual imitation of some Hôtel de Ville in Normandy
END_OF_STRING";
        $res = (new ExplodeWordsService())->phrase($t);
        print_r($res);
        static::assertTrue(true);
    }

    public function testPhraseFrench()
    {
        $t = '<<<END_OF_STRING
 -a (avoir) 和 à accent tréma Voilà ma chambre. cédille |-la 和 là||
带特殊字符的字母列表：
é è ê ë   î ï    ù û ü    à â ä   ô ö   ç
É È Ê Ë   Î Ï    Ù Û Ü    À Â Ä   Ô Ö   Ç
standard—it was a factual imitation of some Hôtel de Ville in Normandy
In probability theory , ϕ ( x ) = (2π) − 1 ⁄ 2 e − x ²/2 is the probability 
density function of the normal distribution . 
END_OF_STRING';
        $res = (new ExplodeWordsService())->phrase($t, true);
//        print_r($res);
        static::assertTrue(true);
        static::assertArrayHasKey('Hôtel', $res);
        static::assertArrayHasKey('Ë', $res);
        static::assertArrayHasKey('Ç', $res);
    }
}
