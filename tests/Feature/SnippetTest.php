<?php

namespace Tests\Feature;

use App\Models\Snippet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SnippetTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * @test
     * Testing to create snippet.
     *
     * @return void
     */
    public function can_create_snippet()
    {
        $response = $this->post('/api/admin/snippets', [
            'title' => 'test snippet',
            'description' => 'This is a test snippet.',
            'content' => 'This is a test snippet content.',
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to update snippet.
     *
     * @return void
     */
    public function can_update_file()
    {
        $this->post('/api/admin/snippets', [
            'title' => 'test snippet',
            'description' => 'This is a test snippet.',
            'content' => 'This is a test snippet content.',
        ]);

        $snippet = Snippet::first();

        $response = $this->patch('/api/admin/snippets/'.$snippet->id, [
            'title' => 'test snippet',
            'description' => 'This is a test snippet.',
            'content' => 'This is a test snippet content.',
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to delete snippet.
     *
     * @return void
     */
    public function can_delete_snippet()
    {
        $this->post('/api/admin/snippets', [
            'title' => 'test snippet',
            'description' => 'This is a test snippet.',
            'content' => 'This is a test snippet content.',
        ]);

        $snippet = Snippet::first();

        $response = $this->delete('/api/admin/snippets/'.$snippet->id);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to get snippet.
     *
     * @return void
     */
    public function can_view_snippet()
    {
        $this->post('/api/admin/snippets', [
            'title' => 'test snippet',
            'description' => 'This is a test snippet.',
            'content' => 'This is a test snippet content.',
        ]);

        $snippet = Snippet::first();

        $response = $this->get('/api/admin/snippets/'.$snippet->id);

        $response->assertOk();
    }
}
