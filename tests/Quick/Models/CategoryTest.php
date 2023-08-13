<?php

namespace Tests\Quick\Models;

use App\Models\Category;
use App\Models\User;
use Tests\Quick\TestCase;

class CategoryTest extends TestCase
{
    public function testCategoryBelongsToUser()
    {
        $category = $this->createRelationMock(Category::class, 'belongsTo', User::class, 'user_id');
        $this->assertRelation('belongsTo', $category->user());
    }
}
