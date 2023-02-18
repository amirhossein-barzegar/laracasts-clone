<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Series;

class CreateLessonsTest extends TestCase
{
    public function test_a_user_can_create_lessons() {
        // admin/3/lessons
        $this->loginAdmin();

        $series = Series::factory()->create();

        $lesson = [
            'title' => 'new lesson',
            'description' => 'new lesson description',
            'episode_number' => 23,
            'video_id' => 2222
        ];

        $this->postJson("/admin/{$series->id}/lessons", $lesson)
            ->assertStatus(201)
            ->assertJson($lesson);
        
        $this->assertDatabaseHas('lessons', [
            'title' => $lesson['title']
        ]);
    }

    public function test_a_title_is_required_to_create_a_lesson() {
        $this->loginAdmin();

        $series = Series::factory()->create();

        $lesson = [
            'description' => 'new lesson description',
            'episode_number' => 23,
            'video_id' => 2222
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('title');
    }

    public function test_a_description_is_required_to_create_a_lesson() {
        $this->loginAdmin();

        $series = Series::factory()->create();

        $lesson = [
            'title' => 'new lesson',
            'episode_number' => 23,
            'video_id' => 2222
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('description');
    }

    public function test_a_episode_number_is_required_to_create_a_lesson() {
        $this->loginAdmin();

        $series = Series::factory()->create();

        $lesson = [
            'title' => 'new lesson',
            'description' => 'new lesson description',
            'video_id' => 2222
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('episode_number');
    }

    public function test_a_video_id_is_required_to_create_a_lesson() {
        $this->loginAdmin();

        $series = Series::factory()->create();

        $lesson = [
            'title' => 'new lesson',
            'description' => 'new lesson description',
            'episode_number' => 23,
        ];

        $this->post("/admin/{$series->id}/lessons", $lesson)
            ->assertSessionHasErrors('video_id');
    }
}
