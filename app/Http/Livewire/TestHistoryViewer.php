<?php

namespace App\Http\Livewire;

use App\Models\TestHistory;
use Livewire\Component;

class TestHistoryViewer extends Component
{
    public $testNumber;

    protected $listeners = ['refresh_history' => 'render'];

    public function mount($testNumber)
    {
        $this->testNumber = $testNumber;
    }

    public function render()
    {
        return view('livewire.test-history-viewer', [
            'results' => TestHistory::where('test_number', $this->testNumber)->orderBy('start_time', 'DESC')->get(),
            'avg_query_time' => TestHistory::where('test_number', $this->testNumber)->avg('query_execution_time'),
            'avg_array_generation_time' => TestHistory::where('test_number', $this->testNumber)->avg('array_generation_time'),
        ]);
    }
}
