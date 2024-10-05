<?php

use App\Models\ClassType;
use App\Models\User;
use Database\Seeders\ClassTypeSeeder;

test('instructor is redirected to instructor dashboard', function () {
    $user = User::factory()->create([
        'role' => 'instructor',
    ]);
    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertRedirect('/instructor/dashboard');
    $this->followRedirects($response)->assertSeeText('Hello, Instructor');
});

test('instructor can schedule a class', function () {
    $user = User::factory()->create([
        'role' => 'instructor',
    ]);
    $this->seed(ClassTypeSeeder::class);
    $response = $this->actingAs($user)->post('instructor/schedule', [
        'class_type_id' => ClassType::first()->id,
        'date' => '2024-11-01',
        'time' => '10:00:00',
    ]);
    $response->assertRedirectToRoute('schedule.index');
});