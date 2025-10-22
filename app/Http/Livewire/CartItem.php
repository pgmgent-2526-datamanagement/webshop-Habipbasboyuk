<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartItem extends Component
{
    public $item;

    public function mount($item)
    {
        $this->item = $item;
    }

    public function increase()
    {
        $cart = Session::get('cart', []);
        $cart[$this->item['id']]['amount']++;
        Session::put('cart', $cart);

        $this->item['amount']++;
    }

    public function decrease()
    {
        $cart = Session::get('cart', []);
        if ($cart[$this->item['id']]['amount'] > 1) {
            $cart[$this->item['id']]['amount']--;
            Session::put('cart', $cart);

            $this->item['amount']--;
        }
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
