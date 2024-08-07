<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Database\Eloquent\ModelFoundException;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        //Appply filters based on the request
        if($request->has('category') && $request->category != 'All') {
            $query->where('category_id', $request->category);
        }

        if($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', "%(searchTerm)%");
        }

        $data = [
            'product' =>$query->get(),
            'categories' => $categories
        ];

        return view('frontend/home', $data);
    }

    public function show($id)
    {
        try {
            $product = Product::findOfFail($id);
            return view('frontend.show', compact('product'));
        } catch(ModelNotFoundException $e) {
            // Handle the case where the product id not found
            return redirect() ->route('products.index')->with('error', 'Product not found');
        }
    }

    public function sendEmailManually()
    {
        $recipient = "dhivyasreekr@gmail.com";  // Replace with actual recipient's email
        $subject = "Custom subject";
        $body = "This is the body of the email. You can include HTML here id needed";

        Mail::raw($body, function(Message $message) use ($recipient, $subject) {
            $message->to($recipient);
            $message->subject($subject);
            // Ypou can add attachments or other options here if needed
        });

        return "Email sent successfully";
    }

    // public function login(Request $request)
    // {
    //     return view('frontend/login');
    // }

    // public function register(Request $request)
    // {
    //     return view('frontend/register');
    // }

    // public function forget_password(Request $request)
    // {
    //     return view('frontend/forget_password');
    // }
}
