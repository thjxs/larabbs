<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\NotificationTransformer;

class NotificationsController extends Controller
{
    public function index()
    {
        $notificaitons = $this->user->notificaitons()->paginate(20);
        return $this->response->paginator($notificaitons, new NotificationTransformer());
    }

    public function stats()
    {
        return $this->response->array([
            'unread_count' => $this->user()->notificaiton_count,
        ]);
    }
}
