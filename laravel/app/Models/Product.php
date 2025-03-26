<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;



class Product extends Model
{
    //
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name', 'pricing', 'category_id', 'discounted', 'active'];

    // Retrieve all products
    public static function getAllProducts()
    {
        return self::all();
    }

    // Get 10 active products ordered by name
    public static function getActiveProducts()
    {
        return self::where('active', 1)->orderBy('name')->take(10)->get();
    }

    // Get first product with price 2000
    public static function getProductByPrice($price)
    {
        return self::where('price', $price)->first();
    }

    // Retrieve a product by its primary key
    public static function findProductById($id)
    {
        return self::find($id);
    }

    // Retrieve the first active product
    public static function getFirstActiveProduct()
    {
        return self::where('active', 1)->first();
    }

    // Alternative method to retrieve first active product
    public static function getFirstWhereActive()
    {
        return self::firstWhere('active', 1);
    }

    // Find product by ID or perform an action if not found
    public static function findOrExecute($id, $callback)
    {
        return self::findOr($id, $callback);
    }

    // Find product or fail
    public static function findOrFailProduct($id)
    {
        return self::findOrFail($id);
    }

    // Retrieve product by name or create it if it doesn't exist
    public static function firstOrCreateProduct($name)
    {
        return self::firstOrCreate(['name' => $name]);
    }

    // Retrieve product by name or instantiate a new Product instance
    public static function firstOrNewProduct($name)
    {
        return self::firstOrNew(['name' => $name]);
    }

    // Count active products
    public static function countActiveProducts()
    {
        return self::where('active', 1)->count();
    }

    // Find the max price of an active product
    public static function maxActiveProductPrice()
    {
        return self::where('active', 1)->max('price');
    }

    // Create a new product instance
    public static function createProduct($data)
    {
        return self::create($data);
    }

    // Update or create a product
    public static function updateOrCreateProduct($search, $data)
    {
        return self::updateOrCreate($search, $data);
    }

    // Delete a product by ID
    public static function deleteProductById($id)
    {
        $product = self::find($id);
        if ($product) {
            $product->delete();
        }
    }

    // Truncate product table
    public static function truncateProducts()
    {
        self::truncate();
    }

    // Chunk processing of large datasets
    public static function chunkProducts($size, $callback)
    {
        self::chunk($size, function (Collection $products) use ($callback) {
            $callback($products);
        });
    }
}