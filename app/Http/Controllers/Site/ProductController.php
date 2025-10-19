<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ProductPocket;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Messaging\V1\LinkshorteningMessagingServiceDomainAssociationInstance;


class ProductController extends Controller
{
    public function index()
    {
       $products = Product::with('transNow')->active()->get();

            
        return view('site.pages.products.index', compact('products'));
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
    $product = Product::with(['transNow', 'pockets.translations', 'galleryGroup.images'])->findOrFail($id);
    return view('site.pages.products.show', compact('product'));
}
    
}