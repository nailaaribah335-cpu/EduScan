<?php

namespace App\Controllers;

class Notifikasi extends BaseController
{
    public function index()
    {
        $this->state->ensureInitialized();

        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $search = $this->request->getGet('q');
        $notifications = $this->state->getNotifications($search);
        $gateway = $this->state->getGateway();
        $user = $this->state->getUser();

        $data = [
            'title' => 'Notifikasi Real-Time Orang Tua/Wali via WhatsApp Gateway',
            'active_nav' => 'notifikasi',
            'user' => $user,
            'gateway' => $gateway,
            'notifications' => $notifications,
            'search' => $search,
            'total_sent' => count($notifications),
        ];

        return view('notifikasi/index', $data);
    }

    public function testSend()
    {
        $this->state->ensureInitialized();

        $studentName = $this->request->getPost('student_name') ?? 'Muhammad Rizky Ramadhan';
        $className = $this->request->getPost('class') ?? 'X RPL 1';
        $parentName = $this->request->getPost('parent_name') ?? 'Bambang Irawan';
        $parentPhone = $this->request->getPost('parent_phone') ?? '0819-7788-2211';
        $status = $this->request->getPost('status') ?? 'Hadir';

        $notif = $this->state->triggerParentNotification(
            $studentName,
            $className,
            $parentName,
            $parentPhone,
            $status,
            date('H:i')
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Notifikasi WhatsApp berhasil dikirimkan ke nomor wali murid!',
            'notification' => $notif,
            'gateway' => $this->state->getGateway(),
        ]);
    }
}
