<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_list_page_loads_successfully(): void
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
    }

    public function test_a_task_can_be_created(): void
    {
        $response = $this->post('/tasks', ['title' => 'Belajar Git branching']);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'Belajar Git branching', 'is_done' => false]);
    }

    public function test_creating_a_task_requires_a_title(): void
    {
        $response = $this->post('/tasks', ['title' => '']);

        $response->assertSessionHasErrors('title');
    }

    public function test_a_task_can_be_toggled_as_done(): void
    {
        $task = Task::create(['title' => 'Kerjakan tugas EKPL']);

        $this->patch("/tasks/{$task->id}/toggle");

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'is_done' => true]);
    }

    public function test_a_task_can_be_deleted(): void
    {
        $task = Task::create(['title' => 'Tugas yang dihapus']);

        $this->delete("/tasks/{$task->id}");

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
