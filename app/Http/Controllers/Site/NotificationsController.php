<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show All Notifications.
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(25);
        return view('site.notifications.index', compact('notifications'));
    }

    /**
     * Show A Notification And Mark As Read.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function show(Request $request, $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        if ($notification->read_at == null) {
            toastr()->info('Notificação marcada como lida!', 'Aviso!');
        }
        return redirect()->to($notification->data['url']);
    }

    /**
     * Set A Notification To Read.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $notification = $request->user()->notifications()->where('id', '=', $id)->first();

        if (!$notification) {
            toastr()->error('A notificação não existe!', 'Erro');
            return redirect()->to('notifications');
        }
        if ($notification->read_at != null) {
            toastr()->info('Notificação já marcada como lida!', 'Aviso!');
            return redirect()->to('notifications');
        }

        $notification->markAsRead();

        toastr()->info('Notificação marcada como lida!', 'Aviso!');
        return redirect()->to('notifications');
    }

    /**
     * Mass Update All Notification's To Read.
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateAll(Request $request)
    {
        $request->user()->unreadNotifications()->update(['read_at' => now()]);
        toastr()->info('Todas as notificações marcadas como lidas!', 'Aviso!');
        return redirect()->to('notifications');
    }

    /**
     * Delete A Notification.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->notifications()->findOrFail($id)->delete();
        toastr()->warning('Notificação excluída!', 'Aviso!');
        return redirect()->to('notifications');
    }

    /**
     * Mass Delete All Notification's.
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroyAll(Request $request)
    {
        $request->user()->notifications()->delete();
        toastr()->warning('Todas as notificações excluídas!', 'Aviso!');
        return redirect()->to('notifications');
    }
}
