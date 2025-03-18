<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EvtSportif;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserLogoutRequest;

class UserController extends Controller
{

    public function Inscription(Request $request)
    {
        $user = $request->user();
        $IdEvt = $request->input('IdEvt');

        $Evt = EvtSportif::findOrFail($IdEvt);

        $ListIdUser = $user->EvtSportifs->pluck('id')->toArray();

        foreach ($ListIdUser as $IdUser)
        {
            if($IdUser == $IdEvt)
            {
                return [
                    "message"=>"vous êtes déjà inscrit à cette evenement"
                ];
            }
        }

        $user->evtsportifs()->attach($IdEvt);


        return [
            "message"=>"vous vous êtes inscrit au match $Evt->title Situé à $Evt->location Pour le $Evt->date"
        ];
    }

    public function ListInscription(Request $request)
    {
        $user = $request->user();
        $EvtSportifs = $user->EvtSportifs;

        return $EvtSportifs;
    }

    public function Desinscription(Request $request, $id)
    {
        
        $user = $request->user();

        $Evt = EvtSportif::findOrFail($id);
        
        $ListIdUser = $user->EvtSportifs->pluck('id')->toArray();


        foreach ($ListIdUser as $IdUser)
        {
            if($IdUser == $id)
            {
                $user->evtsportifs()->detach($Evt);

                return [
                    'message'=>"vous vous êtes désincrit pour le match $Evt->title Situé à $Evt->location pour le $Evt->date"
                ];
            }
        }

        return [
            "message"=>"Vous n'êtes pas inscrit à cette Evenement"

        ];
    }

    public function register(UserRegisterRequest $request)
    {
        $credential = $request->validated();
        $user = User::create($credential);

        return [
            'message' => "vous vous êtes enregistrer"
        ];

    }

    public function login(UserLoginRequest $credential)
    {
        $credential->validated();

        $user = User::where('email', $credential->email)->first();

        if(!$user || !Hash::check($credential->password, $user->password))
        {
            return response()->json(['message'=>'Mot de passe ou email incorrect'], 404);
        }

        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];

    }


    public function logout(UserLogoutRequest $credential)
    {
        $credential->user()->tokens()->delete();

        return [
            'message'=>'vous avez été déconnécté'
        ];
    }

   
}
