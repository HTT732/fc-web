<?php
namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Schema;
/**
 * Abstract Respository
 *
 * @package App\Repositories
 * @author HTT
 */
abstract class RepositoryAbstract implements RepositoryInterface
{

    /**
     * Global variable model
     */
    protected $model;

    /**
     * Function construct
     *
     * @param $_model
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Function all (Retrieve all data)
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->all();
    }

    public function delete($id)
    {
        Schema::disableForeignKeyConstraints();
        $delete = $this->model->findOrFail($id)->delete();
        Schema::enableForeignKeyConstraints();
        return $delete;
    }

    /**
     * Sort data
     *
     * @param string $columns
     * @return mixed
     */
    public function sortBy($column, $sort)
    {
        return $this->model->orderBy($column, $sort);
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($data, $id)
    {
        $result = $this->model->find($id);

        if (!$result) {
            return false;
        }

        return $result->fill($data)->save();
    }

    public function create($input)
    {
        return $this->model->create($input);
    }

    public function createMany($input)
    {
        Schema::disableForeignKeyConstraints();
        return $this->model->insert($input);
        Schema::enableForeignKeyConstraints();
    }
}
