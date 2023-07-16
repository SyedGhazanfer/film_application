<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        try {
            $films = Film::paginate(1);
            return $this->sendRessponse($films, "Films fetched successfully.");
        } catch (Exception $e) {
            Log::debug('Error in' . __FUNCTION__ . ' function in ' . __CLASS__ . ' class, check details.');
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $film = Film::find($id);
            return $this->sendRessponse($film, "Film Detail Fetched Successfully");
        } catch (Exception $e) {
            Log::debug('Error in' . __FUNCTION__ . ' function in ' . __CLASS__ . ' class, check details.');
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $validate = Validator::make($input, Film::$ruleFilms);
            if ($validate->fails()) return $this->sendError($validate->errors()->first(), 400);

            $input['user_id'] = auth()->id();
            $film = Film::create($input);
            if ($request->exists('image')) $film->addMedia($input['image'])->toMediaCollection();

            return $this->sendRessponse($film, "Film Created Successfully");
        } catch (Exception $e) {
            Log::debug('Error in' . __FUNCTION__ . ' function in ' . __CLASS__ . ' class, check details.');
            Log::error($e->getMessage());
            return $this->sendError($e->getMessage());
        }
    }
}
