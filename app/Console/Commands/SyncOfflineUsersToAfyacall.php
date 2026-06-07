<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncOfflineUsersToAfyacall extends Command
{
    protected $signature = 'afyacall:sync-offline';

    protected $description = 'POST all users with status=0 to the Afyacall API (marks them as added/online on the PBX side)';

    public function handle()
    {
        $users = User::where('status', 0)->get(['id', 'phone']);

        if ($users->isEmpty()) {
            $this->info('No offline users found.');
            return 0;
        }

        $this->info("Found {$users->count()} offline user(s). Sending to Afyacall...");

        $client = new \GuzzleHttp\Client();
        $success = 0;
        $failed  = 0;

        foreach ($users as $user) {
            try {
                $response = $client->request('POST', 'http://192.168.1.46:80/afyacall.php', [
                    'verify' => false,
                    'query'  => [
                        'phone'     => $user->phone,
                        'status'    => 1, // API expects inverse: 1 = add/online for a status=0 user
                        'doctor_id' => $user->id,
                    ],
                ]);

                $responseBody = trim($response->getBody()->getContents());

                Log::info('afyacall:sync-offline', [
                    'user_id'       => $user->id,
                    'phone'         => $user->phone,
                    'api_response'  => $responseBody,
                ]);

                $this->line("  user {$user->id} ({$user->phone}): {$responseBody}");
                $success++;
            } catch (\Throwable $e) {
                Log::error('afyacall:sync-offline error', [
                    'user_id' => $user->id,
                    'phone'   => $user->phone,
                    'error'   => $e->getMessage(),
                ]);

                $this->error("  user {$user->id} ({$user->phone}): {$e->getMessage()}");
                $failed++;
            }
        }

        $this->info("Done. Success: {$success}, Failed: {$failed}.");
        return $failed > 0 ? 1 : 0;
    }
}
