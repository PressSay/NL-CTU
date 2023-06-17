<?php

namespace Database\Seeders;


use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Emoji;
use App\Models\Prefix;
use App\Models\Thread;
use App\Models\DanhGia;
use App\Models\GioHang;
use App\Models\Profile;
use App\Models\SanPham;
use App\Models\Category;
use App\Models\Reaction;
use App\Models\KhuyenMai;
use App\Models\Permission;
use App\Models\LoaiSanPham;
use App\Models\PostComment;
use App\Models\ThreadComment;
use App\Models\ChiTietGioHang;
use App\Models\DonHang;
use App\Models\ImageTmp;
use App\Models\ThongSoSanPham;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::factory()->create([
            'name' => 'member',
            'description' => 'Member Role',
        ]);

        $roleAmin = Role::factory()->create([
            'name' => 'admin',
            'description' => 'Admin Role',
        ]);

        $users = User::factory()
            ->has(Profile::factory())
            ->hasAttached($role)
            ->count(10)->create();

        Permission::factory()->hasAttached($role)->create([
            'name' => 'create_thread',
            'Description' => 'Create Thread',
        ]);

        Permission::factory()->hasAttached($role)->create([
            'name' => 'create_post',
            'Description' => 'Create Post',
        ]);

        Permission::factory()->hasAttached($role)->create([
            'name' => 'create_post_comment',
            'Description' => 'Create Post Comment',
        ]);

        Permission::factory()->hasAttached($role)->create([
            'name' => 'create_thread_comment',
            'Description' => 'Create Thread Comment',
        ]);

        Permission::factory()->hasAttached($role)->create([
            'name' => 'create_reaction',
            'Description' => 'Create Reaction',
        ]);

        Permission::factory()->hasAttached($roleAmin)->create([
            'name' => 'create_category',
            'Description' => 'Create Category',
        ]);


        Category::factory()
            ->count(3)
            ->has(
                Thread::factory()
                    ->count(15)
                    ->state(['title' => 'Thread 1'])
                    ->has(
                        ThreadComment::factory()
                            ->for($users[2])
                            ->has(
                                Reaction::factory()
                                    ->for(Emoji::factory())
                                    ->for($users[1])
                            )
                    )
                    ->for($users[2])
            )
            ->has(Prefix::factory())
            ->for(
                Category::factory()
                    ->for($users[1])
            )
            ->for($users[1])
            ->create([
                'description' => fake()->sentence,
            ]);


        Post::factory()
            ->has(
                PostComment::factory()
                    ->for($users[3])
            )
            ->for($users[4])
            ->create();


        $loaiSanPham = LoaiSanPham::factory()
            ->create();

        SanPham::factory()
            ->has(KhuyenMai::factory())
            ->has(
                DanhGia::factory()
                    ->for($users[0]->profile)
            )
            ->has(
                ImageTmp::factory()
                    ->for($users[0])
            )
            ->has(
                ChiTietGioHang::factory()
                    ->for(
                        GioHang::factory()
                            ->for($users[0]->profile)
                            ->create()
                    )
            )
            ->has(
                DonHang::factory()
                    ->for($users[0]->profile)
            )
            ->has(
                ThongSoSanPham::factory()
            )
            ->for($loaiSanPham)
            ->for($users[0]->profile)
            ->create();
    }
}
