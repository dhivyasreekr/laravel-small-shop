<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PDF;

use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function generateInvoicePdf($id)

    {
        $order = Order::findOrFail($id);

        $order_item = OrderItem::where('order_id',$order->id)->get();
    
        // dd($order_item);
    
        $data = [
            'order' => $order,
            'order_items' => $order_item
        ];
    
        // Load the view and pass the data
        $pdf = PDF::loadView('pdf.invoice',$data);
    
        return $pdf;
       
    }

    public function sendInvoiceEmail(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $recipient_email = $order->customer->email;
        $recipient_name = $order->customer->name;
        $subject = $order->customer->name;

        // generate the PDF
        $pdf = $this->generateInvoicePdf($id);

        // Prepare data for the email
        $data = [
            'order' => $order,
            'order_items' => OrderItem::where('order_id', $order->id)-> get(),

        ];

        // send email with the invoice attached
        Mail::send('email.invoice', $data, function($message) use ($pdf, $recipient_email, $recipient_name, $subject) {
            $message->to($recipient_email, $recipient_name)
                    ->subject($subject)
                    ->attachData($pdf->output(), "invoice.pdf");
        });

        // optionaly you can provide a response to indicate the email was sent
        return response()->json(['message' => 'Invoice email sent successfully']);
    }

    public function downloadInvoicePdf($id)
    {
        // generate the PDF
        $pdf = $this->generateInvoicePdf($id);

        // Download the PDF
        return $pdf->download('invoice.pdf');
    }

    public function streamInvoicePdf($id)
    {
       // generate the PDF
       $pdf = $this->generateInvoicePdf($id);

       // Stream the PDF to the browser
       return $pdf->stream('invoice.pdf');  
    }
}
