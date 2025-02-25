<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// jadi ini itu seperti middleware ada konfigurasinya tapi, ini khusu channel


// channel dibawah memiliki configurasi kalau yang bisa akses private channel ini harus yang sedang login
Broadcast::channel('users.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});


// ini channel kosong
Broadcast::channel('chat', function () {});


Broadcast::channel('orders.{orderId}', function (User $user, $orderId) {

    if ($user->id !== Order::findOrNew($orderId)->user_id) {
        return false;
    }

    return true;
});


// ini juga bisa dipakai langsung tanpa harus membuat event terlebih dahulu, contohnya ada di room view
Broadcast::channel('room.{roomId}', function ($user, $roomId) {

    return $user->only("id", "name");
});
