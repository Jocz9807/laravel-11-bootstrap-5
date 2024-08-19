<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voter;

class VoteController extends Controller
{
    public function checkVote(Request $request)
    {
        $ic_number = $request->input('ic_number');

        // Check if the IC number exists in the voters table
        $voter = Voter::where('ic_number', $ic_number)->first();

        if ($voter) {
            // IC exists in the table, the person can vote
            return response()->json(['can_vote' => true, 'ic_number' => $ic_number]);
        } else {
            // IC does not exist, the person cannot vote
            return response()->json(['can_vote' => false]);
        }
    }


     /**
     * Handle the submission of a vote.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitVote(Request $request)
    {
        $ic_number = $request->input('ic_number');
        $vote = $request->input('vote');

        // Find the voter by IC number
        $voter = Voter::where('ic_number', $ic_number)->first();

        if ($voter) {
            // Check if the voter has already voted
            if ($voter->vote) {
                return redirect()->back()->with('error', 'Anda sudah mengundi.');
            }

            // Update the voter's record with the vote and timestamp
            $voter->update([
                'vote' => $vote,
                'voted_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Undian anda telah dihantar!');
        } else {
            return redirect()->back()->with('error', 'Anda tidak layak untuk mengundi.');
        }
    }

    public function result()
    {
        // Assuming you have a column `vote` that stores 'yes' or 'no'
        $yesCount = Voter::where('vote', 'YA')->count();
        $noCount = Voter::where('vote', 'TIDAK')->count();

        return view('result', compact('yesCount', 'noCount'));
    }
}
