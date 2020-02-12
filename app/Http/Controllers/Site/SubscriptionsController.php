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

    public function subscribeTopic(Request $request, Topic $topic)
    {
        $logger = 'forum.topic';
        $params = ['id' => $topic->id, 'slug' => $topic->slug,];

        if (!$request->user()->isSubscribed($topic->id)) {
            $subscription = new Subscription();
            $subscription->forum_id = $topic->forum->id;
            $subscription->topic_id = $topic->id;
            $subscription->user_id = $request->user()->id;
            $subscription->save();

            toastr()->success('Agora você está inscrito no tópico, ' . $topic->name . ' Agora você receberá notificações do site quando uma resposta for postada.', 'Inscrição');
            return redirect()->route($logger, $params);
        } else {
            toastr()->error('Você já está inscrito neste tópico.', 'Inscrição');
            return redirect()->route($logger, $params);
        }
    }

    public function unsubscribeTopic(Request $request, Topic $topic)
    {
        $logger = 'forum.topic';
        $params = ['id' => $topic->id, 'slug' => $topic->slug];

        if ($request->user()->isSubscribed($topic->id)) {
            $request->user()->subscriptions()->where('topic_id', '=', $topic->id)->first()->delete();

            toastr()->info('Você não está mais inscrito no tópico, ' . $topic->name . '. Você não receberá mais notificações do site quando uma resposta for deixada.', 'Inscrição Cancelada');
            return redirect()->route($logger, $params);
        } else {
            toastr()->error('Você não está inscrito neste tópico para começar...', 'Inscrição');
            return redirect()->route($logger, $params);
        }
    }

    public function emailNotifyOn(Request $request, $topic_id)
    {
        $user = $request->user();

        if (!$request->user()->topicEmailNotification($topic_id)) {
            $notify = Subscription::where('topic_id', '=', $topic_id)->where('user_id', '=', $user->id)->first();
            $notify->email = true;
            $notify->update();

            toastr()->success('Agora você receberá notificações do tópico por e-mail.', 'E-mail Notificação');
            return redirect()->route('forum.subscriptions');
        } else {
            toastr()->error('Você já está recebendo notificações neste tópico.', 'E-mail Notificação');
            return redirect()->route('forum.subscriptions');
        }
    }

    public function emailNotifyOff(Request $request, $topic_id)
    {
        $user = $request->user();

        if ($request->user()->topicEmailNotification($topic_id)) {

            $notify = Subscription::where('topic_id', '=', $topic_id)->where('user_id', '=', $user->id)->first();
            $notify->email = false;
            $notify->update();

            toastr()->success('Agora você não receberá notificações do tópico por e-mail.', 'E-mail Notificação');
            return redirect()->route('forum.subscriptions');
        } else {
            toastr()->error('Você não está recebendo notificações neste tópico.', 'E-mail Notificação');
            return redirect()->route('forum.subscriptions');
        }
    }

    public function notifyOn(Request $request, $topic_id)
    {
        $user = $request->user();

        if (!$request->user()->topicNotification($topic_id)) {
            $notify = Subscription::where('topic_id', '=', $topic_id)->where('user_id', '=', $user->id)->first();
            $notify->notify = true;
            $notify->update();

            toastr()->success('Agora você receberá notificações do tópico', 'Notificação Tópico');
            return redirect()->route('forum.subscriptions');
        } else {
            toastr()->error('Você já está recebendo notificações neste tópico.', 'Notificação Tópico');
            return redirect()->route('forum.subscriptions');
        }
    }

    public function notifyOff(Request $request, $topic_id)
    {
        $user = $request->user();

        if ($request->user()->topicNotification($topic_id)) {
            $notify = Subscription::where('topic_id', '=', $topic_id)->where('user_id', '=', $user->id)->first();
            $notify->notify = false;
            $notify->update();

            toastr()->success(' Agora você não receberá notificações do tópico', 'Notificação Tópico');
            return redirect()->route('forum.subscriptions');
        } else {
            toastr()->error('Você não está recebendo notificações neste tópico.', 'Notificação Tópico');
            return redirect()->route('forum.subscriptions');
        }
    }
}
