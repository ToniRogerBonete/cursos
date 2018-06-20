<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }
        $courses = new Course();
        $courses = $this->filtro($courses,$request)
                ->paginate(13);
        return response()->json($courses);
    }

    public function filtro($query,$request){
        if($request->filtro) {
            $query = $query->where('name', 'like', '%' . $request->filtro . '%');
        }
        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        $course = new Course;
        $course->account_id = Auth::user()->account_id;
        $course->category_id = $request->category;
        $course->level_id = $request->level;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->objective = $request->objective;
        $course->requisites = $request->requisites;
        $course->audience = $request->audience;
        $course->type_sale = $request->type_sale;
        $course->price = $request->price;
        $course->certificate = $request->certificate;
        $course->video_presentation = $request->video;
        $course->image_presentation = $request->image;
        $course->status = $request->status;
        $course->save();
        return response()->json(['data'=>'Curso salvo com sucesso!','id' => $course->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }
        return view('curso.create-update');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        if($request->image) {
            $thumbnail = $this->thumbnail($request);
        }

        $course = Course::find($id);
        $course->account_id = Auth::user()->account_id;
        $course->category_id = $request->category;
        $course->level_id = $request->level;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->objective = $request->objective;
        $course->requisites = $request->requisites;
        $course->audience = $request->audience;
        $course->type_sale = $request->type_sale;
        $course->price = $request->price;
        $course->certificate = $request->certificate;
        $course->video_presentation = $request->video;
        $course->video_current_time = $request->current_time;
        $course->image_presentation = $thumbnail;
        $course->status = $request->status;
        $course->save();
        return response()->json(['data'=>'Curso salvo com sucesso!','id' => $course->id]);
    }

    public function thumbnail($request) {
        $extension = 'png';
//        $name = uniqid(date('HisYmd'));
        $name = md5($request->id.Auth::user()->account_id);
        $nameFile = "{$name}.{$extension}";
        $path = 'imagem\/capa_curso_' . $nameFile;
        $image = Image::make(file_get_contents($request->image));
        $width = $image->width();
        $height = $image->height();
        $image->fit($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put($path, (string)$image->encode());
        return $nameFile;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
