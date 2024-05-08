<?php

namespace App\Http\Controllers\Api;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|numeric|gt:0',
            'user_id' => 'required|numeric|gt:0',
            'content' =>  'required|string|max:2000',
            'rating' => 'required|numeric|gt:0',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()],400);
        }

        $review = new Review();
        $review->hotel_id = $request->hotel_id;
        $review->user_id = $request->user_id;
        $review->content = $request->content;
        $review->rating = $request->rating;
        $review->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Review Added Successfully',
            'data' => $review,
         ],201);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return response()->json([
            'status' => 'Success',
            'message'=>'Review Deleted Successfully'
        ],204);
    }

}
