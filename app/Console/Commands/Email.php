<?php

namespace App\Console\Commands;

use App\Mail\CategoryCreated;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


class Email extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:email {categoryId?}';  

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to all users for newly created categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categoryId = $this->argument('categoryId');

        if ($categoryId) {
            $categories = Category::where('id', '=',$categoryId)->get();
        } else {
            $categories = Category::where('created_at', '>=', now()->subDay())->get();
        }

        if ($categories->isEmpty()) {
            $this->info('No new categories found to send emails.');
            return;
        }

        // Fetch all users
        $users = User::all();

        foreach ($categories as $category) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new CategoryCreated($category, $user));
            }
        }

        $this->info('Emails sent successfully for newly created categories!');
    }
}

