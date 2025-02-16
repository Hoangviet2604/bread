<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index() {
        return view('bread.admin.pages.index');
    }

    function table() {
        return view('bread.admin.pages.tables.basic-table');
    }

    function login() {
        return view('bread.admin.pages.user-pages.login');
    }

    function register() {
        return view('bread.admin.pages.user-pages.register');
    }

    function users() {
        $users = User::all();
        return view('bread.admin.pages.list-user', compact('users'));
    }

    function products() {
        $products = Product::paginate(15);
        return view('bread.admin.pages.list-product', compact('products'));
    }

    function orders() {
        $orders = Order::paginate(15);
        return view('bread.admin.pages.list-order', compact('orders'));
    }

    function delete($id) {
        $product = Product::find($id);
        if ($product) {
            $product->delete();

            return 'delete product successfully';
        } else {
            return 'delete product failed';
        }

    }

    function addProduct(Request $request) {
        $data = $request->all();
        $product = Product::create($data);

        return response()->json($product);
    }
}
