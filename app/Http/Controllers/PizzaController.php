<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PizzaController extends Controller
{

    //get (and search) all pizzas
    public function index () {

        $pizzas = Pizza::latest()->with('category');
        if(request('search')){
            $pizzas
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
        return view('pizzas.pizzas', ['pizzas' => $pizzas->get(), 'categories' => Category::all()]);
    }



    //get specific pizza by id
    public function find($slug) {
        $pizza = Pizza::where('slug', $slug)->firstOrFail();
        return view('pizzas.details', ['pizza' => $pizza]);
    }



    





    //get (and search) pizzas by category
    public function findByCat($slug){
        $cat = Category::where('slug', $slug)->firstOrFail();
        
        $pizzas = Pizza::latest()
                            ->with('category')
                            ->where([
                                ['name', 'like', '%' . request('search') . '%'],
                                ['category_id', $cat->id],
                            ])
                            ->orWhere([
                                ['description', 'like', '%' . request('search') . '%'],
                                ['category_id', $cat->id],
                            ])
                            ->get();

        return view('pizzas.pizzasByCat', ['pizzas' => $pizzas, 'categories' => Category::all(), 'currentCat' => $cat->name]);
    }








    //add a pizza
    public function create () {
        if(!Auth::user()->isAdmin){
            return redirect ('/');
        };
        return view('pizzas.create');
    }



    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:pizzas|max:255',
            'description' => 'required|unique:pizzas',
            'price' => 'required|numeric',
            'category' => 'required|alpha|max:255'
        ]);

        $cat = Category::where('slug', strtolower($request->category))->first();
        
        if($cat){

            //add new pizza to DB
            $pizza = new Pizza;
            $pizza->name = $request->name;
            $pizza->slug = strtolower(str_replace(' ', '', $request->name));
            $pizza->description = $request->description;
            $pizza->price = $request->price;
            $pizza->category_id = $cat->id;

        } else {

            //add new category to DB
            $category = new Category;
            $category->name = ucfirst(strtolower($request->category));
            $category->slug = strtolower($request->category);
            $category->save();
            
            //add new pizza to DB
            $pizza = new Pizza;
            $pizza->name = $request->name;
            $pizza->slug = strtolower(str_replace(' ', '', $request->name));
            $pizza->description = $request->description;
            $pizza->price = $request->price;
            $pizza->category_id = $category->id;

        }
        
        //persist modification to DB
        $pizza->save();

        return redirect('/pizzas/admin/edit')->with('status', 'Pizza created!');
    }







    
    public function editView () {

        if(!Auth::user()->isAdmin){
            return redirect ('/');
        }
       
        $pizzas = Pizza::latest()->with('category');
        if(request('search')){
            $pizzas
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }
        
        return view('pizzas.edit', ['pizzas' => $pizzas->get(), 'categories' => Category::all()]);
    }



    public function edit ($slug) {
        if(!Auth::user()->isAdmin){
            return redirect ('/');
        };
        
        $pizza = Pizza::where('slug', $slug)->firstOrFail();
        return view('pizzas.edit-details', ['pizza' => $pizza]);
    }



    public function delete (Request $request) {
        $pizza = Pizza::findOrFail($request->id);
        $pizza->delete();
        return redirect('/pizzas/admin/edit')->with('status', 'Pizza deleted!');
    }







    public function update (Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|alpha|max:255'
        ]);
        
        $cat = Category::where('slug', strtolower($request->category))->first();
        
        if($cat){

            //update pizza
            $pizza = Pizza::findOrFail($request->id);
            $pizza->name = $request->name;
            $pizza->slug = strtolower(str_replace(' ', '', $request->name));
            $pizza->description = $request->description;
            $pizza->price = $request->price;
            $pizza->category_id = $cat->id;

        } else {

            //add new category to DB
            $category = new Category;
            $category->name = ucfirst(strtolower($request->category));
            $category->slug = strtolower($request->category);
            $category->save();
            
            //update Pizza
            $pizza = Pizza::findOrFail($request->id);
            $pizza->name = $request->name;
            $pizza->slug = strtolower(str_replace(' ', '', $request->name));
            $pizza->description = $request->description;
            $pizza->price = $request->price;
            $pizza->category_id = $category->id;

        }

        //persist modification to DB
        $pizza->save();

        return redirect('/pizzas/admin/edit')->with('status', 'Pizza updated!');
    }




    //save an order to DB
    public function makeorder (Request $request) {

        $order = new Order;
        $order->pizza_id = $request->pizzaId;
        $order->user_id = Auth::user()->id;

        $order->save();
        
        return redirect ('/pizzas');
    }




    
    
    //see orders -- admin only
    public function orders () {
        if(!Auth::user()->isAdmin){
            return redirect ('/');
        };

        $orders = Order::with('pizza', 'user')->get();

        return view ('pizzas.orders', ['orders' => $orders]);
    }


}
