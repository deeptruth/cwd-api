<?php

namespace Tests\API;

use App\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteAPITest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get list of notes
     * @test
     * @return void
     */
    public function it_should_successfully_get_list_of_notes()
    {
        $note = factory(Note::class)->create();
        $response = $this->get('/api/notes');

        $response->assertStatus(200)
            ->assertJson(Note::all()->toArray());
    }

    /**
     * Get list of notes
     * @test
     * @return void
     */
    public function it_should_successfully_create_notes()
    {
        $title = 'test title here';
        $description = 'test description here';
        $response = $this->post('/api/notes', [[
                    'title' => $title,
                    'description' => $description,
                ]]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', [
            'title' => $title,
            'description' => $description,
        ]);
    }

    /**
     * Get list of notes
     * @test
     * @return void
     */
    public function it_should_successfully_update_a_note()
    {
        $note = factory(Note::class)->create();

        $title = 'test title here';
        $description = 'test description here';

        $data = [
            'title' => $title,
            'description' => $description,
            'status' => 1,
        ];

        $response = $this->put('/api/notes/' . $note->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('notes', $data);
    }

    /**
     * Get list of notes
     * @test
     * @return void
     */
    public function it_should_successfully_delete_a_note()
    {
        $note = factory(Note::class)->create();

        $response = $this->delete('/api/notes/' . $note->id);

        $response->assertStatus(200);
        $this->assertSoftDeleted('notes', [
            'id' => $note->id,
        ]);
    }
}
