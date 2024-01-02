<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInputRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @throws Exception
     */
    public function input(UserInputRequest $request)
    {
        $data = $request->validated();

        preg_match('/^([^\d]+)\s*(\d+)(?:\s*(?:TAHUN|THN|TH)i)?\s*(.+)$/i', $data['data'], $hasil);

        $kota = str_ireplace('tahun', '', $hasil[3]);

        try {
            DB::beginTransaction();

            $user = new User();
            $user->name = strtoupper(trim($hasil[1]));
            $user->age = trim($hasil[2]);
            $user->city = strtoupper(trim($kota));
            $user->save();

            DB::commit();
            return redirect()->route('result');
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function result()
    {
        $users = User::all();
        return view('result', ['hasil' => $users]);
    }
}
