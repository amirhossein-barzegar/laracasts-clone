<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Normalizer\SlugNormalizer;
use App\Models\User;

class CreateSeriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_a_user_can_create_a_series()
    // {
    //     $this->withoutExceptionHandling();
    //     $sluger = new SlugNormalizer;

    //     Storage::fake(config('filesystems.default'));

    //     $this->post('/admin/series', [
    //         'title' => 'vue js for the best',
    //         'description' => 'the best vue js casts ever',
    //         'image_url' => UploadedFile::fake()->image('image-series.png')
    //     ])->assertRedirect();

    //     Storage::disk(config('filesystems.default'))->assertExists(
    //         'series/' . $sluger->normalize('vue js for the best') . '.png'
    //     );

    //     $this->assertDatabaseHas('series', [
    //         'slug' => $sluger->normalize('vue js for the best'),
    //     ]);
    // }
    public function test_a_series_must_be_created_with_a_title() {

    }

    public function test_only_administrators_can_create_series() {
        $this->actingAs(
            User::factory()->create()
        );
        $this->get('admin/series')
            ->assertSessionHas('error', 'You are not authorized to perform this action');
    }
}
