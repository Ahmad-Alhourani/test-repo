<?php
namespace App\Listeners\Backend;

/**
 * Class Test101EventListener.
 */
/**
 * Class Test101Created.
 */
class Test101EventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info('Test101 Created');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info('Test101  Updated');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info('Test101 Deleted');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Test101\Test101Created::class,
            'App\Listeners\Backend\Test101EventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Test101\Test101Updated::class,
            'App\Listeners\Backend\Test101EventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Test101\Test101Deleted::class,
            'App\Listeners\Backend\Test101EventListener@onDeleted'
        );
    }
}
