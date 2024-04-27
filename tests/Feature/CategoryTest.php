<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class CategoryTest extends TestCase
{
//    S: insert
    public function testInsert()
    {
        $category = new Category();
        $category->id = "GADGET";
        $category->name = "Gadget";
        $result = $category->save();

        self::assertTrue($result);
    }
//    E: insert

//    S: insert many
    public function testInsertMany()
    {
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Name $i"
            ];
        }
        $result = Category::insert($categories);

        self::assertTrue($result);

        $total = Category::count();

        self::assertEquals(10, $total);
    }
//    E: insert many

//    S: find
    public function testFind()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find("FOOD");

        self::assertNotNull($category);
        self::assertEquals("FOOD", $category->id);
        self::assertEquals("Food", $category->name);
        self::assertEquals("Food Category", $category->description);
    }
//    E: find

//  S: update
    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find("FOOD");
        $category->name = "Food update";

        $result = $category->update();
        self::assertTrue($result);
    }
//    E: update

//  S: select
    public function testSelect()
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->id = "ID $i";
            $category->name = "Name $i";
            $category->save();
        }

        $categories = Category::whereNull("description")->get();
        self::assertEquals(5, $categories->count());
        $categories->each(function (Category $category) {
            self::assertNull($category->description);

            $category->description = "updated";
            $category->update();
        });
    }
//    E: select

//  S: update many
        public function testUpdateMany()
        {
            $categories = [];
            for ($i = 0; $i < 10; $i++) {
                $categories[] = [
                    "id" => "ID $i",
                    "name" => "Name $i"
                ];
            }

            $result = Category::insert($categories);
            self::assertTrue($result);

            Category::whereNull("description")->update([
                "description" => "updated"
            ]);

            $total = Category::where("description", "=", "update")->count();
            self::assertEquals(10, $total);
        }
//  E: update many

//  S: delete
            public function testDelete()
            {
                $this->seed(CategorySeeder::class);

                $category = Category::find("FOD");
                $result = $category->delete();
                self::assertTrue($result);

                $total = Category::count();
                self::assertEquals(0, $total);
            }
//  E: delete

//  S: delete many
            public function testDeleteMany()
            {
                $categories = [];
                for ($i = 0; $i < 10; $i++) {
                    $categories[] = [
                        "id" => "ID $i",
                        "name" => "Name $i"
                    ];
                }

                $result = Category::insert($categories);
                self::assertTrue($result);

                $total = Category::count();;
                self::assertEquals(10, $total);

                Category::whereNull("description")->delete();

                $total= Category::count();
                assertEquals(0, $total);
            }
//  E: delete many

//  S: create
    public function testCreate()
    {
        $request = [
            "id" => "FOOD",
            "name" => "Food",
            "description" => "Food Category"
        ];

        $category = new Category($request);
        $category->save();

        self::assertNotNull($category->id);
    }
//  E: create

//  S: create using query builder
        public function testCreateUsingQueryBuilder()
        {
            $request = [
                "id" => "FOOD",
                "name" => "Food",
                "description" => "Food Category"
            ];

            $category = Category::create($request);

            self::assertNotNull($category->id);
        }
//  E: create using query builder

//  S: update mass
        public function testUpdateMass()
        {
            $this->seed(CategorySeeder::class);

            $request = [
                "id" => "FOOD",
                "name" => "Food",
                "description" => "Food Category"
            ];

            $category = Category::find("FOOD");
            $category->fill($request);
            $category->save();

            self::assertNotNull($category->id);
        }
//  E: update mass
}
