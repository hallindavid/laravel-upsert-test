<?php

namespace App\Http\Livewire;

use App\Helpers\TestTaskHelper;
use Livewire\Component;

class TestRunner extends Component
{
    public $testNumber;
    public $testTitle;

    public $test_started_at;
    public $test_began_updates_at;
    public $test_finished_at;

    public function mount($testNumber)
    {
        $this->testNumber = $testNumber;
        $this->testTitle = TestTaskHelper::get_test_title($testNumber);
    }

    public function run_test()
    {
        $results = TestTaskHelper::run_test($this->testNumber);

        $this->test_started_at = $results['test_started_at'];
        $this->test_began_updates_at = $results['test_began_updates_at'];
        $this->test_finished_at = $results['test_finished_at'];

        $this->emit('refresh_history');
    }

    public function render()
    {
        return view('livewire.test-runner');
    }
}
