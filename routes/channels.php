<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;


// channel dibawah memiliki configurasi kalau yang bisa akses private channel ini harus yang sedang login
Broadcast::channel('users.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});


// ini channel kosong
Broadcast::channel('chat', function () {
    
});
