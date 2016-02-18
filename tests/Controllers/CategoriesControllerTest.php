<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesControllerTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetAllCategories()
    {
        $company1= factory(\App\Src\Company\Company::class, 1)->create(['name_en'=>uniqid()]);
        $company2= factory(\App\Src\Company\Company::class, 1)->create(['name_en'=>uniqid()]);

        $category1 = factory(\App\Src\Category\Category::class, 1)->create(['name_en'=>uniqid()]);
        $category1->companies()->sync([$company1->id]);

        $category2 = factory(App\Src\Category\Category::class,1)->create(['name_en'=>uniqid()]);

        $this->get('/api/v1/categories')
            ->seeJsonContains(['name_en'=>$category1->name,'name_en'=>$category2->name,'name_en'=>$company1->name])
            ->dontSeeJson(['name_en'=>$company2->name])
        ;

    }

    public function testGetCategoryByID()
    {
        $category1 = factory(App\Src\Category\Category::class,1)->create(['name_en'=>uniqid()]);
        $category2 = factory(App\Src\Category\Category::class,1)->create(['name_en'=>uniqid()]);

        $this->get('/api/v1/categories/'.$category1->id)
            ->seeJsonContains(['name_en'=>$category1->name])
            ->dontSeeJson(['name_en'=>$category2->name])
        ;

    }


}
