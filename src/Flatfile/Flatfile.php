<?php

namespace Typomedia\Flatfile;

use RuntimeException;
use Typomedia\Collection\Collection;

/**
 * Class Flatfile
 * @package Typomedia\Flatfile
 */
class Flatfile extends Collection
{
    const ALGORITHM = 'sha256';

    protected $filename;
    protected $hash;

    public function __construct(string $filename)
    {
        if (!file_exists($filename)) {
            try {
                touch($filename);
            } catch (RuntimeException $exception) {
                print $exception->getMessage();
            }
        }

        $this->filename = $filename;
        $data = file_get_contents($filename);
        $this->hash = hash(self::ALGORITHM, $data);
        $data = json_decode($data, true);
        $this->items = $data;
    }

    public function __destruct()
    {
        $data = json_encode($this->items, JSON_PRETTY_PRINT);
        $hash = hash(self::ALGORITHM, $data);

        try {
            if ($hash !== $this->hash) {
                file_put_contents($this->filename, $data);
            }
        } catch (RuntimeException $exception) {
            print $exception->getMessage();
        }
    }
}
