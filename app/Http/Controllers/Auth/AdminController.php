<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{

  public function show()
  {
    return view('backend.entreprises.showing');
  }

  public function edit(Request $request , $id)
  {
    $validated = $request->validate([
      'email' => 'required|email',
      'localisation' => 'required|max:255',
      'contribuable' => 'required',
      'logo' => 'required|mimes:jpeg,png,jpg',
      'slogan' => 'required',
    ]);


      $image=$request->file('logo'); 
      $img=$image->getClientOriginalName();
      $destination='uploads';
      $image->move($destination,$img);

      $admins = Admin::find($id);
      $admins->name = $request->name;
      $admins->email = $request->email;
      $admins->adresse=$request->localisation;
      $admins->contribuable=$request->contribuable;
      $admins->numero_cnps=$request->cnps;
      $admins->slogan=$request->slogan;
      $admins->urlsiteweb=$request->url;
      $admins->secteur=$request->secteur;
      $admins->niveau_risque=$request->niveau;
      $admins->logo=$img;
      $admins->update();
      session()->flash('success', 'vos informations ont été mis as jour');
      return redirect()->route('showing');

  }

}
