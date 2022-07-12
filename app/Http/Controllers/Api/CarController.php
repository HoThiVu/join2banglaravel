<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $cars=Car::all();

        $cars = Car::join('manufactures', 'manufactures.id', 'cars.manufactures_id')
        ->select('manufactures.name as name_mfs', 'cars.*')
        ->paginate(20);
        if(count($cars) > 0) {
            return response()->json(["status" => "200", "success" => true, "count" => count($cars), "data" => $cars]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no record found"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // hàm lưu
        // dd($request);
        {
            $validation = Validator::make($request->all(),
            [
                'hãng'=>'required',
                'màu'=>'required',
                // 'name'=>'required',
                'produced_on'=>'required|date',
                'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
            ]);
    
            if ($validation->fails()){
                $response=array('status'=>'error','errors'=>$validation->errors()->toArray()); 
                return response()->json($response);
            }
        //nếu dùng $this->validate() thì lấy về lỗi: $errors = $validate->errors();
    
            //kiểm tra file tồn tại
            $name='';
            
            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $name=time().'_'.$file->getClientOriginalName();
                $destinationPath=public_path('img'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
                $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
            } 
         
            $car= new Car();
            $car -> hãng = $request->hãng;
            $car -> màu = $request->màu;
            // $car -> name = $request->name;
            $car -> image = $name;
            $car -> manufactures_id = $request->name;
            $car -> produced_on = $request->produced_on;
            $car->save();
            if($car) {            
                    return response()->json(["status" => "200", "success" => true, "message" => "car record created successfully", "data" => $car]);
                }    
            else {
                    return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
            }

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
        $car = Car::find($id);
        if(count($cars) > 0) {
            return response()->json(["status" => "200", "success" => true, "count" => count($cars), "data" => $cars]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no record found"]);
        }
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
        //

         //request để lấy giá trị từ  các ô input
         $validation = Validator::make($request->all(),
         [
             'hãng'=>'required',
             'màu'=>'required',
             // 'name'=>'required',
             'produced_on'=>'required|date',
             'image'=>'mimes:jpeg,jpg,png,gif|max:10000'
         ]);
 
         if ($validation->fails()){
             $response=array('status'=>'error','errors'=>$validation->errors()->toArray()); 
             return response()->json($response);
         }
       
         $name='';
            
         if($request->hasfile('image'))
         {
             $file = $request->file('image');
             $name=time().'_'.$file->getClientOriginalName();
             $destinationPath=public_path('img'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
             $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
         } 
         $car= Car::find($id);
         
         
        $imgLink = public_path('img\\').$car->image; 
            
        if(File::exists($imgLink)) {
            File::delete($imgLink);
        }
         $car -> hãng = $request->hãng;
         $car -> màu = $request->màu;
         // $car -> name = $request->name;
         $car -> image = $name;
        $car -> manufactures_id = $request->name;
         $car -> produced_on = $request->produced_on;
         $car->save();       
         if($car) {            
            return response()->json(["status" => "200", "success" => true, "message" => "car record update successfully", "data" => $car]);
        }    
    else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to update."]);
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
        //

        
        // Car::find($id)->delete();
        $car= Car::find($id);

        $imgLink = public_path('img\\').$car->image; 
            
        if(File::exists($imgLink)) {
            File::delete($imgLink);
        }
         $car->delete();
         if($car) {            
            return response()->json(["status" => "200", "success" => true, "message" => "car record update successfully", "data" => $car]);
        }    
    else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to update."]);
    }

    }

    // public function search($key){
    //     // $cars=Car::all();
    //     // $cars_search=Car::where('hãng','like','%'.$request->input('search').'%')->orWhere('màu','like','%'.$request->input('search').'%')->get();
    //     // //dd($cars_search);
    //     // return Car::where('hãng','Like',"%key%")->get();
    //     return $key;
    // //     if($car) {            
    // //         return response()->json(["status" => "200", "success" => true, "message" => "car record search successfully", "data" => $car]);
    // //     }    
    // // else {
    // //         return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to search."]);
    // // }
    // }

    public function search(Request $request)
    {
       
            //  $cars = Car::where('hãng','like','%' .$request->search. '%')
            //     ->get();
            $cars = Car::join('manufactures', 'manufactures.id', 'cars.manufactures_id')
            ->where('hãng', 'like', '%' . $request->search . '%')
            ->select('mfs.mf_name as name_mfs', 'cars.*')
            ->get();
                if($cars) {            
                    return response()->json(["status" => "200", "success" => true, "message" => "car record update successfully", "data" => $cars]);
                }    
            else {
                    return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to update."]);
            }
        
    }
}
