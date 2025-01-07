<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\CategoryCreated;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        
        // $users = User::all();

        // foreach ($users as $user) {
        //     Mail::to($user->email)->send(new CategoryCreated($category, $user));
        // }

        Artisan::call('app:email', [
            'categoryId' => $category->id 
        ]);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
