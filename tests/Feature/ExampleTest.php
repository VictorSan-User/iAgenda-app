<?php

use App\Models\User;

it('returns a successful response', function () {
    $user = User::factory()->create(); // Cria um usuário
    $this->actingAs($user); // Simula o login do usuário

    $response = $this->get('/');

    $response->assertStatus(200);
});
