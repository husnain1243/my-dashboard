<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Services;
use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\GiftMail;
use App\Mail\NotificationMail;
use Exception;

class FormController extends Controller
{
    function Forms(){
        $Forms['forms'] = Form::get();
        $Forms['PageTitle'] = 'Forms Dashboard';
        return view('admin.pages.forms.forms' , $Forms);
    }
    public function Forms_Delete($id)
    {
        $TeamsDelete = Form::findOrFail($id);
        $TeamsDelete->delete();
        // session()->flash('error', 'No users present.');
        return redirect()->route('Forms')->with('success', 'User deleted successfully');
    }
    public function FormSubmit(Request $request){

        // dd("in controller");

        $form = new Form();
        $form->form_type = $request->form_type;
        $form->data = json_encode($request->input());
        if($form->save()){
            if($request->form_type == "gift_form"){
                try {
                    $mail3 = Mail::to('husnainmohammad16@gmail.com')->send(new NotificationMail(json_encode($request->input()), "Notification"));
                    return redirect('/form-submitted');
                } catch(Exception $e) {
                    return redirect('/');
                }
            }
            if($request->form_type == "contact_form"){
                try {
                    $mail3 = Mail::to('husnainmohammad16@gmail.com')->send(new NotificationMail(json_encode($request->input()), "Notification"));
                    return redirect('/form-submitted');
                } catch(Exception $e) {
                    dd($e);
                    return redirect('/');
                }
            }
        }
    }


}
