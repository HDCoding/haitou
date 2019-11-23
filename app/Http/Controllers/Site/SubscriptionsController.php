<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Topic;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function subscribeTopic(Request $request, string $route, Topic $topic)
    {
        if ($route == 'subscriptions') {
            $logger = 'forum_subscriptions';
            $params = [];
        }
        if (! isset($logger)) {
            $logger = 'forum_topic';
            $params = ['slug' => $topic->slug, 'id' => $topic->id];
        }

        if (! $request->user()->isSubscribed('topic', $topic->id)) {
            $subscription = new Subscription();
            $subscription->user_id = $request->user()->id;
            $subscription->topic_id = $topic->id;
            $subscription->save();

            toastr()->success('Agora você está inscrito no tópico, '.$topic->name.' Agora você receberá notificações do site quando uma resposta for deixada.', 'Inscrição');
            return redirect()->route($logger, $params);
        } else {
            return redirect()->route($logger, $params)
                ->withErrors('Você já está inscrito neste tópico.');
        }
    }

    public function unsubscribeTopic(Request $request, string $route, Topic $topic)
    {
        if ($route == 'subscriptions') {
            $logger = 'forum_subscriptions';
            $params = [];
        }
        if (! isset($logger)) {
            $logger = 'forum_topic';
            $params = ['id' => $topic->id, 'slug' => $topic->slug];
        }

        if ($request->user()->isSubscribed('topic', $topic->id)) {
            $subscription = $request->user()->subscriptions()->where('topic_id', '=', $topic->id)->first();
            $subscription->delete();

            toastr()->info('Você não está mais inscrito no tópico, '.$topic->name.'. Você não receberá mais notificações do site quando uma resposta for deixada.', 'Inscrição Cancelada');
            return redirect()->route($logger, $params);
        } else {
            return redirect()->route($logger, $params)
                ->withErrors('Você não está inscrito neste tópico para começar...');
        }
    }
}
