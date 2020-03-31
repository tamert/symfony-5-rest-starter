<?php
namespace App\Resources;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection; // many
// use League\Fractal\Resource\Item; // one

/**
 * Class FractalCollection
 * @package App\Resources
 */
class FractalCollection
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * @var Collection
     */
    private $resource;

    /**
     * FractalCollection constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->manager = new Manager();
        $this->resource = new Collection($data,  [$this, "set"]);
    }

    public function set(array $item)
    {
        return [
            'id'      => (int) $item['id'],
            'title'   => $item['title'],
            'year'    => (int) $item['yr'],
            'author'  => [
                'name'  => $item['author_name'],
                'email' => $item['author_email'],
            ],
            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/books/'.$item['id'],
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function toArray() {
        return $this->manager->createData($this->resource)->toArray();
    }


}