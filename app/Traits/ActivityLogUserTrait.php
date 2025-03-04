<?php

namespace App\Traits;

trait ActivityLogUserTrait
{

    /**
     * @var string biasanya diletakkan di controller
     */
    protected $log_name = "default";

    /**
     *@var string letakkan di BaseController
     *karena sistem ini mendukung multiple guard, jika tidak ditentukan.. akan terjadi error dan atau bug
     */
    public $default_activity_guard = "";

    public function getActivityGuard()
    {
        return $this->activity_guard ?? $this->default_activity_guard;
    }


    public  function activityCreate($message, $performOn = null, $properties = null, $event = null)
    {

        activity($this->log_name)
            ->causedBy(auth($this->getActivityGuard())->id())
            ->when($performOn, fn($Q) => $Q->performedOn($performOn))
            ->when($performOn && !$properties, function ($Q) use ($performOn) {  // jika perform dan propertis kosong
                unset($performOn['created_at'], $performOn['updated_at'], $performOn['deleted_at']);
                $Q->withProperties(['attributes' => $performOn]);
            })
            ->when($properties, fn($Q) => $Q->withProperties($properties))
            ->event($event ?? 'created')
            ->log($message);
    }

    public  function activityUpdate($message, $performOn = null, $properties = null, $event = null)
    {
        activity($this->log_name)
            ->causedBy(auth($this->getActivityGuard())->id())
            ->when($performOn, fn($Q) => $Q->performedOn($performOn))
            ->when($performOn && !$properties, function ($Q) use ($performOn) {  // jika perform dan propertis null
                $attributes = $performOn->getChanges();
                unset($attributes['updated_at']); //unset updated at

                if (count($attributes) > 0) {
                    $Q->withProperties(['attributes' => $attributes]);
                }
            })
            ->when($properties, fn($Q) => $Q->withProperties(['attributes' => $properties]))
            ->event($event ?? 'updated')
            ->log($message);
    }

    public  function activityDelete($message, $performOn = null, $properties = null)
    {
        activity($this->log_name)
            ->causedBy(auth($this->getActivityGuard())->id())
            ->when($performOn, fn($Q) => $Q->performedOn($performOn))
            ->when($performOn && !$properties, function ($Q) use ($performOn) {  // jika perform dan propertis null
                $attributes = $performOn->getChanges();
                unset($attributes['updated_at']); //unset updated at

                if (count($attributes) > 0) {
                    $Q->withProperties(['attributes' => $attributes]);
                }
            })
            ->when($properties, fn($Q) => $Q->withProperties(['attributes' => $properties]))
            ->event('deleted')
            ->log($message);
    }
}
