<div class="cart-item">
    <button wire:click="decrease" class="cart__product-amount-button">-</button>
    <span class="cart__product-amount-value">{{ $item->amount }}</span>
    <button wire:click="increase" class="cart__product-amount-button">+</button>
</div>