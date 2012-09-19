<?php

class Vendors_Controller extends Base_Controller {

  public function action_new() {
    $view = View::make('vendors.new');
    $this->layout->content = $view;
  }

  public function action_create() {
    $user = new User(Input::get('user'));
    $vendor = new Vendor(Input::get('vendor'));
    $userValidator = $user->validator();
    $vendorValidator = $vendor->validator();


    if ($user->validator()->passes() && $vendor->validator()->passes()) {
      $user->save();
      $user->vendor()->insert($vendor);
      return 'saved';
    } else {
      $allErrors = array_merge($userValidator->errors->all(), $vendorValidator->errors->all());
      return Redirect::to_route('new_vendors')->with('errors', $allErrors);
    }
  }

}