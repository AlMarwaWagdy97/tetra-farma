<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ProductPocket;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()
            ->with(['transNow', 'rates'])
            ->where('show_in_cart', 0)   
            ->get();
            
        return view('products.index', compact('products'));
    }

    public function mostSelling()
    {
        $mostSellingProducts = Product::active()
            ->with(['transNow', 'rates', 'orderDetails'])
            ->withCount(['orderDetails as total_sold' => function ($query) {
                $query->select(DB::raw('SUM(quantity)'));
            }])
            ->orderByDesc('total_sold')
            ->where('show_in_cart', 0)   
            ->get();

        return view('components.mostselling', compact('mostSellingProducts'));
    }

    public function show($id)
    {
        $product = Product::active()
            ->with(['transNow', 'rates', 'galleryGroup.images', 'pockets']) 
            ->findOrFail($id);
    
        $similarProducts = Product::active()
            ->where('id', '!=', $product->id) 
            ->with(['transNow', 'rates'])
            ->inRandomOrder()  
            ->get();
    
        $averageRating = $product->rates()->avg('rating_value') ?? 0;  
        $reviewCount = $product->rates()->count();
        $ratingDistribution = $product->rates()
            ->select('rating_value', DB::raw('count(*) as count'))
            ->groupBy('rating_value')
            ->pluck('count', 'rating_value')
            ->toArray();
        $totalReviews = array_sum($ratingDistribution);
        $percentages = [];
        for ($i = 1; $i <= 5; $i++) {
            $count = $ratingDistribution[$i] ?? 0;
            $percentages[$i] = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
        }
    
        return view('site.pages.products.show', compact('product', 'similarProducts', 'averageRating', 'reviewCount', 'percentages'));
    }

    
}