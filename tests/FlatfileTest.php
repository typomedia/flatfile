<?php

namespace Typomedia\Flatfile\Tests;

use PHPUnit\Framework\TestCase;
use Typomedia\Flatfile\Flatfile;

class FlatfileTest extends TestCase
{
    public function testRead() {
        $data = [
            'Moretti' => [
                'name' => 'Style Ale',
                'style' => 'European Amber Lager',
                'alcohol' => '9.1%'
            ]
        ];

        $flatfile = new Flatfile('test.json');
        $key = md5(serialize($data));

        $flatfile->set((object)$data, $key);

        $json = file_get_contents('test.json');
        $this->assertEquals($data, (array)$flatfile->get($key));
        $this->assertEquals($flatfile->items, json_decode($json, true));
    }
}