<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @test
     * Testing to create link.
     *
     * @return void
     */
    public function can_create_link()
    {
        $response = $this->post('/api/admin/resources', [
            'type' => 'Link',
            'title' => 'This is a test link.',
            'url' => 'https://www.remotecompany.com/',
            'open_in_new_tab' => true,
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to update link.
     *
     * @return void
     */
    public function can_update_link()
    {
        $this->post('/api/admin/resources', [
            'type' => 'Link',
            'title' => 'This is a test link.',
            'url' => 'https://www.remotecompany.com/',
            'open_in_new_tab' => true,
        ]);

        $link = Link::first();

        $response = $this->patch('/api/admin/resources/'.$link->resource->id, [
            'type' => 'Link',
            'title' => 'This is a test link.',
            'url' => 'https://www.remotecompany.com/',
            'open_in_new_tab' => true,
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to update link.
     *
     * @return void
     */
    public function can_delete_link()
    {
        $this->post('/api/admin/resources', [
            'type' => 'Link',
            'title' => 'This is a test link.',
            'url' => 'https://www.remotecompany.com/',
            'open_in_new_tab' => true,
        ]);

        $link = Link::first();

        $response = $this->delete('/api/admin/resources/'.$link->resource->id);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to get link.
     *
     * @return void
     */
    public function can_view_link()
    {
        $this->post('/api/admin/resources', [
            'type' => 'Link',
            'title' => 'This is a test link.',
            'url' => 'https://www.remotecompany.com/',
            'open_in_new_tab' => true,
        ]);

        $link = Link::first();

        $response = $this->get('/api/admin/resources/'.$link->resource->id);

        $response->assertOk();
    }
}
