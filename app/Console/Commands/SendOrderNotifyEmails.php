<?php

namespace App\Console\Commands;

use App\Mail\OrderNotifications;
use App\Models\Cart;
use App\Models\Order;
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
    protected $description = 'Send emails to users with upcomint return dates for thier carts/orders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $carts = Cart::whereDate('due_date', '<=', Carbon::now()->addDays(3))->get();


        foreach ($carts as $cart) {
            Mail::to($cart->user)->queue(new OrderNotifications($cart->user));
        }

        $this->info('Daily emails processed successfully.');
    }
}
