<?php

namespace App\Console\Commands;

use App\Mail\OrderNotifications;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendOrderNotifyEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-order-notify-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to users with upcoming return dates for thier carts/orders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $carts = Cart::whereBetween('due_date',[Carbon::now()->addDays(1), Carbon::now()->addDays(3)])->limit(2)->get();

        foreach ($carts as $cart) {
            Mail::to($cart->user)->queue(new OrderNotifications($cart));
        }

        $this->info('Daily emails processed successfully.');
    }
}
