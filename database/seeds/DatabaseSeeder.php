<?php

use Illuminate\Database\Seeder;
use laratube\User;
use laratube\Channel;
use laratube\Subscription;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user1= factory(User::class)->create([
            'email'=> 'esor.poudel@gmail.com',
        ]);
        
        $user2= factory(User::class)->create([
            'email'=> 'mina.poudel@gmail.com',
        ]);

        $channel1= factory(Channel::class)->create([
            'user_id'=> $user1->id
        ]);
        
        $channel2= factory(Channel::class)->create([
            'user_id'=> $user2->id
        ]);

        $channel1->subscriptions()->create([
            'user_id'=> $user2->id
        ]);
        $channel2->subscriptions()->create([
            'user_id'=> $user1->id
        ]);

        factory(Subscription::class,10)->create([
            'channel_id'=>$channel1->id
        ]);
        factory(Subscription::class,10)->create([
            'channel_id'=>$channel2->id
        ]);
    }
}
