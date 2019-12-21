<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Post::paginate(10);
        return view('post.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Post();
        return view('post.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,jpng,gif',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id'


        ]);

//       $test= Post::create([
//            'title'=>request('title'),
//            'image'=>request('image'),
//            'content'=>request('content'),
//            'category_id'=>Category::findOrFail($request->category_id)->posts()->create(request('image'))
//
//        ]);
//       dd($test);
//        $test=$request->all();
//        dd($test);
//        $post=new Post();
        // $imageName=time().'.'.$request->image->getClientOriginalExtension();
        //   $request->image->move(public_path('images'),$imageName);
//        $request->file('image')->storeAs('test',$post->slug);

        $record = Post::create($request->all());
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/posts/'; // upload path
            $photo = $request->file('image');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $record->image = 'uploads/posts/' . $name;
            $record->save();
        }
        flash()->success('success');
        return redirect(route('post.index'));
//        dd($record);
//        flash()->success('success');
//        return redirect(route('city.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Post::findOrFail($id);
        return view('post.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record = Post::findOrFail($id);
        //dd($record);
        $record->update($request->except('image'));
        if ($request->hasFile('image')) {
            if(file_exists($record->image)){
                unlink($record->image);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/posts/'; // upload path
            $photo = $request->file('image');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $record->image = 'uploads/posts/' . $name;
            $record->save();
        }
        flash()->success('Edited');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Post::findOrFail($id);
        $record->delete();
        flash()->success('deleted');
        return back();
    }
}
