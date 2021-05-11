<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App;

class ProductController extends Controller
{
    public function addItem(Request $req)
	{
		$validate = Validator::make($req->all(), [
			"id" => 'required|unique:products',
			"name" => 'required',
			"count" => 'required',
			"price" => 'required',
		]);

		if($validator->fails())
		{
			return response()->json(
			[
			"message" => $validator->errors(),
			]);
		}

		Products::create($req->all());
		return respone()->json("Все ок!!");
	}

	public function removeItem(Request $req)
	{
		$validator = Validator::make($req->all(), [
			"id" => "required",
		]);

		$product = Products::where("id", $req->id)->first();


		if ($product) 
		{
			$validator = Validator::make($req->all(), [
			"id" => "required",
			]);

			if($validator->fails())
			{
				return response()->json(
				[
				"message" => $validator->errors(),
				]);
			}
			$product->delete();
		}
	}

	public function сhangeItem(Request $req)
	{

		$validator = Validator::make($req->all(), [
			"id" => 'required',
			"name" => "required",
			"quantity" => "required",
			"price" => "required",
		]);

		if($validator->fails()) 
		{
			return response()->json(
				[
					"message" => $validator->errors(),
				]);
		}

		$product = Products::where("id", $req->id)->first();

		if($product)
		{
			if($req->name && $product->name)
			{
				$product->quantity = $req->quantity;
				$product->price = $req->price;
				$product->save();
				return response()->json(
					[
						"message" => "Вы с кайфом изменили товар!"
					]
				);
			}
		}
	}
}