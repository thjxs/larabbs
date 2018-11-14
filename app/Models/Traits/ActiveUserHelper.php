<?php

namespace App\Models\Traits;

use App\Models\Reply;
use App\Models\Topic;
use Cache;
use Carbon\Carbon;
use DB;

trait ActiveUserHelper
{
    protected static $activeUsers = [];

    protected static $topicWeights = 4;
    protected static $replyWeights = 1;
    protected static $pastDays = 7;
    protected static $userLimits = 6;

    protected $cacheKey = 'larabbs_active_users';
    protected $cacheExpireInMinutes = 65;

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
        static::calculateReplyScore();
        static::calculateTopicScore();

        arsort(static::$activeUsers);

        array_slice(static::$activeUsers, 0, static::$userLimits, true);

        $activeUsersCollection = collect();

        foreach (static::$activeUsers as $user_id => $user) {
            $user = $this->find($user_id);
            if ($user) {
                $activeUsersCollection->push($user);
            }
        }

        return $activeUsersCollection;
    }

    private static function calculateTopicScore()
    {
        $topicUsers = Topic::query()
            ->select(DB::raw('user_id, count(*) as topic_count'))
            ->where('created_at', '>=', Carbon::now()->subDays(static::$pastDays))
            ->groupBy('user_id')
            ->get();
        foreach ($topicUsers as $user) {
            static::$activeUsers[$user->user_id]['score'] =
                (static::$activeUsers[$user->user_id]['score'] ?? 0) +
                    $user->topic_count * static::$topicWeights;
        }
    }

    private static function calculateReplyScore()
    {
        $replyUsers = Reply::query()
            ->select(DB::raw('user_id, count(*) as reply_count'))
            ->where('created_at', '>=', Carbon::now()->subDays(static::$pastDays))
            ->groupBy('user_id')
            ->get();

        foreach ($replyUsers as $user) {
            static::$activeUsers[$user->user_id]['score'] =
                $user->reply_count * static::$replyWeights;
        }
    }

    private function cacheActiveUers($activeUsersCollection)
    {
        Cache::put($this->cacheKey, $activeUsersCollection, $this->cacheExpireInMinutes);
    }
}
