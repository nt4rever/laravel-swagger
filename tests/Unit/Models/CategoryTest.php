<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testCreateCategoryShouldHaveUuid()
    {
        $category = Category::factory()->create();

        $this->assertNotEmpty($category->uuid);
    }

    public function testSearchCategoryByUuid()
    {
        $category = Category::factory()->create();
        $foundCategory = Category::findByUuid($category->uuid);

        $this->assertNotNull($foundCategory);
        $this->assertTrue($category->is($foundCategory));
    }
}
