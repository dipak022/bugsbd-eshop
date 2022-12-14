<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use DB;


class CategoryController extends Controller
{
    public function index()
    {
        $categorys=Category::orderBy('id','DESC')->get(); 
        return view('backend.category.manage',compact('categorys'));
    }
    public function categoryStatus(Request $request){
        if($request->mode == 'true'){
            $status = DB::table('categories')->where('id',$request->id)->update(['active'=>1]);
        }else{
            $status = DB::table('categories')->where('id',$request->id)->update(['active'=>0]);
        }
        if ($status) {
            $notification = array(
                'message' => 'categories Delete Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'categories Change Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        } 
        
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name' => 'string|required|max:150',
        ]);
        $Category = new Category(); 
        $Category->category_name = $request->category_name;
        $Category->active = $request->active;
        $done = $Category->save();

        if ($done) {
            $notification = array(
                'message' => 'Category Added Successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Category Added Unuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'unit_name' => 'string|required|max:150',
        ]);
        $Category = Category::find($id);
        if($Category){
            $Category->category_name = $request->category_name;
            $Category->active = $request->active;
            $done = $Category->save();
            if ($done) {
                $notification = array(
                    'message' => 'Category Update Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'Category Update Unuccessfully',
                    'alert-type' => 'danger'
                );
                return redirect()->back()->with($notification);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Category::find($id);
        if($Category){
            $status = $Category->delete();
            if ($status) {
                $notification = array(
                    'message' => 'Category Delete Successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('category.index')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Category Delete Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
