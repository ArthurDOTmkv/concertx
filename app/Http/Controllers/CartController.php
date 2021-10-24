<?php

 
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Place;
use App\Representation;
use App\Cart;
use App\Concert;
  
class CartController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $cart = Cart::where('user_id','=',$userId)->get();
        $total = Cart::where('user_id','=',$userId)->sum('prix');
        return view('cart.index', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function total()
    {      
        $userId = auth()->user()->id;  
       return Cart::where('user_id','=',$userId)->sum('prix');
    }

    
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        // return view('products.cart');
    }

    // compte le total d'articles
    public static function count()
    {
        try {
            $userId = auth()->user()->id;
            return Cart::where('user_id','=',$userId)->get()->count();
        } catch (\Throwable $th) {
            return 0;
        }
    }

    // retourne le titre du concert en lien avec le produit du panier
    public static function title($representationId)
    {
        $representation = Representation::find($representationId);
        $concert = Concert::find($representation->concert_id);
        return ($concert->titre);
    }

    // retourne le nom de la place d'un element du panier
    public static function place($placeId)
    {
        $alphas = range('A', 'Z');
        $place = Place::find($placeId);
        return $alphas[$place->rangee] .'-'. $place->colonne;
    }

    // retourne l'image du concert pour un element du panier
    public static function image($representationId)
    {
        $representation = Representation::find($representationId);
        $concert = Concert::find($representation->concert_id);
        return ($concert->image);
    }

  
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request)
    {
        // recupere le cart session
        // $cart = session()->get('cart', []);

        // recupere les entites du frontend
        $user = User::find($request->input('user'));
        $representation = Representation::find($request->input('representation'));
        $places = $request->input('places');
        $arr = collect();
        foreach($places as $row){
            $pla = Place::where('rangee','=', $row['x'])->where('colonne', '=', $row['y'])->firstOrFail();
            Cart::create([
                "user_id" => $user->id,
                "place_id" => $pla->id,
                "representation_id" => $representation->id,
                "prix" => $representation->prix
            ]);
        }        

        // return redirect()->back()->with('success', 'Product added to cart successfully!');
        return view('cart.index');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            Cart::destroy($request->id);
        }
        return \Redirect::route('cart');
    }
}