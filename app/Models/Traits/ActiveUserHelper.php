<?php

namespace App\Models\Traits;

use App\Models\User;
use Cache;
use Spatie\Activitylog\Models\Activity;

trait ActiveUserHelper
{
    protected $subjectTypes = [
        'App\\Models\\Topic' => 4,
        'App\\Models\\Reply' => 2,
    ];

    protected static $pastDays = 7;
    protected static $userLimits = 3;

    protected $cacheKey = 'larabbs_active_users';
    protected $cacheExpireInMinutes = 65;

    protected function lookup($subjectType)
    {
        return collect($subjectTypes)->get($subjectType, 1);
    }

    public function getActiveUsers()
    {
        return Cache::remember($this->cacheKey, $this->cacheExpireInMinutes, function () {
            return $this->calculateActiveUsers();
        });
    }

    public function calculateAndCacheActiveUsers()
    {
        $active_users = $this->calculateActiveUsers();
        $this->cacheActiveUers($active_users);
    }

    private function calculateActiveUsers()
    {
        $activityLogCollections = Activity::select('causer_id', 'subject_type')
            ->where('created_at', '>=', now()->subDays(static::$pastDays))
            ->get()->mapToGroups(function ($item) {
                return [$item['causer_id'] => $item['subject_type']];
            });

        $scoreCollection = collect();

        foreach ($activityLogCollections as $key => $collection) {
            $score = $collection->map(function ($subject_type) {
                return $this->lookup($subject_type);
            })->sum();

            $scoreCollection->push(['user_id' => $key, 'score' => $score]);
        }

        $users = User::find(
            $scoreCollection->sortByDesc('score')
                ->take(static::$userLimits)->pluck('user_id')
        );

        return collect($users);
    }

    private function cacheActiveUers($activeUsersCollection)
    {
        Cache::put($this->cacheKey, $activeUsersCollection, $this->cacheExpireInMinutes);
    }
}
