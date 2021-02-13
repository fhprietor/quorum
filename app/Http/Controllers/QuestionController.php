<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function __construct() {
   //     $this->middleware("auth");
    }

    public function index() {
    //    $this->authorize("viewAny", Question::class);
        if (!session()->has("search")) {
            session()->put("search",null);
            session()->put("trashed",null);
        }
        return Inertia::render("Questions/Index",[
            "filters" => session()->only(["search","trashed"]),
            "questions" => Question::on()
                ->orderByDesc("id")
                ->paginate(5),
        ]);
    }

    public function create() {
        return Inertia::render("Questions/Create");
    }

    public function store() {
        Question::create(
            $this->validate(request(), [
                "name" => "required|unique:questions",
                "content" => "required|min:10|max:1000",
                "status" => "required|min:2"
            ])
        );
        return redirect()->route('questions.index')->with('success','Pregunta creada');
    }

    public function edit(Question $question) {
        return Inertia::render('Questions/Edit', [
            'question' => [
                'id' => $question->id,
                'name' => $question->name,
                'content' => $question->content,
                'status' => $question->status,
                'deleted_at' => $question->deleted_at
            ]
        ]);
    }

    public function update(Question $question) {
        $question->update(
            $this->validate(request(), [
                "name" => "required|unique:questions,name," . $question->id,
                "content" => "required|min:10|max:1000",
                "status" => "required|min:2",
            ])
        );

        return redirect()->route('questions.index')->with('success', '¡Pregunta actualizada!');
    }

    public function destroy(Question $question) {
        $question->delete();
        return redirect()->route('questions.index')->with('success', '¡Pregunta eliminada!');
    }

}
