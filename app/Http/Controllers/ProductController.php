<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductController extends Controller
{
    public function addItem(Request $req)
	{
		$validator = Validator::make($req->all(), [
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

		Product::create($req->all());
		return response()->json("Все ок!!");
	}

	public function removeItem(Request $req)
	{
		$validator = Validator::make($req->all(), [
			"id" => "required",
		]);

		$product = Product::where("id", $req->id)->first();


		if ($product) 
		{
			$product->delete();
			return response()->json("Неплохо");
		}
	}

	public function сhangeItem(Request $req)
	{

		$validator = Validator::make($req->all(), [
			"id" => 'required',
			"name" => "required",
			"count" => "required",
			"price" => "required",
		]);

		if($validator->fails()) 
		{
			return response()->json(
				[
					"message" => $validator->errors(),
				]);
		}

		$product = Product::where("id", $req->id)->first();

		if($product)
		{
			if($req->id && $product->id)
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