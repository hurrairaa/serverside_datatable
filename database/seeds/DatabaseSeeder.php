<?php
use App\User;
use App\Profile;
use App\Product;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(User::class,40)->create();

        $users=User::all();

        foreach($users as $user){
            Profile::create([
                "user_id"=>$user->id,
                "phone_no"=>"0900000000000",
                "address"=>"street 3 house 4"
            ]);
            Product::create([
                "title"=>"System",
                "user_id"=>$user->id,
            ]);
        }
    }
}
