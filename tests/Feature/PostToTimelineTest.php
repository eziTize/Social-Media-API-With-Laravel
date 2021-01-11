<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostToTimelineTest extends TestCase
{
   /** @test */
   public function a_user_can post_a_text_post()

   $this->actingAs($user = factory(User::class)->create(), 'api');

   $response = $this->post();
}
 