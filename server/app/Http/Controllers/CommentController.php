<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function show($id)
    {
        try {
            $comments = Comment::where('film_id', $id)->with('users')->get();
            return $this->sendRessponse($comments, "Comments fetched successfully.");
        } catch (Exception $e) {
            Log::debug('Error in' . __FUNCTION__ . ' function in ' . __CLASS__ . ' class, check details.');
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all("comments", "film_id");
            $validate = Validator::make($input, Comment::$ruleComment);
            if ($validate->fails()) return $this->sendError($validate->errors()->first(), 400);

            $input['user_id'] = auth()->id();
            $comment = Comment::create($input);
            return $this->sendRessponse($comment, "Comment Created Successfully");
        } catch (Exception $e) {
            Log::debug('Error in' . __FUNCTION__ . ' function in ' . __CLASS__ . ' class, check details.');
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage());
        }
    }
}
