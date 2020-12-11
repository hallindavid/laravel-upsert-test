<?php

namespace App\Http\Livewire;

use App\Models\TestTask;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DataSeeder extends Component
{

    public function seed($count) {
        TestTask::factory($count)->create();
    }


    public function cleanup() {
        DB::table('test_tasks')->truncate();
        DB::table('test_histories')->truncate();
        $this->emit('refresh_history');
    }

    public function render()
    {

        return view('livewire.data-seeder', [
            'record_count' => TestTask::count(),
        ]);
    }
}
