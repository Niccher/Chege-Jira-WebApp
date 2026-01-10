<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    /**
     * Automatically runs before any controller method
     */
//    public function initController(
//        \CodeIgniter\HTTP\RequestInterface $request,
//        \CodeIgniter\HTTP\ResponseInterface $response,
//        \Psr\Log\LoggerInterface $logger
//    ) {
//        parent::initController($request, $response, $logger);
//
//        // Load admin helper globally
//    }

    public function index()
    {
        return view('user/home');
    }

    public function projects()
    {
        return view('user/projects');
    }
    public function kanban()
    {
        return view('user/kanban');
    }

    public function project_calendar()
    {
        return view('user/calendar');
    }

    public function project_time_tracker()
    {
        return view('user/time');
    }

    public function project_notes()
    {
        return view('user/notes');
    }

    public function project_analytics()
    {
        return view('user/analytics');
    }

    public function project_settings()
    {
        return view('user/settings');
    }
}