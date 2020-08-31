<?php

namespace App\Traits;

use Illuminate\Support\Collection;

/**
 * Trait HospitalTrait
 */
trait HospitalTrait
{
    public function getValidHospitalIds($user, $ids)
    {
        if ($user->hasRole('super')) {
            // Remove 'all' value from parameters
            $hospitalIds = $ids;
            $key         = array_search('all', $hospitalIds);
            if ($key !== false) {
                unset($hospitalIds[$key]);
            }

            return $hospitalIds;
        }

        $validIds    = $this->getHospitalIds($user);
        $hospitalIds = new Collection([]);
        foreach ($ids as $id) {
            if (in_array($id, $validIds) && !$hospitalIds->contains($id)) {
                $hospitalIds->push($id);
            }
        }

        return $hospitalIds->toArray();
    }
}
