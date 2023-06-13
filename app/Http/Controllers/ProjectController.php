<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Continent;
use Auth;

class ProjectController extends Controller
{
    public function index(){

        $projects = DB::table('projects')
                            ->select(DB::raw('projects.*'))
                            ->get();

        /*$seller_ratings = DB::table('seller_ratings')
                            ->select('seller_ratings.*', 'buyers.*')
                            ->leftjoin('products', 'seller_ratings.product_id', 'products.id')
                            ->leftjoin('buyers', 'seller_ratings.buyer_id', 'buyers.id')
                            ->where('products.seller_id', '=', Auth::user()->seller->id)
                            ->get();

        $brands = Product::select('brand')
                            ->where('seller_id', Auth::user()->seller->id)
                            ->orderBy('brand')
                            ->distinct()
                            ->get();

        $categories = DB::table('categories')
                            ->select(DB::raw('distinct(categories.subcategory2) as category'))
                            ->rightjoin('products', 'products.category_id', 'categories.id')
                            ->where('products.seller_id', '=', Auth::user()->seller->id)
                            ->orderBy('categories.subcategory2')
                            ->get();*/

        $data = [
            'projects' => $projects,
            /*'brands' => $brands,
            'categories' => $categories,
            'seller_ratings' => $seller_ratings,*/
        ];

        return view('project.index', ['data' => $data]);
    }

    public function createIndex(){
        //$categories = Category::all();

        return view('project.create',[/*'categories' => $categories*/]);
    }

    public function create(Request $request){
        if($request->file()) {
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png,jfif|max:2048',
            ]);

            $product = new Project();
            $product->name = $request->name;
            //$product->brand = $request->brand;
            $product->description = $request->description;
            //$product->stock = $request->stock;
            //$product->price = $request->price;
            $product->image = '';
            //$product->category_id = $request->category_id;

            $product->continent_id = $request->continent_id;
            $product->country_id = $request->country_id;
            $product->sector_id = $request->sector_id;
            $product->sector_type_id = $request->sector_type_id;

            //$product->seller_id = Auth::user()->seller->id;
            $product->save();

            $file_name = $product->id.'.'.$request->file('image')->extension();
            $file_path = $request->file('image')->storeAs('img/projects', $file_name, 'public');


            $product->image = "/storage/".$file_path;
            $product->save();

            return $product;
        }
    }

    public function update(Request $request){
        $product = Project::find($request->id);
        $product->name = $request->name;
        //$product->brand = $request->brand;
        $product->description = $request->description;
        //$product->stock = $request->stock;
        //$product->price = $request->price;

        if($request->file()) {
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png,jfif|max:2048',
            ]);

            $file_name = $product->id.'.'.$request->file('image')->extension();
            $file_path = $request->file('image')->storeAs('img/projects', $file_name, 'public');

            $product->image = "/storage/".$file_path;

        }
        $product->save();
        return $product;
    }

    public function destroy(Request $request){
        $requests = Project::destroy($request->project_id);
        return 'Successfully Deleted';
    }

    public function map(){

        $maps = DB::table('projects')
                            ->select(DB::raw('projects.*'))
                            ->get();

        $data = [
            'map' => $maps,
        ];

        return view('map.index', ['data' => $data]);
    }

    public function recent_orders() {
        $projects = Project::get();
        return response()->json($projects);
    }
}