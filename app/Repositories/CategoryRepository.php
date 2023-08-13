<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     *
     * @param  Category  $category
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Get categories belongs to a user.
     *
     * @param  int  $userId
     * @param  int  $limit
     * @return Category[] | Collection
     */
    public function getCategoriesByUserId(int $userId, int $limit)
    {
        return $this->model->where('user_id', $userId)->paginate($limit);
    }
}
