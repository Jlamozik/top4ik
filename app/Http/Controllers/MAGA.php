<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\User;

class MAGA extends Controller
{ 
    public function signUp(Request $req)
	{
		$validator = Validator::make($req->all(), [
			"name" => "required",
			"login" => "required|unique:users",
			"password" => "required|min:8",
		]);

		if($validator->fails()) 
		{
			return response()->json(
				[
					"message" => $validator->errors(),
				]);
		}
			
		User::create($req->all());

		return response()->json("All is ok!");
	}

	public function signIn(Request $req)
	{
		$validator = Validator::make($req->all(), [
			"login" => "required",
			"password" => "required",
		]);

		if($validator->fails()) 
		{
			return response()->json(
				[
					"message" => $validator->errors(),
				]);
		}

		$user = User::where("login", $req->login)->first();

		if($user)
		{
			if($req->password && $user->password)
			{
				$user->api_token = Str::random(50);
				$user->save();
				return response()->json(
					[
						"api_token" => $user->api_token, 
					]
				);
			}
		}

		return response()->json(
			[
				"message" => "Вы не зарегистрированы!"
			]
		);
	}

	public function password_recovery(Request $req)
	{
		$validator = Validator::make($req->all(), [
			"name" => "required",
			"login" => "required",
		]);

		if($validator->fails()) 
		{
			return response()->json(
				[
					"message" => $validator->errors(),
				]);
		}

		$user = User::where("login", $req->login)->first();

		if($req->login && $user->login)
		{
			if($req->name && $user->name)
			{
				return response()->json($user->password);
			}
		}
	}

	public function logout(Request $req)
	{
		$validator = Validator::make($req->all(), [
			"login" => "required",
		]);

		if($validator->fails()) 
		{
			return response()->json(
				[
					"message" => $validator->errors(),
				]);
		}

		$user = User::where("login", $req->login)->first();

		if($user)
		{
			if($req->login && $user->login)
			{
				$user->api_token = NULL;
				$user->save();
				return response()->json(
					[
						"message" => "Вы покинули нас"
					]
				);
			}
		}
	}
}
