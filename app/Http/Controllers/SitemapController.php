<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
  
class SitemapController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index($value='')
    {
        $products = Product::latest()->get();
  
        return response()->view('sitemap', [
            'products' => $products
        ])->header('Content-Type', 'text/xml');
    }
}