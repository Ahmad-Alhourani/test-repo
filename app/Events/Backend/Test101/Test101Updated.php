<?php namespace App\Events\Backend\Test101;

use Illuminate\Queue\SerializesModels;
/**
 * Class Test101Updated.
 */
class Test101Updated
{
    use SerializesModels;
    /**
     * @var
     */

    public $test101;

    /**
     * @param $test101
     */
    public function __construct($test101)
    {
        $this->test101 = $test101;
    }
}
