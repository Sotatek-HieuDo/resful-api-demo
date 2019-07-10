<?php

use Illuminate\Database\Seeder;
use App\Contact;
class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Contact::truncate();

      $faker = \Faker\Factory::create();

      // And now, let's create a few articles in our database:
      for ($i = 0; $i < 50; $i++) {
          Contact::create([
              'name' => $faker->name,
              'number' => $faker->phoneNumber,
              'email' => $faker->email
          ]);
      }
    }
}
