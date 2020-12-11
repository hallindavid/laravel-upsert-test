<?php

namespace App\Helpers;

use App\Models\TestHistory;
use App\Models\TestTask;
use Illuminate\Support\Facades\DB;


class TestTaskHelper
{

	//This returns an array that looks like this.

	/*
		[
		  "id" => 481,
		  "sort_order" => 1,
		],
		[
		  "id" => 751,
		  "sort_order" => 2,
		],
		[
		  "id" => 202,
		  "sort_order" => 3,
		],
		[
		  "id" => 217,
		  "sort_order" => 4,
		],
		[
		  "id" => 576,
		  "sort_order" => 5,
		],
		[
		  "id" => 365,
		  */

	public static function get_new_ordered_array()
	{
		$tasks =  TestTask::select('id')->get()->shuffle()->toArray();

		for ($i = 0; $i < count($tasks); $i++) {
			$tasks[$i]['sort_order'] = $i + 1;
		}

		return $tasks;
	}

	public static function run_test($testNumber)
	{
		if ($testNumber == 1) {
			return \App\Helpers\TestTaskHelper::test1();
		} else if ($testNumber == 2) {
			return \App\Helpers\TestTaskHelper::test2();
		} else if ($testNumber == 3) {
			return \App\Helpers\TestTaskHelper::test3();
		} else if ($testNumber == 4) {
			return \App\Helpers\TestTaskHelper::test4();
		}
	}

	public static function get_test_title($testNumber)
	{
		switch ($testNumber) {
			case 1:
				return 'Test 1 - foreach statement w/ update';
				break;
			case 2:
				return 'Test 2 - foreach, check existing collection, update if changed';
				break;
			case 3:
				return 'Test 3 - Upsert';
				break;
			case 4:
				return 'Test 4 - Big Case Statement';
				break;
			default:
				return 'Test';
		}
	}


	public static function test1()
	{
		$test_started_at = now();
		$retval['test_started_at'] = $test_started_at->timezone('America/Toronto')->format('g:i a');
		$new_order = \App\Helpers\TestTaskHelper::get_new_ordered_array();

		$begin_updates = now();
		$retval['test_began_updates_at'] = $begin_updates->diffInRealMilliseconds($test_started_at) . 'ms';

		foreach ($new_order as $order) {
			TestTask::find($order['id'])->update(['sort_order' => $order['sort_order']]);
		}

		$test_finished_at = now();

		$retval['test_finished_at'] = $test_finished_at->diffInRealMilliseconds($begin_updates) . ' ms';

		TestHistory::create([
			'test_number' => 1,
			'start_time' => $test_started_at,
			'array_generation_time' => $begin_updates->diffInRealMilliseconds($test_started_at),
			'query_execution_time' => $test_finished_at->diffInRealMilliseconds($begin_updates),
			'num_records' => TestTask::count(),
		]);

		return $retval;
	}

	public static function test2()
	{
		$items = TestTask::get();

		$test_started_at = now();
		$retval['test_started_at'] = $test_started_at->timezone('America/Toronto')->format('g:i a');
		$new_order = \App\Helpers\TestTaskHelper::get_new_ordered_array();

		$begin_updates = now();
		$retval['test_began_updates_at'] = $begin_updates->diffInRealMilliseconds($test_started_at) . 'ms';

		foreach ($new_order as $order) {
            if ($items->firstWhere('id', $order['id'])->sort_order !== $order['sort_order']) {
                TestTask::find($order['id'])->update(['sort_order' => $order['sort_order']]);
            }
        }

		$test_finished_at = now();

		$retval['test_finished_at'] = $test_finished_at->diffInRealMilliseconds($begin_updates) . ' ms';

		TestHistory::create([
			'test_number' => 2,
			'start_time' => $test_started_at,
			'array_generation_time' => $begin_updates->diffInRealMilliseconds($test_started_at),
			'query_execution_time' => $test_finished_at->diffInRealMilliseconds($begin_updates),
			'num_records' => TestTask::count(),
		]);

		return $retval;
	}

	public static function test3()
	{
		$test_started_at = now();
		$retval['test_started_at'] = $test_started_at->timezone('America/Toronto')->format('g:i a');
		$new_order = \App\Helpers\TestTaskHelper::get_new_ordered_array();

		for($i = 0; $i < count($new_order); $i++) {
            $new_order[$i]['title'] = '';
        }

		$begin_updates = now();
		$retval['test_began_updates_at'] = $begin_updates->diffInRealMilliseconds($test_started_at) . 'ms';

		TestTask::upsert($new_order, ['id'], ['sort_order']);

		$test_finished_at = now();

		$retval['test_finished_at'] = $test_finished_at->diffInRealMilliseconds($begin_updates) . ' ms';

		TestHistory::create([
			'test_number' => 3,
			'start_time' => $test_started_at,
			'array_generation_time' => $begin_updates->diffInRealMilliseconds($test_started_at),
			'query_execution_time' => $test_finished_at->diffInRealMilliseconds($begin_updates),
			'num_records' => TestTask::count(),
		]);

		return $retval;
	}

	public static function test4()
	{
		$test_started_at = now();
		$retval['test_started_at'] = $test_started_at->timezone('America/Toronto')->format('g:i a');
		$new_order = \App\Helpers\TestTaskHelper::get_new_ordered_array();

		$begin_updates = now();
		$retval['test_began_updates_at'] = $begin_updates->diffInRealMilliseconds($test_started_at) . 'ms';

		$ids = [];

        $cases = '';
        foreach ($new_order as $task) {
            $ids[] = $task['id'];
            $cases .= sprintf(' WHEN id = %d THEN %d ', $task['id'], $task['sort_order']);
        }
        $build_query = sprintf("CASE %s END", $cases);

        TestTask::query()->whereIn('id', $ids)->update([
            'sort_order' => DB::raw($build_query)
        ]);

		$test_finished_at = now();

		$retval['test_finished_at'] = $test_finished_at->diffInRealMilliseconds($begin_updates) . ' ms';

		TestHistory::create([
			'test_number' => 4,
			'start_time' => $test_started_at,
			'array_generation_time' => $begin_updates->diffInRealMilliseconds($test_started_at),
			'query_execution_time' => $test_finished_at->diffInRealMilliseconds($begin_updates),
			'num_records' => TestTask::count(),
		]);

		return $retval;
	}
}
