<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        return view('landing/index', [
            'pageTitle' => 'Chege JIRA — Project & Productivity Tracker',
            'metaDescription' => 'Chege JIRA is a self-hosted project management platform with Kanban boards, time tracking, notes, calendar, and analytics. Docker-ready, open-source.',
            'metaKeywords' => 'project management, kanban, time tracking, productivity, self-hosted, docker, codeigniter',
        ]);
    }

    public function features()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        return view('landing/features', [
            'pageTitle' => 'Features — Chege JIRA',
            'metaDescription' => 'Explore all features of Chege JIRA: project management, Kanban boards, time tracking, calendar, notes, analytics, and more.',
            'metaKeywords' => 'features, project management, kanban, time tracking, analytics',
        ]);
    }

    public function setup()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        return view('landing/setup', [
            'pageTitle' => 'Setup Guide — Chege JIRA',
            'metaDescription' => 'Deploy Chege JIRA with Docker or manually. Step-by-step installation guide with prerequisites, commands, and configuration.',
            'metaKeywords' => 'docker setup, installation, deployment, self-hosted, guide',
        ]);
    }

    public function faqs()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        return view('landing/faqs', [
            'pageTitle' => 'FAQs — Chege JIRA',
            'metaDescription' => 'Frequently asked questions about Chege JIRA: deployment, usage, technical details, and contribution guidelines.',
            'metaKeywords' => 'faq, help, documentation, guide, questions',
        ]);
    }
}
