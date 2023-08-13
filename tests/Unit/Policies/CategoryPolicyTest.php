<?php

namespace Tests\Unit\Policies;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryPolicyTest extends TestCase
{
    public function testUserCategoryNoteWillReturnTrue()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->can('isUserCategory', $category));
    }

    public function testSomebodyElseCategoryWillReturnFalse()
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
        $category = Category::factory()->create(['user_id' => $user->id]);

        $this->assertFalse($anotherUser->can('isUserCategory', $category));
    }
}
