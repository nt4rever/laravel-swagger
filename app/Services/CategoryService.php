<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Auth;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Create a new service instance.
     *
     * @param  CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(private CategoryRepository $categoryRepository)
    {
        //
    }

    /**
     * Get all note category belongs to current user.
     *
     * @param  int  $limit
     * @return Category[] | Collection
     */
    public function categories(int $limit)
    {
        return $this->categoryRepository->getCategoriesByUserId(Auth::user()->id, $limit);
    }

    /**
     * Store a new note category.
     *
     * @param  array  $data
     * @return Category
     */
    public function storeCategory(array $data): Category
    {
        return $this->categoryRepository->create($data + ['user_id' => Auth::user()->id]);
    }

    /**
     * Update a note category.
     *
     * @param  array  $data
     * @return bool
     */
    public function updateCategory(Category $category, array $data): bool
    {
        return $this->categoryRepository->update($category, $data);
    }
}
