<?php
namespace App\Repositories\ProductOrder;

use App\Repositories\RepositoryInterface;

/**
 * Interface ProductOrderRepositoryInterface
 *
 * @package App\Repositories
 */
interface ProductOrderRepositoryInterface extends RepositoryInterface
{
    /**
     * Get sliders
     *
     * @return Collection
     */
    public function addOrder($order);

    public function deleteOrder($order, $id);
}
