<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class LogoutOtherBrowserSessions extends Component
{
    protected $sessions = [];
    public $password = '';
    public $alert = '';

    public function render()
    {
        $this->sessions = $this->getSessions();
        return view('livewire.logout-other-browser-sessions', ['sessions' => $this->sessions]);
    }

    public function mount()
    {
        //
    }

    public function confirmSessionLogout()
    {
        $this->password = '';
        $this->alert = '';
        $this->emit('confirmingLogout');
    }

    public function logoutOtherBrowserSessions()
    {
        if (!Hash::check($this->password, Auth::user()->password)) {
            $this->alert = 'This password does not match our records.';
            return;
        }

        Auth::logoutOtherDevices($this->password);
        $this->deleteOtherSessionRecords();

        $this->emit('otherBrowserSessionsRemoved');
    }

    private function createAgent($session)
    {
        return tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }

    private function getSessions()
    {
        return DB::table('sessions')
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('last_activity')
            ->get()
            ->map(function ($session) {
                return (object)[
                    'agent' => $this->createAgent($session),
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === request()->session()->getId(),
                    'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                ];
            });
    }

    private function deleteOtherSessionRecords()
    {
        DB::table( 'sessions')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', '!=', request()->session()->getId())
            ->delete();
    }
}
