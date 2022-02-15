<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Test;

class TestUpdate implements ShouldQueue {

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    private $data;
    private Test $test;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, Test $test) {
        $this->data = $data;
        $this->test = $test;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $this->test->update([
            'name' => $this->data['name'],
            'code' => $this->data['code'],
        ]);
        $this->test->categories()->sync($this->data['categories']);
    }

}
