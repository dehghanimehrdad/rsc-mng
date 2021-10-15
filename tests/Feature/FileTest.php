<?php

namespace Tests\Feature;

use App\Models\File;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * @test
     * Testing to create file.
     *
     * @return void
     */
    public function can_create_file()
    {
        $response = $this->post('/api/admin/files', [
            'title' => 'This is a test file.',
            'file' => UploadedFile::fake()->create('test.pdf'),
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to update file.
     *
     * @return void
     */
    public function can_update_file()
    {
        $this->post('/api/admin/files', [
            'title' => 'This is a test file.',
            'file' => UploadedFile::fake()->create('test.pdf'),
        ]);

        $file = File::first();

        $response = $this->patch('/api/admin/files/'.$file->id, [
            'title' => 'This is a test link.',
            'file' => UploadedFile::fake()->create('test2.pdf'),
        ]);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to update file.
     *
     * @return void
     */
    public function can_delete_file()
    {
        $this->post('/api/admin/files', [
            'title' => 'This is a test file.',
            'file' => UploadedFile::fake()->create('test.pdf'),
        ]);

        $file = File::first();

        $response = $this->delete('/api/admin/files/'.$file->id);

        $response->assertOk();
    }

    /**
     * @test
     * Testing to get file.
     *
     * @return void
     */
    public function can_view_file()
    {
        $this->post('/api/admin/files', [
            'title' => 'This is a test file.',
            'file' => UploadedFile::fake()->create('test.pdf'),
        ]);

        $file = File::first();

        $response = $this->get('/api/admin/files/'.$file->id);

        $response->assertOk();
    }
}
