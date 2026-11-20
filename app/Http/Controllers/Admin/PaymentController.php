<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    // Direct payment list
    public function list()
    {
        // Removed strict select() so 'id' and timestamps are included for buttons and sorting
        $payments = Payment::orderBy('type', 'desc')
            ->paginate(5);
            
        return view('admin.payment.list', compact('payments'));
    }

    // Create payment
    public function create(Request $request)
    {
        $this->checkValidation($request);
        $data = $this->getData($request);
        Payment::create($data);
        
        Alert::success('Saved!', 'Payment method created successfully!');
        return back();
    }

    // Delete payment
    public function delete($id)
    {
        Payment::where('id', $id)->delete();
        Alert::success('Deleted!', 'Payment method deleted successfully!');
        return back();
    }

    // Edit payment
    public function edit($id)
    {
        $payment = Payment::where('id', $id)->first();
        return view('admin.payment.edit', compact('payment'));
    }

    // Payment update
    public function update(Request $request, $id)
    {
        // Pass $id here so unique validation ignores the current record
        $this->checkValidation($request);
        
        $data = $this->getData($request);
        
        Payment::where('id', $id)->update($data);

        Alert::success('Updated!', 'Payment method updated successfully!');
        
        return redirect()->route('payment#list');
    }
    
    // Get data array
    private function getData($request)
    {
        return [
            'account_number' => $request->accountNumber,
            'account_name'   => $request->accountName,
            'type'           => $request->type,
        ];
    }
    
    // Check validation (handles both create and update via optional $id)
    private function checkValidation($request)
    {
        $rules = [
            // Keys match input names: accountNumber & accountName
            // Ignore current record ID during update for uniqueness
            'accountNumber' => 'required|string|max:255|unique:payments,account_number,' . $request->id,
            'accountName'   => 'required|string|max:255',
            'type'          => 'required|string|max:255',
        ];
        
        $messages = [];
        
        $request->validate($rules, $messages);
    }
}