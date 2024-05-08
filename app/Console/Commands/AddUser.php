<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add New User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $name = $this->ask('Enter The User\'s Name');
       $email = $this->ask('Enter The User\'s Email');
       $password =  $this->ask('Enter The User\'s Password');
       $city =  $this->ask('Enter The User\'s City');

       User::updateOrCreate([
         'name' => $name ,
         'email' => $email,
         'password' => bcrypt($password),
         'city_id' => $city
       ]);
       $this->info("User Added Successfully");
    }
}
