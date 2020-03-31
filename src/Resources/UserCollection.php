<?php
namespace App\Resources;

use App\Entity\User;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

/**
 * Class UserCollection
 * @package App\Resources
 */
class UserCollection
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * @var Item
     */
    private $resource;

    /**
     * UserCollection constructor.
     * @param User $data
     */
    public function __construct(User $data)
    {
        $this->manager = new Manager();
        $this->resource = new Item($data,  [$this, "set"]);
    }

    public function set(User $item)
    {
        return [
            'id'      => (int) $item->getId(),
            'username'   => $item->getUsername()
        ];
    }

    /**
     * @return array
     */
    public function toArray() {
        return $this->manager->createData($this->resource)->toArray();
    }


}